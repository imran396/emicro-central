<?php

namespace Emicro\Bundle\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null, array(
                'constraints' => array(
                    new NotBlank()
                )
            ))
            ->add('lastName', null, array(
                'constraints' => array(
                    new NotBlank()
                )
            ))
            ->add('designation', null, array(
                'constraints' => array(
                    new NotBlank()
                )
            ))
            ->add('email', null, array(
                'constraints' => array(
                    new NotBlank(),
                    new Email()
                )
            ))
            ->add('contactNumber', null, array(
                'constraints' => array(
                    new NotBlank(),
                    new Regex(array(
                        'pattern' => '/\d/',
                        'match'   => true,
                        'message' => 'Phone number should be number',
                    ))
                )
            ))
            ->add('addresses', new AddressType())
            ->add('save', 'submit')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Emicro\Bundle\CoreBundle\Entity\Employee'
        ));
    }

    public function getName()
    {
        return 'emicro_bundle_corebundle_employeetype';
    }
}
