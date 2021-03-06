<?php

namespace HB\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text')
            ->add('content')
            ->add('slug', 'text', array('required'=>false))
            //->add('creationDate')// ce champ s'initilise avec le constructeur Article
            ->add('publishDate',"datetime")
           // ->add('lastEditDate')
            ->add('published','checkbox', array('required'=>false),"datetime")
            ->add('enabled','checkbox', array('required'=>false))
            ->add('author','entity',array('class'=>'HBUserBundle:User',
                                            'property'=> 'username' ))
            ->add('banner', new ImageType()) ;   
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HB\BlogBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hb_blogbundle_article';
    }
}
