<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AdminBundle\Entity\Info;
use AdminBundle\Form\InfoType;

/**
 * @Route("/Info")
 */
class InfoController extends Controller
{
    /**
     * Displays a form to edit an existing Blog entity.
     *
     * @Route("/", name="zerobundle_admin_info")
     * @Method({"GET", "POST"})
     * @Template("AdminBundle:Info:form.html.twig")
     */
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AdminBundle:Info')->find(1);
        if (!$entity) $entity = new Info();
        $editForm = $this->createForm('AdminBundle\Form\InfoType', $entity, array(
            'action' => $this->generateUrl('zerobundle_admin_info'),
        ));
        $editForm->add('submit', SubmitType::class, array('label' => 'button_edit_msg_1'));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Se ha guardado con éxito!')
            ;

            $return = ($request->query->get('ajax') == 'true') ? array('ajax'=>'true'):array();

            $url = 'zerobundle_admin_info';

            return $this->redirectToRoute($url, $return);
        }

        return array(
            'entity' => $entity,
            'form' => $editForm->createView(),
        );
    }
}
