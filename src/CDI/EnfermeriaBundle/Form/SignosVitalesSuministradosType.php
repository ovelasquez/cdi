<?php

namespace CDI\EnfermeriaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SignosVitalesSuministradosType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder            
            
                
                
                
            ->add('nombre', 'choice', 
                    array('choices'=>array(
                        'presion arterial'=>'Presion Arterial (PA)',
                        'frecuencia cardiaca'=>'Frecuencia Cardíaca (FC)',
                        'glicemia'=>'Glicemia',
                        'frecuencia respiratoria'=>'Frecuencia Respiratoria (FR)',
                        'peso'=>'Peso',
                        'talla'=>'Talla',
                        'temperatura'=>'Temperatura'),
                        'required'  => true,'label'=>'Signo Vital',
                        'empty_value' => 'seleccione',
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')))    
   
                
            ->add('valor', 'integer', 
                    array(
                        'label'=>'Valor',
                        'required'  => true, 
                        'attr' => array('class' => 'form-control','placeholder' => 'Valor del Signo Vital'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        )) 
           
           /*->add('fecha', 'date',
                    array(
                        'label'=>'Fecha',
                        'required'  => true, 
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                    ))
          
       */
                
                ->add('consulta',null,
                    array('label'=>'Consulta',
                        'required'  => false,
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label'
                        
                    )))
                
                
                
          /*  ->add('usuario', null,
                    array(
                        'label'=>'Usuario',
                        'empty_value'=>'Seleccione',
                        'required'  => false, 
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')))  */
               ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CDI\EnfermeriaBundle\Entity\SignosVitalesSuministrados'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cdi_enfermeriabundle_signosvitalessuministrados';
    }
}
