<?php

namespace CDI\EnfermeriaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PacientesType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
         
            ->add('datos', new DatosType(), array('label'=>' '))
            ->add('genero', 'choice',
                    array(
                        'choices'=> array(
                            'femenino'=>'Femenino',
                            'masculino'=>'Masculino'),
                        'label'=>'Género',
                        'empty_value'=>'Seleccione',
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        
                        ))
                 
                
             ->add('fechaNacimiento','text',
                
                    array(
                        
                        'read_only' => true,
                        'label'=>'Fecha de Nacimiento',
                        'attr' => array('class' => 'datepicker','format'=> 'dd/mm/yyyy', 'placeholder'=> 'dd/mm/yyyy'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')))
                
                
                
            ->add('procedencia', 'choice', 
                    array(
                        'choices'=> array(
                            'interno'=>'Interno', 
                            'externo'=>'Externo'),
                        'label'=>'Procedencia del Paciente',
                        'empty_value'=>'Seleccione',
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        ))
                
            ->add('tipo', 'choice', 
                    array('choices'=>array(
                        'estudiante'=>'Estudiante',
                        'administrativo'=>'Administrativo',
                        'obrero'=>'Obrero',
                        'docente'=>'Docente'),
                        'label'=>'Tipo de Paciente',
                        'empty_value'=>'Seleccione',
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')))
                
            ->add('pfg', null,
                    array(
                        'label'=>'Programa de Formación de Grado',
                        'empty_value'=>'Seleccione',
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')))
                
            ->add('referencia', 'choice',
                    array(
                        'choices'=> array(
                            'intrahospitalaria'=>'Intrahospitalaria',
                            'extrahospitalaria'=>'Extrahospitalaria'),
                        'label'=>'Referencia',
                        'empty_value'=>'Seleccione',
                        'attr' => array('class' => 'form-control'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')))
                
                
            ->add('fechaRegistro')
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CDI\EnfermeriaBundle\Entity\Pacientes'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cdi_enfermeriabundle_pacientes';
    }
}
