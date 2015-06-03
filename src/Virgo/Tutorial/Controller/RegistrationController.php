<?php

namespace Virgo\Tutorial\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function registrationAction(Request $request)
    {
        $variables = [];
        if ($request->isMethod(Request::METHOD_POST)) {
            $variables = $this->handleRegistration($request);
        }

        return $this->renderResponse("registration", $variables);
    }

    /**
     * @param Request $request
     */
    private function handleRegistration(Request $request)
    {
        $errors = [];

        $name = $request->request->get('name');
        $password = $request->request->get('password');
        $email = $request->request->get('email');

        if (strlen($name) > 64) {
            array_push($errors, "Name is too long!");
        }
        if (strlen($name) < 3) {
            array_push($errors, "Name is too short!");
        }
        if (strlen($password) > 64) {
            array_push($errors, "Password is too long!");
        }
        if (strlen($password) < 3) {
            array_push($errors, "Password is too short!");
        }
        if (strlen($email) > 128) {
            array_push($errors, "E-mail is too long!");
        }
        if (strlen($email) < 3) {
            array_push($errors, "E-mail is too short!");
        }
        if (!strpos($email, '@') || !strpos($email, '.')) {
            array_push($errors, "E-mail is invalid!");
        }
    }
}
