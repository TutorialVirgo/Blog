<?php

namespace Virgo\Tutorial\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
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

        return $errors;
    }
}
