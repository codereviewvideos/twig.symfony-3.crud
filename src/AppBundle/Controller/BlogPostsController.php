<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BlogPost;
use AppBundle\Form\Type\BlogPostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogPostsController extends Controller
{
    /**
     * @Route("/", name="list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $blogPosts = $em->getRepository('AppBundle:BlogPost')->findAll();

        return $this->render('BlogPosts/list.html.twig', [
            'blog_posts' => $blogPosts,
        ]);
    }

    /**
     * @param Request $request
     * @Route("/create", name="create")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(BlogPostType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * @var $blogPost BlogPost
             */
            $blogPost = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($blogPost);
            $em->flush();

            // for now
            return $this->redirectToRoute('edit', [
                'blogPost' => $blogPost->getId(),
            ]);

        }

        return $this->render('BlogPosts/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request  $request
     * @param BlogPost $blogPost
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/edit/{blogPost}", name="edit")
     */
    public function editAction(Request $request, BlogPost $blogPost)
    {
        $form = $this->createForm(BlogPostType::class, $blogPost);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // for now
            return $this->redirectToRoute('edit', [
                'blogPost' => $blogPost->getId(),
            ]);

        }

        return $this->render('BlogPosts/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request  $request
     * @param BlogPost $blogPost
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/delete/{blogPost}", name="delete")
     */
    public function deleteAction(Request $request, BlogPost $blogPost)
    {
        if ($blogPost === null) {
            return $this->redirectToRoute('list');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($blogPost);
        $em->flush();

        return $this->redirectToRoute('list');
    }
}