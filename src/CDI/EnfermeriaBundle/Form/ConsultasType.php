<?php

namespace CDI\EnfermeriaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ConsultasType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('charla', 'checkbox', array(
                        'label'=>'charla',
                        'required'  => false, 
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        ))
          ->add('egreso', 'checkbox', array(
                        'label'=>'Egreso',
                        'required'  => false, 
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        ))
                
          /*  ->add('fecha',
                    'date', 
                    array(
                        'empty_value' => array(
                            'year' => 'Año', 'month' => 'Mes', 'day' => 'Día')
                        )
                  )
            
          
            ->add('usuarios','hidden') */
            ->add('paciente')
            
             
           
             
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CDI\EnfermeriaBundle\Entity\Consultas'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cdi_enfermeriabundle_consultas';
    }
}
