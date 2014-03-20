<?php

namespace CDI\EnfermeriaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonalType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datos', new DatosType(), array('label'=>' '))
                
            ->add('procedencia', 'choice',
                    array(
                        'choices'=> array(
                            'interno'=>'Interno',
                            'externo'=>'Externo'),
                        'label'=>'Procedencia del Personal',
                        'empty_value'=>'Seleccione',
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')))
                
            ->add('tipo', 'choice',
                    array(
                        'choices'=> array(
                            'doctor'=>'Doctor',
                            'enfermera'=>'Enfermera'),
                        'required'  => true,
                        'label'=>'Tipo de Personal',
                        'empty_value'=>'Seleccione',
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')))
            
             ->add('sas', 'text', 
                    array(
                        'label'=>'Código SAS', 
                        'attr' => array(
                            'class' => 'form-control','placeholder' => 'Codigo SAS del Doctor'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        ))   
                
            ->add('especialidad', null,
                    array(
                        'label'=>'Especialidad',
                        'empty_value'=>'Seleccione',
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')))
 
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CDI\EnfermeriaBundle\Entity\Personal'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cdi_enfermeriabundle_personal';
    }
}
