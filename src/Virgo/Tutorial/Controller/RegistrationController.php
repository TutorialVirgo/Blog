<?php

namespace Virgo\Tutorial\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function registrationAction(Request $request)
    {
        return $this->renderResponse("registration");
    }
}
