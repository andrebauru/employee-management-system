<?php
class TimeEntry {
    public $id;
    public $user_id;
    public $clock_in;
    public $clock_out;

    public static function getLastUnfinishedEntry($userId) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM time_entries WHERE user_id = ? AND clock_out IS NULL ORDER BY id DESC LIMIT 1");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_object(__CLASS__);
        }
        return null;
    }

    public function save() {
        global $conn;
        if ($this->id) {
            $stmt = $conn->prepare("UPDATE time_entries SET clock_out = ? WHERE id = ?");
            $stmt->bind_param("si", $this->clock_out, $this->id);
        } else {
            $stmt = $conn->prepare("INSERT INTO time_entries (user_id, clock_in) VALUES (?, ?)");
            $stmt->bind_param("is", $this->user_id, $this->clock_in);
        }
        return $stmt->execute();
    }
}
