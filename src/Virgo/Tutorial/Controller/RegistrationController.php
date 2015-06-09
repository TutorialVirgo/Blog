<?php

namespace Virgo\Tutorial\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Virgo\Tutorial\Entity\User;
use Virgo\Tutorial\Form\UserType;
use Virgo\Tutorial\Repository\UserRepository;

class RegistrationController extends Controller implements EntityManagerDependentInterface
{
    /**
     * @param Request $request
     * @return Response
     */
    public function registrationAction(Request $request)
    {
        $session = $request->getSession();
        $session->clear();

        $session->set('userName', $request->request->get('user')['name']);
        $session->set('email', $request->request->get('user')['name']);

        $form = $this->formFactory->create(new UserType());

        $errors = [];
        if ($request->isMethod(Request::METHOD_POST)) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $user = new User();
                $user->setParamteres(
                    $request->request->get('user')['name'],
                    $request->request->get('user')['email'],
                    $request->request->get('user')['password'],
                    "Active"
                );

                $this->entityManager->persist($user);
                $this->entityManager->flush();

                return new RedirectResponse("/");
            } else {

                echo 'Error:';

                var_dump($form->getErrors()->count());
                foreach ($errors as $error) {
                    var_dump($error);
                }

                $session->set('errors', ['Invalid Registration!']);
                return $this->renderResponse("registration", ["session" => $session]);
            }
        }

        $session->set('errors', $errors);
        return $this->renderResponse("registration", ["session" => $session, "form" => $form->createView()]);
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
        $repository = $this->entityManager->getRepository(User::class);
        /** @var UserRepository $repository */
        if ($repository->findByEmail($request->request->get('email')) !== null) {
            array_push($errors, "E-mail is already in use!");
        }

        return $errors;
    }

    /**
     * @param string $pwd
     * @param string[] $errors
     */
    private function checkPassword($pwd, array &$errors)
    {
        if (strlen($pwd) < 8) {
            array_push($errors, "Password is too short!");
        }

        if (!preg_match("#[0-9]+#", $pwd)) {
            array_push($errors, "Password must include at least one number!");
        }

        if (!preg_match("#[a-zA-Z]+#", $pwd)) {
            array_push($errors, "Password must include at least one letter!");
        }
    }

    /**
     * @param string $name
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
