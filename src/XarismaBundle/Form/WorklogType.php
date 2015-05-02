<?php

namespace XarismaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WorklogType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('stationstatus')
            ->add('comments')
            ->add('datecreated')
            ->add('dateupdated')
            ->add('deleted')
            ->add('station')
            ->add('order')
            ->add('user')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'XarismaBundle\Entity\Worklog'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'xarismabundle_worklog';
    }
}
