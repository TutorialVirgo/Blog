<?php

namespace Virgo\Tutorial\Service;

use Symfony\Component\HttpFoundation\Session\Session;

class AuthenticationService
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function authenticate()
    {
        if (!isset($this->session) || $this->session->get('email') === null || $this->session->get('email') === "") : ?>
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <div class="wrapper">
                <h1> Error 403 - Unauthorized</h1>

                <div class="errors"> You have to log in to view this content!
                    <?php header("HTTP/1.1 403 Unauthorized"); ?>
                    <br><br>
                    <a href="/"> <input type="button" name="login" value="Log in"></a>
                </div>
            </div>
            <?php exit;
        endif;
    }
}
