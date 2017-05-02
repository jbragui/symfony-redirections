<?php

namespace WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    protected $locals = array();
    
    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function homeAction()
    {
        $em = $this->getDoctrine();
        $this->locals['detalle'] = $em->getRepository('AdminBundle:Home')->find(1);

        //retornando valores
        return $this->locals;
    }

    /**
     * @Route("/new-url/", name="new-url")
     * @Template()
     */
    public function newurlAction()
    {
    }
}
