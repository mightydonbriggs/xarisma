<?php
namespace XarismaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class BaseController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
    /**
     * Get an entites repository
     * 
     * This function will get the repository for an entity. The name of
     * the entity is passed as a parmeter.
     * 
     * @param text $name Name of entity to get repo for, without bundle name
     * @param type $manager
     * @return EntityRepository
     */
    protected function getRepo($name, $manager = 'default')
    {
        if ($manager == 'default') {
            return $this->get('doctrine')
                ->getRepository("XarismaBundle:{$name}");
        } else {
            return $this->get('doctrine')
                ->getRepository("XarismaBundle:{$name}", $manager);
        }
    }

    protected function flushEntities()
    {
        $this->getDoctrine()->getManager()->flush();
    }
    
    protected function persistEntity($entity) {
        $this->getDoctrine()->getManager()->persist($entity);
    }
    
    protected function addError($message)
    {
        $this->get('session')->getFlashBag()->add('error', $message);
    }

    protected function addNotice($message)
    {
        $this->get('session')->getFlashBag()->add('notice', $message);
    }    
}

