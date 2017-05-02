<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Core\ZeroBundle\Form\Type\CKEditorType;
use Core\ZeroBundle\Form\Type\FileBrowserType;

class RedireccionesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('desde', null, array(
                'attr' => array(
                    'placeholder' => 'Ingresa ruta absoluta del antiguo sitio web'
                ),
                'label' => 'Desde:',
            ))
            ->add('para', null, array(
                'attr' => array(
                    'placeholder' => 'Ingresa ruta absoluta del nuevo sitio web'
                ),
                'label' => 'Para:',
            ))
        ;
    }
}