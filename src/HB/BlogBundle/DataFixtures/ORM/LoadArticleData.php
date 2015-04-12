<?php
namespace HB\BlogBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
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
class LoadArticleData  extends AbstractFixture implements OrderedFixtureInterface {
    /**
     * 
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        // on récupere le réferences
        $user=$this->getReference('user1') ;
        $user1=$this->getReference('user2') ;



             for ($j = 0; $j < 50; $j++) {
                 $string = "";
                 $chaine ="abcd ef ghijkl mnopq rstuvw" ;
                 $chaine1 = "ab c de f gh ijk lm n pqr stuvwxyABC D E F G H I J LMNOPQRSTU VWXYZ";
                 srand((double)microtime()*1000000);
                 for($i=0; $i< 15 ; $i++) {
                     $string .= $chaine[rand()%strlen($chaine)];
                 }
                 $article2 = new Article();
                 $article2->setTitle($string);

                 $content="";
                 for($i=0; $i< 200 ; $i++) {
                     $content .= $chaine1[rand()%strlen($chaine1)];
                 }
                 $article2->setContent($content);
                 $article2->setPublished(true);
                 $article2->setEnabled(true);
                 $article2->setAuthor($user1);
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

//put your code here
}
