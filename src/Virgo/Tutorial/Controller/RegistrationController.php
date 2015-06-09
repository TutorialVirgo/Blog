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
     * @return RedirectResponse
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
            if ($form->submit($request)->isValid()) {
                echo "still valid"; die; //TODO:  Issue - Mindig valid
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
                $session->set('errors', ['Invalid Registration!']);
                echo $this->templating->render("registration.html.php", ["session" => $session]);

                return new Response();
            }
        }

        $session->set('errors', $errors);
        echo $this->templating->render("registration.html.php", ["session" => $session, "form" => $form->createView()]);

        return new Response();
    }
}
