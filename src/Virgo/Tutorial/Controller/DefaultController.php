<?php

namespace Virgo\Tutorial\Controller;

use Doctrine\ORM\EntityManager;
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
                return $this->renderResponse("home", ["user" => $request->request->get("name")]);
            }

            return $this->renderResponse("index", [
                "email" => $request->request->get("email"),
                "loginErrors" => ["Invalid Password!"]
            ]);
        }

        return $this->renderResponse("index", ["user" => $request->get('name', 'World')]);
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

        $enteredPassword = password_hash(
            $request->request->get('password'),
            PASSWORD_BCRYPT,
            ['salt' => $user->getSalt()]
        );

        /**@var User $user */
        if ($enteredPassword === $user->getPassword()) {
            return true;
        } else {
            return false;
        }
    }
}
