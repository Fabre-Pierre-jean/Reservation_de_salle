<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Home;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Home controller.
 *
 * @Route("home")
 */
class HomeController extends Controller
{
    /**
     * Lists all home entities.
     *
     * @Route("/", name="home_index", methods={"GET", "POST"})
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $homes = $em->getRepository('AppBundle:Home')->findAll();

        return $this->render('home/index.html.twig', array(
            'homes' => $homes,
        ));
    }

    /**
     * Creates a new home entity.
     *
     * @Route("/new", name="home_new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $home = new Home();
        $form = $this->createForm('AppBundle\Form\HomeType', $home);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($home);
            $em->flush();

            return $this->redirectToRoute('home_index');
        }

        return $this->render('home/new.html.twig', array(
            'home' => $home,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a home entity.
     *
     * @Route("/{id}", name="home_show", methods={"GET", "POST"})
     */
    public function showAction(Home $home)
    {
        $deleteForm = $this->createDeleteForm($home);

        return $this->render('home/show.html.twig', array(
            'home' => $home,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing home entity.
     *
     * @Route("/{id}/edit", name="home_edit", methods={"GET", "POST"})
     */
    public function editAction(Request $request, Home $home)
    {
        $deleteForm = $this->createDeleteForm($home);
        $editForm = $this->createForm('AppBundle\Form\HomeType', $home);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home_index');
        }

        return $this->render('home/edit.html.twig', array(
            'home' => $home,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Deletes a home entity.
     *
     * @Route("/{id}", name="home_delete", methods={"DELETE"})
     */
    public function deleteAction(Request $request, Home $home)
    {
        $form = $this->createDeleteForm($home);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($home);
            $em->flush();
        }

        return $this->redirectToRoute('home_index');
    }

    /**
     * Creates a form to delete a home entity.
     *
     * @param Home $home The home entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Home $home)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('home_delete', array('id' => $home->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
