<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @IsGranted("ROLE_USER")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }
}
