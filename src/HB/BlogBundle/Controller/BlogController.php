<?php

namespace HB\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\BrowserKit\Request;


class BlogController extends Controller {

    /**
     * liste de blogs
     * @Route("/", name="blog_index")
     * @Route("/page/{page}", name="blog_index_page")
     * @Template()
     */
    public function indexAction($page = 1) {
        $em = $this->getDoctrine()->getManager();
        //on charge le repo d'article
        $repo = $em->getRepository('HBBlogBundle:Article');

        // nous retourne les articles avec un limite=$page

        $articles =$repo->getHomePageArticles() ;

        // on récupere le service paginator
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $articles,// liste des articles ou query
                $page,// numéro de page
               10// nombre d'article par page
        );

        $pagination->setUsedRoute('blog_index_page');

        $session = $this->get('session');
        $session->set('page', $page);
        return array(
            'pagination'=>$pagination,

           
        );
    }
    /**
     * Finds and displays a Article entity.
     *
     * @Route("blog/{slug}", name="article_slug")
     * @Template()
     */
     public function showAction($slug="")
    {
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository('HBBlogBundle:Article');
            // on récupere le repository de article
        $article= $repo->findOneBy((array("slug"=>$slug)));
        return array('article'=>$article);
    }

   

}
