<?php

/**
 * Class Session
 *
 * The Session class is used to create and check the user's session
 *
 * @final
 */
final class Session
{
    /**
     * Start the session
     *
     * @param string $S_status The user's status
     * @param string $S_id The user's id
     *
     * @return void
     */
    public static function start(string $S_status, string $S_id):void {
        $_SESSION['user_id'] = Users::selectById($S_id)['user_id'];
        $_SESSION['id'] = $S_id;
        $_SESSION['status'] = $S_status;
    }

    /**
     * Check if the session is started
     *
     * @return bool
     */
    public static function check():bool {
        return (isset($_SESSION['id']) && isset($_SESSION['status']));
    }

    /**
     * Get the session
     *
     * @return array|null
     */
    public static function getSession(): ?array {
        if (Session::check()) {
            return $_SESSION;
        }
        return null;
    }

    /**
     * Destroy the session
     *
     * @return void
     */
    public static function destroy() : void{
        if (ini_get("session.use_cookies")) {
            $A_params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $A_params["path"],
                $A_params["domain"], $A_params["secure"], $A_params["httponly"]
            );
        }
        session_destroy();
    }
}