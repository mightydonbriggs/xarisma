<?php

namespace XarismaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\FileLocator;

    class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('XarismaBundle:Default:index.html.twig');
    }
}
