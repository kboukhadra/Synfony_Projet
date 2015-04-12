<?php

namespace HB\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use HB\BlogBundle\Entity\Article;
use HB\BlogBundle\Form\ArticleType;

/**
 * Article controller.
 *
 * @Route("/article")
 */
class ArticleController extends Controller
{

    /**
     * Lists all Article entities.
     * 
     * @Route("/", name="article")
     * @Method("GET")
     * l'annotation ci dessous permet de spécifier que l'action est lié directement au template
     * @Template()
     */
    public function indexAction()
    {
        //  récupération de doctrine
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('HBBlogBundle:Article:index')->findAll();

        return array(
            'articles' => $articles,
        );
    }
    /**
     * Creates a new Article entity.
     *
     * @Route("/", name="article_create")
     * @Method("POST")
     * @Template("HBBlogBundle:Article:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $article = new Article();
        $form = $this->createCreateForm(article);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirect($this->generateUrl('article_show', array('id' => $article->getId())));
        }

        return array(
            'article' => $article,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Article entity.
     *
     * @param Article $article The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Article $article)
    {
        $form = $this->createForm(new ArticleType(), $article/*, array(
            'action' => $this->generateUrl('article_create'),
            'method' => 'POST',
        )*/);
            // 'attr' permet d'ajouter un attribut dans mon input
        $form->add('submit', 'submit', array('label' => 'Create',
            'attr' => array('class' => 'btn btn-primary')
            ));

        return $form;
    }

    /**
     * Displays a form to create a new Article entity.
     *
     * @Route("/new", name="article_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $article = new Article();
        $form   = $this->createCreateForm($article);

        return array(
            'article' => $article,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Article entity.
     *
     * @Route("/{id}", name="article_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('HBBlogBundle:Article')->find($id);

        if (!$article) {
            throw $this->createNotFoundException('Unable to find Article article.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'article'      => $article,
            'delete_form' => $deleteForm->createView(),
        );
    }



    /**
     * Finds and displays a Article entity.
     *
     * @Route("/voir/{id}", name="article_show_user")
     * @Method("GET")
     * @Template()
     */
    public function show_userAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('HBBlogBundle:Article')->find($id);

        if (!$article) {
            throw $this->createNotFoundException('Unable to find Article article.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'article'      => $article,

        );
    }




    /**
     * Displays a form to edit an existing Article article.
     *
     * @Route("/{id}/edit", name="article_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('HBBlogBundle:Article')->find($id);

        if (!$article) {
            throw $this->createNotFoundException('Unable to find Article article.');
        }

        $editForm = $this->createEditForm($article);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'article'      => $article,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Article article.
    *
    * @param Article $article The article
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Article $article)
    {
        $form = $this->createForm(new ArticleType(), $article, array(
            'action' => $this->generateUrl('article_update', array('id' => $article->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update',
            'attr' => array('class' => 'btn btn-primary')
            ));

        return $form;
    }
    /**
     * Edits an existing Article entity.
     *
     * @Route("/{id}", name="article_update")
     * @Method("PUT")
     * @Template("HBBlogBundle:Article:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('HBBlogBundle:Article')->find($id);

        if (!$article) {
            throw $this->createNotFoundException('Unable to find Article article.');
        }
        
        //gérer la datetime de derniere edition
        $article->setLastEditDate(new \DateTime()) ;

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($article);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('article_edit', array('id' => $id)));
        }

        return array(
            'article'      => $article,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Article article.
     *
     * @Route("/{id}", name="article_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $article = $em->getRepository('HBBlogBundle:Article')->find($id);

            if (!$article) {
                throw $this->createNotFoundException('Unable to find Article article.');
            }

            $em->remove($article);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('article'));
    }

    /**
     * Creates a form to delete a Article article by id.
     *
     * @param mixed $id The article id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('article_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete',
                'attr' => array('class' => 'btn btn-primary')
                ))
            ->getForm()
        ;
    }
}
