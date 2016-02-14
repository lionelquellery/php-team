<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ParisFlat;
use AppBundle\Form\ParisFlatType;

/**
 * ParisFlat controller.
 *
 * @Route("school/{uai}/flat")
 */
class ParisFlatController extends Controller
{
    /**
     * Lists all ParisFlat entities.
     *
     * @Route("/", name="parisflat_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $parisFlats = $em->getRepository('AppBundle:ParisFlat')->findAll();

        return $this->render('parisflat/index.html.twig', array(
            'parisFlats' => $parisFlats,
        ));
    }

    /**
     * Creates a new ParisFlat entity.
     *
     * @Route("/new", name="parisflat_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $parisFlat = new ParisFlat();
        $form = $this->createForm('AppBundle\Form\ParisFlatType', $parisFlat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parisFlat);
            $em->flush();

            return $this->redirectToRoute('parisflat_show', array('id' => $parisflat->getId()));
        }

        return $this->render('parisflat/new.html.twig', array(
            'parisFlat' => $parisFlat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ParisFlat entity.
     *
     * @Route("/{id}", name="parisflat_show")
     * @Method("GET")
     */
    public function showAction(ParisFlat $parisFlat)
    {
        $deleteForm = $this->createDeleteForm($parisFlat);

        return $this->render('parisflat/show.html.twig', array(
            'parisFlat' => $parisFlat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ParisFlat entity.
     *
     * @Route("/{id}/edit", name="parisflat_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ParisFlat $parisFlat)
    {
        $deleteForm = $this->createDeleteForm($parisFlat);
        $editForm = $this->createForm('AppBundle\Form\ParisFlatType', $parisFlat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parisFlat);
            $em->flush();

            return $this->redirectToRoute('parisflat_edit', array('id' => $parisFlat->getId()));
        }

        return $this->render('parisflat/edit.html.twig', array(
            'parisFlat' => $parisFlat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ParisFlat entity.
     *
     * @Route("/{id}", name="parisflat_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ParisFlat $parisFlat)
    {
        $form = $this->createDeleteForm($parisFlat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($parisFlat);
            $em->flush();
        }

        return $this->redirectToRoute('parisflat_index');
    }

    /**
     * Creates a form to delete a ParisFlat entity.
     *
     * @param ParisFlat $parisFlat The ParisFlat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ParisFlat $parisFlat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('parisflat_delete', array('id' => $parisFlat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
