<?php
class User {
    public $id;
    public $name;
    public $email;
    public $password;

    public static function findByEmail($email) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_object(__CLASS__);
            return $user;
        }
        return null;
    }

    public static function verifyPassword($userId, $password) {
        global $conn;
        $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_object();
            return password_verify($password, $user->password);
        }
        return false;
    }

    public function save() {
        global $conn;
        if ($this->id) {
            $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
            $stmt->bind_param("sssi", $this->name, $this->email, $this->password, $this->id);
        } else {
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $this->name, $this->email, $this->password);
        }
        return $stmt->execute();
    }
}
