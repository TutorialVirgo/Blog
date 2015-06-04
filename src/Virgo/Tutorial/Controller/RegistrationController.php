<?php

namespace Virgo\Tutorial\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends Controller implements EntityManagerDependentInterface
{
    /**
     * @var EntityManager $em
     */
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function registrationAction(Request $request)
    {
        $variables = [];
        if ($request->isMethod(Request::METHOD_POST)) {

            $variables = $this->handleRegistration($request);
            if (empty($variables)) {
                new User($request->request->get('name'),
                $request->request->get('password'),
                $request->request->get('email'));


                return $this->renderResponse("success", $variables);
            } else {


                return $this->renderResponse("registration", $variables);
            }
        }

        return $this->renderResponse("registration", $variables);
    }

    /**
     * @param Request $request
     * @return string[]
     */
    private function handleRegistration(Request $request)
    {
        $errors = [];

        $name = $request->request->get('name');
        $password = $request->request->get('password');
        $email = $request->request->get('email');

        $this->checkName($name, $errors);
        $this->checkPassword($password, $errors);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "E-mail is invalid!");
        }

        return $errors;
    }

    /**
     * @param string   $pwd
     * @param string[] $errors
     */
    private function checkPassword($pwd, array &$errors)
    {
        if (strlen($pwd) < 8) {
            array_push($errors, "Name is too short!");
        }

        if (!preg_match("#[0-9]+#", $pwd)) {
            array_push($errors, "Password must include at least one number!");
        }

        if (!preg_match("#[a-zA-Z]+#", $pwd)) {
            array_push($errors, "Password must include at least one letter!");
        }
    }

    /**
     * @param string   $name
     * @param string[] $errors
     */
    private function checkName($name, array &$errors)
    {
        if (strlen($name) > 64) {
            array_push($errors, "Name is too long!");
        }

        if (strlen($name) < 3) {
            array_push($errors, "Name is too short!");
        }
    }
}
