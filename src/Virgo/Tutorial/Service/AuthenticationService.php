<?php

namespace Virgo\Tutorial\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Virgo\Tutorial\Entity\User;
use Virgo\Tutorial\Repository\UserRepository;

class AuthenticationService
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param Session $session
     * @param EntityManager $entityManager
     */
    public function __construct(Session $session, EntityManager $entityManager)
    {
        $this->session = $session;
        $this->entityManager = $entityManager;
    }

    /**
     * @return null|object
     */
    public function retrieveUser()
    {
        $repository = $this->entityManager->getRepository(User::class);
        /** @var UserRepository $repository */

        return $repository->findByEmail($this->session->get('email'));
    }

    /**
     * @param Session $session
     * @return RedirectResponse
     */
    public function logout(Session $session)
    {
        $session->clear();

        return new RedirectResponse("/");
    }

    /**
     * @param Request $request
     * @return RedirectResponse|SessionInterface
     */
    public function login(Request $request)
    {
        if ($this->isValid($request)) {
            return new RedirectResponse("home");
        }

        $session = $request->getSession();
        $session->clear();
        $session->set("loginErrors", ["Invalid E-mail/Password combination!"]);
        $session->set("email", $request->request->get("email"));
        $session->set('errors', []);

        return $session;
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
            $session->clear();
            $session->set('userName', $user->getName());
            $session->set('email', $user->getEmail());
            $session->set('userId', $user->getId());
            return true;
        } else {
            return false;
        }
    }

    public function userHasPermissionToEditPost($request)
    {

        $userRepository = $this->entityManager->getRepository(User::class);
        /** @var UserRepository $userRepository */
        $user = $userRepository->findByEmail($request->request->get('email'));
        if ($user === null) {
            return false;
        }



    }
}
