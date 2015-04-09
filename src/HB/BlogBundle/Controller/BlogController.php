<?php

namespace HB\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BlogController extends Controller
{
    
     /**
      * liste de blogs
     * @Route("/", name="blog_index")
      * @Route("/page/{page}", name="blog_index_page")
     * @Template()
     */
    public function indexAction($page = 1)
    {
        $em = $this->getDoctrine()->getManager();
        
        $repo=$em->getRepository('HBBlogBundle:Article');
        $nbPages = $repo->getCountPage() ;
        
        if($page <1){
            return $this->redirectToRoute('blog_index');
        }
        
        if( $page > $nbPages){
            return $this->redirectToRoute('blog_index_page' , array("page"=>$nbPages));
        }
        
        $articles = $repo->getHomePageArticles($page-1) ;
        
        $lienPageSuivante = $this->generateUrl('blog_index_page', array("page"=> $page+1));
        $lienPagePrecedente = $this->generateUrl('blog_index_page', array("page"=> $page-1));
        
        return array(
            'articles' => $articles,
            'nbpages' => $nbPages,
            'lienPageSuivante'=> $lienPageSuivante ,
            'lienPagePrecedente'=> $lienPagePrecedente 
            
        );
    }
    
    
     /**
     * @Route("/{slug}", name="blog_show")
     * @Template()
     */
    public function showAction()
    {
        return array();
    }
    
    
    
}
