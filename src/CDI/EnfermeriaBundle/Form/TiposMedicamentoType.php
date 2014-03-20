<?php

namespace CDI\EnfermeriaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TiposMedicamentoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

                
                
                  ->add('nombre', 'text', 
                    array(
                        'label'=>'Tipo',
                        'required'  => true, 
                        'attr' => array('class' => 'form-control','placeholder' => 'Tipo de Medicamento'),
                        'label_attr' => array('class' => 'col-lg-2 control-label')
                        )
                    )
        ;

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CDI\EnfermeriaBundle\Entity\TiposMedicamento'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cdi_enfermeriabundle_tiposmedicamento';
    }
}
