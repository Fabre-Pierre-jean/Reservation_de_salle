<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Home2;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Home2 controller.
 *
 * @Route("home2")
 */
class HomeController2 extends Controller
{
    /**
     * Lists all home entities.
     *
     * @Route("/", name="home2_index", methods={"GET", "POST"})
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $homes = $em->getRepository('AppBundle:Home2')->AllOrderedByNameAsc();

        return $this->render('home2/index.html.twig', array(
            'homes' => $homes,
        ));
    }

    /**
     * Creates a new home entity.
     *
     * @Route("/new", name="home2_new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $home = new Home2();
        $form = $this->createForm('AppBundle\Form\HomeType2', $home);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($home);
            $em->flush();

            return $this->redirectToRoute('home2_show', array('id' => $home->getId()));
        }

        return $this->render('home2/new.html.twig', array(
            'home' => $home,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a home entity.
     *
     * @Route("/{id}", name="home2_show", methods={"GET", "POST"})
     */
    public function showAction(Home2 $home)
    {
        $deleteForm = $this->createDeleteForm($home);

        return $this->render('home2/show.html.twig', array(
            'home' => $home,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing home entity.
     *
     * @Route("/{id}/edit", name="home2_edit", methods={"GET", "POST"})
     */
    public function editAction(Request $request, Home2 $home)
    {
        $deleteForm = $this->createDeleteForm($home);
        $editForm = $this->createForm('AppBundle\Form\HomeType2', $home);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home2_index');
        }

        return $this->render('home2/edit.html.twig', array(
            'home' => $home,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a home entity.
     *
     * @Route("/{id}", name="home2_delete", methods={"DELETE"})
     */
    public function deleteAction(Request $request, Home2 $home2)
    {
        $form = $this->createDeleteForm($home2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($home2);
            $em->flush();
        }

        return $this->redirectToRoute('home2_index');
    }

    /**
     * Creates a form to delete a home entity.
     *
     * @param Home2 $home2 The home2 entity
     *
     * @return \Symfony\Component\Form\FormInterface The form
     */
    private function createDeleteForm(Home2 $home2)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('home2_delete', array('id' => $home2->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
