<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Builder
 *
 * @author hb
 */
namespace HB\BlogBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        // creation du menu
        $menu = $factory->createItem('root',array('childrenAttributes' => array('class' => 'nav')));
        
        //crétion des sous menus qui pointe vers les différentes routes
        $menu->addChild('Home', array('route' => 'blog_index'));
               // crée li liste articles qui pointe vers la route article
        $menu->addChild('Liste des articles', array('route' => 'article'));


        // access services from the container!
        $em = $this->container->get('doctrine')->getManager();
        // findMostRecent and Blog are just imaginary examples
        // récupere les 10 derniers
        $articles = $em->getRepository('HBBlogBundle:Article')->getHomePageArticles(10);
      // j'ajoute mon li qui sera le 3 eme "Dernier articles"
        $menu->addChild('Dernier articles', array('uri' => "#"));
        // on applique une balise link <a>Dernier articles</a> il aura un class et data-tooggle comme attribut
        $menu['Dernier articles'] ->setLinkAttribute('class','dropdown-toggle');
        $menu['Dernier articles'] ->setLinkAttribute('data-toggle', 'dropdown');

        // sur li qui est au dessus de la link <a> on ajoute un balsie class
        $menu['Dernier articles']->setAttribute('class', 'dropdown');
         //puis dans le sous menu <ul> aura un class="dropdown-menu"
        $menu['Dernier articles']->setChildrenAttribute('class' ,'dropdown-menu');

       
       // on affiche chaque article
       foreach( $articles as $article){
       $menu['Dernier articles']->addChild($article->getTitle().'------'.$article->getPublishDate()->format('m-Y') ,
                      array('route'=>'article_show',
                  'routeParameters'=>array('id'=>$article->getId())
              ));

           }

        return $menu;
    }
}
