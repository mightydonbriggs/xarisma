<?php

namespace XarismaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('stationcode')
            ->add('description')
            ->add('notes')
            ->add('datecreated')
            ->add('dateupdated')
            ->add('deleted')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'XarismaBundle\Entity\Station'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'xarismabundle_station';
    }
}
