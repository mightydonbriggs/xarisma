<?php

namespace XarismaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\FileLocator;

    class DefaultController extends Controller
{
    public function indexAction()
    {
        $id = '1393';       //Get order ID from Ajax
        
        $list = $this->getDoctrine()->getRepository('XarismaBundle:Custorder')->findLikeId($id);
       
        return $this->render('XarismaBundle:Default:index.html.twig');
    }
}
