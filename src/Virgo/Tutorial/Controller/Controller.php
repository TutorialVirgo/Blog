<?php

namespace Virgo\Tutorial\Controller;

use Symfony\Component\HttpFoundation\Response;

class Controller
{
    /**
     * @param string $view
     * @param array $variables
     * @return string
     */
    protected function render($view, array $variables = [])
    {
        $view = sprintf("%s/Resources/Views/%s.html.php", dirname(__DIR__), $view);
        extract($variables);
        ob_start();
        require($view);

        return ob_get_clean();
    }

    /**
     * @param string $view
     * @param array $variables
     * @return Response
     */
    protected function renderResponse($view, array $variables = [])
    {
        return new Response($this->render($view, $variables));
    }
}
