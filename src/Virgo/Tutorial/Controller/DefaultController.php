<?php

namespace Virgo\Tutorial\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Virgo\Tutorial\Entity\Post;
use Virgo\Tutorial\Repository\PostRepository;
use Virgo\Tutorial\Service\AuthenticationService;

class DefaultController extends Controller implements EntityManagerDependentInterface
{
    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $authenticationService = new AuthenticationService($request->getSession(), $this->entityManager);
            $response = $authenticationService->login($request);
            if ($response instanceof RedirectResponse) {
                return $response;
            }
            echo $this->templating->render("index.html.php", ["session" => $response]);
        }

        echo $this->templating->render('index.html.php', ["user" => $request->get('name', 'World')]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function homeAction(Request $request)
    {
        $repository = $this->entityManager->getRepository(Post::class);
        /** @var PostRepository $repository */
        $posts = $repository->findAllPosts();

        $authenticationService = new AuthenticationService($request->getSession(), $this->entityManager);
        $currentUser = $authenticationService->retrieveUser();
        if (null === $currentUser) {
            return new RedirectResponse('/');
        }

        echo $this->templating->render(
            "home.html.php", [
                "session" => $request->getSession(),
                "user" => $request->get('user', 'World'),
                "posts" => $posts
            ]
        );

        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function logoutAction(Request $request)
    {
        $authenticationService = new AuthenticationService($request->getSession(), $this->entityManager);
        return $authenticationService->logout($request->getSession());
    }
}
