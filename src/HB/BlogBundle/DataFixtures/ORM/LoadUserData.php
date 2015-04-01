<?php
namespace HB\BlogBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use HB\BlogBundle\Entity\User;

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
class LoadUserData  extends AbstractFixture implements OrderedFixtureInterface {
    
    public function load(ObjectManager $manager) {
        $user = new User();
        $user->setName('khalid') ;
        $user->setEmail('kaul128@free.fr');
        $user->setPassword('25555');
        $user->setBirthDate(new \DateTime('now'));
        $user->setCreationDate(new \DateTime('now'));
        $user->setLogin('kaul128');
        $user->setEnabled(true);
        $user->setLastEditDate(new \DateTime('now'));
     
        $manager->persist($user);
        
        
        $user1 = new User();
        $user1->setName('Marc') ;
        $user1->setEmail('Marc_br@free.fr');
        $user1->setPassword('sdh_552sndnb');
        $user1->setBirthDate(new \DateTime('now'));
        $user1->setCreationDate(new \DateTime('now'));
        $user1->setLogin('marco_14_mtp');
        $user1->setEnabled(true);
        $user1->setLastEditDate(new \DateTime('now'));
     
        $manager->persist($user1);
        
        
        
        $manager->flush();
        
    }

    public function getOrder() {
        return 1;
    }

//put your code here
}
