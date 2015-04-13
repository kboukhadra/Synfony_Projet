<?php
namespace HB\UserBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use HB\UserBundle\Entity\User;

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
class LoadUserData  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {
  // on peut pas faire un héritage multiple onc on va implémenter  ContainerAwareInterface 
    // on pouura généré setContainer
    private $container ;
    public function load(ObjectManager $manager) {
        $userManager = $this->container->get('fos_user_.user_manager');
        $user = $userManager->createUser();
       
       // $user->setName('fixturz') ;
        $user->setEmail('kaul128@free.fr');
        $user->setPlainPassword('25555');
        //$user->setBirthDate(new \DateTime('now'));
       // $user->setCreationDate(new \DateTime('now'));
        $user->setUserName('kaul128');
        $user->setEnabled(true);
        //$user->setLastEditDate(new \DateTime('now'));
        
        $userManager->updateUser($user);
        //$manager->persist($user);
        
       //////////////////////////////////////////////////////////////////////////////
        
        $user1 = $userManager->createUser();
        $user1->setUsername('khabliixifkvkjdfjv') ;
       // $user1->setName('Marc') ;
        $user1->setEmail('Marc_br@free.fr');
        $user1->setPlainPassword('sdh_552sndnb');
       // $user1->setBirthDate(new \DateTime('now'));
        //$user1->setCreationDate(new \DateTime('now'));
        $user1->setEnabled(true);
        //$user1->setLastEditDate(new \DateTime('now'));
        $userManager->updateUser($user1);
        //$manager->persist($user1);
        
        
        
        $manager->flush();
        // on stock  dans le repo des fixtures des objets à partager
         $this->addReference('user1', $user);
         $this->addReference('user2', $user1);
        
    }

    public function getOrder() {
        return 1;
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container=$container ;
    }

//put your code here
}
