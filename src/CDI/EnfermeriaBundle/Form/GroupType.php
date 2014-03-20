<?php

namespace CDI\EnfermeriaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', 
                    array(
                        'label'=>'Nombre',
                        'required'  => true, 
                        'attr' => array('class' => 'form-control','placeholder' => 'Nombre del Rol'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        
                        )) 
                
                
            ->add('role', 'text', 
                    array(
                        'label'=>'Rol',
                        'required'  => true, 
                        'attr' => array('class' => 'form-control','placeholder' => 'Rol'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        
                        )) 
            ->add('users',null,array(
                        'label'=>'Usuarios',
                        'required'  => true, 
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        
                        )) 
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CDI\EnfermeriaBundle\Entity\Group'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cdi_enfermeriabundle_group';
    }
}
