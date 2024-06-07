<?php
require_once '../models/User.php';

class AuthController {
    public function login($email, $password) {
        $user = User::findByEmail($email);
        if ($user && password_verify($password, $user->password)) {
            session_start();
            $_SESSION['user_id'] = $user->id;
            return true;
        }
        return false;
    }

    public function logout() {
        session_start();
        session_destroy();
    }
}
