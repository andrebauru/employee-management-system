<?php
require_once 'config/db_config.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/EmployeeController.php';
require_once 'controllers/ReportController.php';

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
    $authController = new AuthController();
    if ($authController->login($_POST['email'], $_POST['password'])) {
        // Redirect to dashboard or clock-in page
    } else {
        // Display login error message
    }
}

// Handle clock-in
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['password'])) {
    $employeeController = new EmployeeController();
    if ($employeeController->clockIn($_POST['user_id'], $_POST['password'])) {
        // Display success message
    } else {
        // Display error message
    }
}

// Handle clock-out
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['password'])) {
    $employeeController = new EmployeeController();
    if ($employeeController->clockOut($_POST['user_id'], $_POST['password'])) {
        // Display success message
    } else {
        // Display error message
    }
}

// Generate employee report
$reportController = new ReportController();
$employee_report = $reportController->getEmployeeReport();

// Generate work log
$work_log = $reportController->getWorkLog(date('m'), date('Y'));
