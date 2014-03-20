<?php

namespace CDI\EnfermeriaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MedicamentosSuministradosType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                
             ->add('medicamento',
                     null,
                    array(
                        'label'=>'Medicamento',
                        'empty_value'=>'Seleccione',
                        'required'  => true, 
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        ))
                
             ->add('cantidad', 'integer', 
                    array(
                        'label'=>'Cantidad Suministrada',
                        'required'  => true, 
                        'attr' => array(
                            'class' => 'form-control',
                            'placeholder' => 'Cantidad disponible'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        ))
                
                       
                   
            
             
            ->add('viaAdministracion', 'choice',
                    array(
                        'choices' => array(
                            'endovenosa' => 'Endovenosa',
                            'oral' => 'Oral',
                            'sublingual'=>'Sublingual',
                            'intramuscular'=>'Intramuscular',
                            'intradérmica'=>'Intradérmica'),
                        
                        'label'=>'Via de Administración',
                        'empty_value'=>'Seleccione',
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label',
                        'required'  => true,
                          )))
            
                
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
                
                
                
            /*->add('usuario', null,
                    array(
                        'label'=>'Usuario',
                        'empty_value'=>'Seleccione',
                        'required'  => false, 
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label'))) */
            ;
    }
    
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CDI\EnfermeriaBundle\Entity\MedicamentosSuministrados'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cdi_enfermeriabundle_medicamentossuministrados';
    }
}
