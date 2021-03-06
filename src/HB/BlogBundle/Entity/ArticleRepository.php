<?php

namespace HB\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository {

    public function getHomePageArticles($limit =null) {

        /*cette methode retourne tous les articles qui on pubished=true
        et enabled=true en décroissant sur les publishDate et pas de limite
         *
         */
        return $this->findBy(
                        // tous les critère sont a true
                        array('published' => true, 'enabled' => true),
                        //du plus
                        array('publishDate' => 'desc'),
                        $limit
        );
    }

    

}
