<?php
namespace HB\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use HB\BlogBundle\Entity\Article;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadUserData
 *
 * @author hb
 */
class LoadArticleData  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {
    /**
     * 
     * @param ObjectManager $manager
     */
     private $container ;
    public function load(ObjectManager $manager) {
        // on récupere le réferences
        $user=$this->getReference('user1') ;
        $user1=$this->getReference('user2') ;
            
            $slugger =$this->container->get('hb_blog.slugger');

             for ($i = 0; $i < 50; $i++) {
                $article2 = new Article();
                 $article2->setTitle('titre '.$i);
                 $article2->setContent('dfjjdf kdfjkvjk  djkfkjvjkd kkdqfkkjvdjk');
                 $article2->setPublished(true);
                 $article2->setEnabled(true);
                 $article2->setAuthor($user1);
                 $article2->setSlug($slugger->getSlug($i."---".$article2->getTitle()));
                 $manager->persist($article2);

             }



       /* for($i=0 ; $i< 50 ; $i++){
        $article2 = new Article();
        $article2->setTitle('2eme titre de mon article'.$i);
        $article2->setContent('kjsfhrjfkjkskdfkqsjdkfkks');
        $article2->setPublished(true);
        $article2->setEnabled(true);
        $article2->setAuthor($user1);
        $manager->persist($article2);
        }*/
        $manager->flush();
        
        
         
    }
/**
 * permet de définir l'ordre de chargement des fixtures
 * @return int
 */
    public function getOrder() {
        // loadArticle se lancera en deuxieme
        return 2;
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container=$container ;
    }
}
