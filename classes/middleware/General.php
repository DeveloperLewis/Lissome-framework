<?php

namespace classes\middleware;

class General
{
    //Verify that the session is secure.
    private function verifySession(): void
    {
        if (isset($_SESSION["user"]))
        {
            if ($_SERVER["REMOTE_ADDR"] != $_SESSION["user"]["ip"] || $_SERVER["HTTP_USER_AGENT"] != $_SESSION["user"]["agent"] ||
                time() > ($_SESSION["user"]["last_access"] + 3600))
            {
                unset($_SESSION["user"]);
            }
            else
            {
                $_SESSION["user"]["last_access"] = time();
            }
        }
    }

    //Authenticate that the user is logged in.
    public function authenticateUser(): void
    {
        $this->verifySession();
        if (!isLoggedIn())
        {
            redirect("/");
        }
    }
}