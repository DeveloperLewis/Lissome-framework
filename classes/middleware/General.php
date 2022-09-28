<?php

namespace classes\middleware;

class General
{
    private function verifySession(): void {
        if (isset($_SESSION["user"])) {
            if ($_SERVER['REMOTE_ADDR'] != $_SESSION["user"]["ip"]) {
                unset($_SESSION["user"]);
            }

            if ($_SERVER['HTTP_USER_AGENT'] != $_SESSION["user"]["agent"]) {
                unset($_SESSION["user"]);
            }

            if (time() > ($_SESSION["user"]["last_access"] + 3600)) {
                unset($_SESSION["user"]);
            }
            else {
                $_SESSION["user"]["last_access"] = time();
            }
        }
    }

    public function authenticateUser(): void {
        //Start session before authentication.
        session_start();
        //Check for session hijacking
        $this->verifySession();
        //Check if session is still available
        if (!isLoggedIn()) {
            redirect("/hello");
        }
    }
}