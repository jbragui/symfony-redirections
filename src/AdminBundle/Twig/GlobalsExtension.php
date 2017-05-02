<?php
namespace AdminBundle\Twig;

use Core\ZeroBundle\Helper\Util;
use Symfony\Bridge\Doctrine\RegistryInterface;

class GlobalsExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
    protected $doctrine;
    protected $util;
    protected $locals = array();
    protected $request;

    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->util = new Util;
    }

    public function getGlobals()
    {
        // WebBundle:Home
        $this->locals['infoHome'] = $this->doctrine->getRepository('AdminBundle:Home')->find(1);

        // WebBundle:Info
        $this->locals['info'] = $this->doctrine->getRepository('AdminBundle:Info')->find(1);

        // retornando valores
        return $this->locals;
    }

    public function getName()
    {
        return 'AdminBundle:GlobalsExtension';
    }
}
