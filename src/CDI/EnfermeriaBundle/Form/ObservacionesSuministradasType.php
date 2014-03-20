<?php

namespace CDI\EnfermeriaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ObservacionesSuministradasType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo', 'choice', 
                    array('choices'=>array(
                        'cura'=>'Cura',
                        'sutura'=>'Sutura',
                        'retiro de puntos'=>'Retiro de Puntos'), 
                        'required'  => true,'label'=>'Tipo de Observacion',
                        'empty_value' => 'seleccione',
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')))  
            ->add('descripcion','textarea',
                       array(
                       'attr' => array('rows' => '3', 'class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label'),
                  
                    ))
          /*->add('fecha', 'date',
                    array(
                        'label'=>'Fecha',
                        'required'  => true, 
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                    ))*/
                
                ->add('consulta',null,
                    array('label'=>'Consulta',
                        'required'  => false,
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label'
                        
                    )))
                
           /* ->add('usuario', null,
                    array(
                        'label'=>'Usuario',
                        'empty_value'=>'Seleccione',
                        'required'  => false, 
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')))*/
            ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CDI\EnfermeriaBundle\Entity\ObservacionesSuministradas'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cdi_enfermeriabundle_observacionessuministradas';
    }
}
