<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AdminBundle\Entity\Redirecciones;
use AdminBundle\Form\RedireccionesType;

/**
 * @Route("/Redirecciones")
 */
class RedireccionesController extends Controller
{
    /**
     * Lists all Redirecciones entities.
     *
     * @Route("/", name="zerobundle_admin_redirecciones")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminBundle:Redirecciones')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Redirecciones entity.
     *
     * @Route("/new", name="zerobundle_admin_redirecciones_new")
     * @Method({"GET", "POST"})
     * @Template("AdminBundle:Redirecciones:form.html.twig")
     */
    public function newAction(Request $request)
    {
        $entity = new Redirecciones();
        $form = $this->createForm('AdminBundle\Form\RedireccionesType', $entity, array(
            'action' => $this->generateUrl('zerobundle_admin_redirecciones_new'),
        ));
        $form->add('submit', SubmitType::class, array('label' => 'button_new_msg_1'));
        $form->add('submit2', SubmitType::class, array('label' => 'button_new_msg_2'));
        $form->add('submit3', SubmitType::class, array('label' => 'button_new_msg_3'));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Se ha guardado con éxito!')
            ;

            $return = ($request->query->get('ajax') == 'true') ? array('ajax'=>'true'):array();

            $url = 'zerobundle_admin_redirecciones';

            if ($form->get('submit2')->isClicked())
            {
                $url = 'zerobundle_admin_redirecciones_edit';
                $return['id'] = $entity->getId();
            }elseif ($form->get('submit3')->isClicked()) {
                $url = 'zerobundle_admin_redirecciones_new';
            }

            return $this->redirectToRoute($url, $return);
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Redirecciones entity.
     *
     * @Route("/{id}/edit", name="zerobundle_admin_redirecciones_edit")
     * @Method({"GET", "POST"})
     * @Template("AdminBundle:Redirecciones:form.html.twig")
     */
    public function editAction(Request $request, Redirecciones $entity)
    {
        $deleteForm = $this->createDeleteForm($entity);
        $editForm = $this->createForm('AdminBundle\Form\RedireccionesType', $entity, array(
            'action' => $this->generateUrl('zerobundle_admin_redirecciones_edit', array('id' => $entity->getId())),
        ));
        $editForm->add('submit', SubmitType::class, array('label' => 'button_edit_msg_1'));
        $editForm->add('submit2', SubmitType::class, array('label' => 'button_edit_msg_2'));
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

            $url = 'zerobundle_admin_redirecciones';

            if ($editForm->get('submit2')->isClicked())
            {
                $url = 'zerobundle_admin_redirecciones_edit';
                $return['id'] = $entity->getId();
            }

            return $this->redirectToRoute($url, $return);
        }

        return array(
            'entity' => $entity,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Redirecciones entity.
     *
     * @Route("/{id}", name="zerobundle_admin_redirecciones_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Redirecciones $entity)
    {
        $form = $this->createDeleteForm($entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
        }

        $return = ($request->query->get('ajax') == 'true') ? array('ajax'=>'true'):array();
        return $this->redirectToRoute('zerobundle_admin_redirecciones', $return);
    }

    /**
     * Creates a form to delete a Redirecciones entity.
     *
     * @param Redirecciones $blog The Redirecciones entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Redirecciones $entity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zerobundle_admin_redirecciones_delete', array('id' => $entity->getId())))
            ->add('submit', SubmitType::class, array('label' => 'button_delete_msg'))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}