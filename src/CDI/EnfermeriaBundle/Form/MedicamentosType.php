<?php

namespace CDI\EnfermeriaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MedicamentosType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

           ->add('principioActivo', 'text', 
                    array(
                        'label'=>'Principio Activo',
                        'required'  => true, 
                        'attr' => array('class' => 'form-control','placeholder' => 'Principio Activo del Medicamento'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        )) 
            
                
            ->add('stock', 'integer', 
                    array(
                        'label'=>'Stock',
                        'required'  => true, 
                        'attr' => array(
                            'class' => 'form-control','placeholder' => 'Cantidad que debe de existir en el inventario'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        )) 
                 
                        
            ->add('disponible', 'integer', 
                    array(
                        'label'=>'Disponible',
                        'required'  => true,
                        'attr' => array('placeholder' => 'Cantidad disponible'),
                        'label_attr' => array('class' => 'col-lg-2 control-label'))
                    )
                
            ->add('tipoMedicamento', null, 
                    array(
                        'required'  => true,
                        'label_attr' => array(
                            'class' => 'col-lg-2 control-label'),
                        'label'=>'Tipo','empty_value'=>'Seleccione',
                        'attr' => array(
                            'class' => 'form-control',
                            'placeholder' => 'Cantidad que debe existir en el inventario'),
                        
                        )) 
                
                             
            ->add('disponible', 'integer', 
                    array(
                        'label'=>'Cantidad Disponible',
                        'required'  => true, 
                        'attr' => array('class' => 'form-control','placeholder' => 'Cantidad disponible'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        ))

                
             ->add('tipoMedicamento',
                     null,
                    array(
                        'label'=>'Tipo de Medicamento',
                        'empty_value'=>'Seleccione',
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
            'data_class' => 'CDI\EnfermeriaBundle\Entity\Medicamentos'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cdi_enfermeriabundle_medicamentos';
    }
}
