<?php
class Panel extends MY_Controller
{
    public function logout()
    {
        $_SESSION = [];
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 86400, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        session_destroy();
        header('Location: ' . site_url());
        exit;
    }
}