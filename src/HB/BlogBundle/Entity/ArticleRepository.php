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
    private $limit = 2;
    /**
     * 
     * @param type $page
     * @return type
     */
    public function getHomePageArticles($page = 1) {
      
        // offset c est la 1er entrée numero offset 
        $offset = $page*($this->limit);

        return $this->findBy(
                        // tous les critère sont a true
                        array('published' => true, 'enabled' => true), array('publishDate' => 'desc'), $this->limit, $offset
        );
    }

    /**
     * 
     * renvoie le nombre de page correspondant à la limite
     */
    public function getCountPage() {
        
        $nbArticles = $this->createQueryBuilder('a')
                ->where('a.published = 1 ')
                ->andWhere('a.enabled = 1')
                ->select('count(a)')
                ->getQuery() // déclenche la requete
                ->getSingleScalarResult() ;// renvoie le nombre
        
        return (int)ceil($nbArticles/$this->limit) ;
    }

}
