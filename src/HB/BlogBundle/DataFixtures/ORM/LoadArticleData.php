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
       
        $article = new Article();
        $article->setTitle('titre de mon article');
        $article->setContent('sdfdrfgd,gnndnfgndkjgknkrdjgkkndknfknrkdrkk,rd');
        $article->setPublished(true);
        // on applique l'auteur à notre article
        $article->setAuthor($user);

        $manager->persist($article);
        
        $article2 = new Article();
        $article2->setTitle('2eme titre de mon article');
        $article2->setContent('kjsfhrjfkjkskdfkqsjdkfkks');
        $article2->setPublished(true);
        $article2->setAuthor($user1);
        
        $manager->persist($article2);
       
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
