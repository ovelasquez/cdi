<?php

namespace CDI\EnfermeriaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuariosType extends AbstractType
{
   /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datos', new DatosType(), array('label'=>' '))  
           
            ->add('email', 'text', 
                    array(
                        'label'=>'Correo Electrónico',
                        'required'  => true, 
                        'attr' => array('class' => 'form-control','placeholder' => 'Correo'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        
                        ))  
                
             ->add('username', 'text', 
                    array(
                        'label'=>'Nombre de Usuario',
                        'required'  => true, 
                        'attr' => array('class' => 'form-control','placeholder' => 'Nombre de Usuario'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        
                        )) 

                
             ->add('password', 'password', 
                    array(
                        'label'=>'Clave',
                        'required'  => true, 
                        'attr' => array('class' => 'form-control','placeholder' => 'Clave de acceso'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        
                        )) 
            ->add('pregunta', 'text', 
                    array(
                        'label'=>'Pregunta de Seguridad',
                        'required'  => true, 
                        'attr' => array('class' => 'form-control','placeholder' => 'Pregunta'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        
                        ))  
                
                
            ->add('respuesta', 'text', 
                    array(
                        'label'=>'Respuesta de Seguridad',
                        'required'  => true, 
                        'attr' => array('class' => 'form-control','placeholder' => 'Respuesta'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        
                        )) 
           ->add('salt', 'hidden', 
                    array(
                        'label'=>'Basura',
                        'required'  => true, 
                        'attr' => array('class' => 'form-control','placeholder' => 'Basura'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        
                        )) 
                
           
                 ->add('isActive', 'checkbox', 
                    array(
                        'required' => false,
                        'label'=>'Activo',                        
                        
                        ))
                
                 ->add('groups', 'entity', array(
                 'label'=>'Roles',
                'class' => 'EnfermeriaBundle:Group',
                'multiple' => true,
                'expanded' => true,
            ))
                
           
          
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CDI\EnfermeriaBundle\Entity\Usuarios'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cdi_enfermeriabundle_usuarios';
    }
}
