<?php

namespace HB\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'repeated', array(
                   'type'=>'email',
                    'invalid_message'=> 'les mots de passe doivent correspondre',
                    'options'=> array('required'=>false),
                    'first_options'  => array('label' => 'Email'),
                    'second_options' => array('label' => 'Email (confirmation)'),
                    ) )
            ->add('name')
            ->add('login')
            ->add('password')
                // j'affiche  les 20 premiere dans BirthDate
            ->add('creationDate','datetime', array('years'=>  range(date('Y')-20, date('Y'))))
            ->add('lastEditDate','datetime')
            ->add('enabled')
                
                // cela charge les années en 150 ans
            ->add('birthDate','birthday')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HB\BlogBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hb_blogbundle_user';
    }
}
