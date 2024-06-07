<?php
require_once '../models/TimeEntry.php';

class EmployeeController {
    public function clockIn($userId, $password) {
        if (User::verifyPassword($userId, $password)) {
            $timeEntry = new TimeEntry();
            $timeEntry->user_id = $userId;
            $timeEntry->clock_in = date('Y-m-d H:i:s');
            $timeEntry->save();
            return true;
        }
        return false;
    }

    public function clockOut($userId, $password) {
        if (User::verifyPassword($userId, $password)) {
            $timeEntry = TimeEntry::getLastUnfinishedEntry($userId);
            if ($timeEntry) {
                $timeEntry->clock_out = date('Y-m-d H:i:s');
                $timeEntry->save();
                return true;
            }
        }
        return false;
    }
}
