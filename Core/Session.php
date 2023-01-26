<?php

final class Session
{
    public static function start(string $S_status, string $S_id):void {
        $_SESSION['user_id'] = Users::selectById($S_id)['user_id'];
        $_SESSION['id'] = $S_id;
        $_SESSION['status'] = $S_status;
    }

    public static function check():bool {
        return (isset($_SESSION['id']) && isset($_SESSION['status']));
    }

    public static function getSession(): ?array {
        if (Session::check()) {
            return $_SESSION;
        }
        return null;
    }

    public static function destroy() {
        if (ini_get("session.use_cookies")) {
            $A_params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $A_params["path"],
                $A_params["domain"], $A_params["secure"], $A_params["httponly"]
            );
        }
        session_destroy();
    }
}