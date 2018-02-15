<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Snipe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Snipe controller.
 *
 * @Route("snipe")
 */
class SnipeController extends Controller
{
    /**
     * Lists all snipe entities.
     *
     * @Route("/", name="snipe_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $snipes = $em->getRepository('AppBundle:Snipe')->findAll();

        return $this->render('snipe/index.html.twig', array(
            'snipes' => $snipes,
        ));
    }

    /**
     * Creates a new snipe entity.
     *
     * @Route("/new", name="snipe_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $snipe = new Snipe();
        $form = $this->createForm('AppBundle\Form\SnipeType', $snipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($snipe);
            $em->flush();

            return $this->redirectToRoute('snipe_show', array('id' => $snipe->getId()));
        }

        return $this->render('snipe/new.html.twig', array(
            'snipe' => $snipe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a snipe entity.
     *
     * @Route("/{id}", name="snipe_show")
     * @Method("GET")
     */
    public function showAction(Snipe $snipe)
    {
        $deleteForm = $this->createDeleteForm($snipe);

        return $this->render('snipe/show.html.twig', array(
            'snipe' => $snipe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing snipe entity.
     *
     * @Route("/{id}/edit", name="snipe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Snipe $snipe)
    {
        $deleteForm = $this->createDeleteForm($snipe);
        $editForm = $this->createForm('AppBundle\Form\SnipeType', $snipe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('snipe_edit', array('id' => $snipe->getId()));
        }

        return $this->render('snipe/edit.html.twig', array(
            'snipe' => $snipe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a snipe entity.
     *
     * @Route("/{id}", name="snipe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Snipe $snipe)
    {
        $form = $this->createDeleteForm($snipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($snipe);
            $em->flush();
        }

        return $this->redirectToRoute('snipe_index');
    }

    /**
     * Creates a form to delete a snipe entity.
     *
     * @param Snipe $snipe The snipe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Snipe $snipe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('snipe_delete', array('id' => $snipe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
