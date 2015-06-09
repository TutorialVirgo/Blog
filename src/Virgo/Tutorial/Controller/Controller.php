<?php

namespace Virgo\Tutorial\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\Type\FormTypeValidatorExtension;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validation;

class Controller
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var FormFactoryInterface
     */
    protected $formFactory;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $validator = $validator = Validation::createValidator();
        $this->formFactory = Forms::createFormFactoryBuilder()
            ->addTypeExtension(new FormTypeValidatorExtension($validator))
            ->addExtension(new HttpFoundationExtension())
            ->getFormFactory();
        $this->entityManager = $entityManager;
    }

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
