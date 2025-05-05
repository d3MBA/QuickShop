<?php
class Session
{
    private function killSession()
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $p = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $p['path'], $p['domain'], $p['secure'], $p['httponly']);
        }
        session_destroy();
    }

    public function forgetSession()
    {
        $this->killSession();
        // redirect to index.php (home  page)
        header('Location: index.php');
        exit;
    }


}
