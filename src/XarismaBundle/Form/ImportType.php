<?php

namespace XarismaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImportType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('importTime')
            ->add('filename')
            ->add('md5')
            ->add('status')
            ->add('recs')
            ->add('errors')
            ->add('customerNew')
            ->add('customerUpdate')
            ->add('orderNew')
            ->add('orderUpdate')
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
            'data_class' => 'XarismaBundle\Entity\Import'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'xarismabundle_import';
    }
}
