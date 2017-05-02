<?php

namespace WebBundle\EventListener;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Doctrine\ORM\EntityManager;

class RedirectionListener
{
    protected $session;
    protected $securityContext;
    protected $em;

    public function __construct(ContainerInterface $containerInterface)
    {
        $this->session = $containerInterface->get('session');
        $this->securityContext = $containerInterface->get('security.token_storage');
    }

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $em = $this->em;

        $route = $event->getRequest()->getPathInfo();

        $direccion = $em->getRepository("AdminBundle:Redirecciones")->findOneByDesde($route);

        if ($direccion) {
            $direccionNueva = $direccion->getPara();
            $event->setResponse(new RedirectResponse($direccionNueva, 301));
        }
    }
}