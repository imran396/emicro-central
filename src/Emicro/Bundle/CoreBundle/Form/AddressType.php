<?php

namespace Emicro\Bundle\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('street', null, array(
                'attr' => array(
                    'class' => 'NumberAnwer'
                )
            ))
            ->add('city')
            ->add('state')
            ->add('postalCode', 'text')
            ->add('country')
            ->add('isPresent')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Emicro\Bundle\CoreBundle\Entity\Address'
        ));
    }

    public function getName()
    {
        return 'emicro_bundle_corebundle_addresstype';
    }
}
