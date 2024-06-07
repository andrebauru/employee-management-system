<?php
require_once '../models/TimeEntry.php';
require_once '../models/User.php';

class ReportController {
    public function getEmployeeReport() {
        global $conn;
        $stmt = $conn->prepare("
            SELECT u.name, COUNT(t.id) AS total_days, SUM(TIME_TO_SEC(TIMEDIFF(t.clock_out, t.clock_in))) / 3600 AS total_hours
            FROM time_entries t
            JOIN users u ON t.user_id = u.id
            GROUP BY t.user_id
        ");
        $stmt->execute();
        $result = $stmt->get_result();
        $report = [];
        while ($row = $result->fetch_assoc()) {
            $report[] = [
                'name' => $row['name'],
                'total_days' => $row['total_days'],
                'total_hours' => $row['total_hours']
            ];
        }
        return $report;
    }

    public function getWorkLog($month, $year) {
        global $conn;
        $stmt = $conn->prepare("
            SELECT
                DATE(t.clock_in) AS date,
                DAYOFWEEK(t.clock_in) AS day_of_week,
                HOUR(t.clock_in) AS clock_in_hour,
                HOUR(t.clock_out) AS clock_out_hour,
                u.name AS employee_name
            FROM time_entries t
            JOIN users u ON t.user_id = u.id
            WHERE DATE(t.clock_in) BETWEEN ? AND ?
            ORDER BY t.clock_in
        ");
        $start_date = date("Y-m-01", mktime(0, 0, 0, $month, 1, $year));
        $end_date = date("Y-m-t", mktime(0, 0, 0, $month, 1, $year));
        $stmt->bind_param("ss", $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result();
        $work_log = [];
        while ($row = $result->fetch_assoc()) {
            $work_log[] = [
                'date' => $row['date'],
                'day_of_week' => $row['day_of_week'],
                'clock_in_hour' => $row['clock_in_hour'],
                'clock_out_hour' => $row['clock_out_hour'],
                'employee_name' => $row['employee_name']
            ];
        }
        return $work_log;
    }
}
