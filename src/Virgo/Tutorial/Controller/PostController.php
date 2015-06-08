<?php

namespace Virgo\Tutorial\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Virgo\Tutorial\Entity\Post;

class PostController extends Controller implements EntityManagerDependentInterface
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
    public function submitAction(Request $request)
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $session = $request->getSession();
            $errors = $this->verifyPost($request);
            if (empty($errors)) {
                $request->getSession()->set('errors', $errors);
                $post = new Post();
                $post->setUserid($request->getSession()->get('userId'));
                $post->setTitle($request->request->get('postTitle'));
                $post->setContent($request->request->get('postContent'));
                $post->setEmail($session->get('email'));
                $post->setStatus("active");

                $this->entityManager->persist($post);
                $this->entityManager->flush();

                return new RedirectResponse("home");
            }
            $session->set('errors', $errors);
            $session->set('postTitle', $request->request->get('postTitle'));
            $session->set('postContent', $request->request->get('postContent'));

            return new RedirectResponse("home");
        }

        return new RedirectResponse("home");
    }

    public function deleteAction(){

    }

    private function verifyPost($request)
    {
        $errors = [];

        if (strlen($request->request->get('postTitle')) < 1) {
            array_push($errors, "Title is too short!");
        }

        if (strlen($request->request->get('postContent')) < 1) {
            array_push($errors, "Content is empty!");
        }

        return $errors;
    }
}
