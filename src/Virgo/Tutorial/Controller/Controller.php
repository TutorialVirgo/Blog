<?php

namespace Virgo\Tutorial\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\Type\FormTypeValidatorExtension;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
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

    protected $templating;

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

        $viewPath = dirname(__DIR__) . '/Resources/Views/%name%';
        $loader = new FilesystemLoader($viewPath);
        $this->templating = new PhpEngine(new TemplateNameParser(), $loader);
    }
}
