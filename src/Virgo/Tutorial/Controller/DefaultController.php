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
            $errors = $this->isValid($request);
            if (empty($errors)) {
                return $this->renderResponse("home", ["user" => $request->request->get('name', 'Unknown')]);
            }

            return $this->renderResponse("index", ["user" => $request->get('name', 'World'), "errors" => $errors]);
        }

        return $this->renderResponse("index", ["user" => $request->get('name', 'World')]);
    }

    /**
     * @param Request $request
     * @return string[]
     */
    private function isValid(Request $request)
    {
        $errors = [];
        $repository = $this->entityManager->getRepository(User::class);
        /** @var UserRepository $repository */
        $user = $repository->findByEmail($request->request->get('email'));
        $enteredPassword = password_hash($request->request->get('password') . $user->getSalt(), PASSWORD_BCRYPT);
        /**@var User $user */

        if ($enteredPassword === $user->getPassword()) {
            echo ' EZAZ BAZDMEG ELTALALTAD';
        } else {
            echo ' NEM NYERT KOCSOG';
            print_r($enteredPassword);
            echo PHP_EOL;
            print_r($user->getPassword());
        }

        return $errors;
    }
}
