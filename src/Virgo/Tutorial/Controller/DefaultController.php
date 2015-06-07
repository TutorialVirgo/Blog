<?php

namespace Virgo\Tutorial\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Virgo\Tutorial\Entity\User;
use Virgo\Tutorial\Repository\UserRepository;

class DefaultController extends Controller implements EntityManagerDependentInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            if ($this->isValid($request)) {
                return new RedirectResponse("home");
            }

            $session = $request->getSession();
            $session->clear();
            $session->set("loginErrors", ["Invalid E-mail/Password combination!"]);
            $session->set("email", $request->request->get("email"));
            return $this->renderResponse("index", ["session" => $session]);
        }

        return $this->renderResponse("index", ["user" => $request->get('name', 'World')]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function homeAction(Request $request)
    {
        //TODO : Sending the session doesn't feel right.
        return $this->renderResponse(
            "home",
            ["session" => $request->getSession(), "user" => $request->get('user', 'World')]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function logoutAction(Request $request)
    {
        $session = $request->getSession();
        $session->clear();

        return new RedirectResponse("/");
    }

    /**
     * @param Request $request
     * @return string[]
     */
    private function isValid(Request $request)
    {
        $repository = $this->entityManager->getRepository(User::class);
        /** @var UserRepository $repository */
        $user = $repository->findByEmail($request->request->get('email'));
        if ($user === null) {
            return false;
        }

        $enteredPassword = password_hash(
            $request->request->get('password'),
            PASSWORD_BCRYPT,
            ['salt' => $user->getSalt()]
        );

        /**@var User $user */
        if ($enteredPassword === $user->getPassword()) {
            $session = $request->getSession();
            $session->set('userName', $user->getName());
            $session->set('email', $user->getEmail());
            return true;
        } else {
            return false;
        }
    }
}
