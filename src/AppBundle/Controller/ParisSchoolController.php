<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ParisSchool;
use AppBundle\Form\ParisSchoolType;

/**
 * ParisSchool controller.
 *
 * @Route("/school")
 */
class ParisSchoolController extends Controller
{
    /**
     * Lists all ParisSchool entities.
     *
     * @Route("/", name="school_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $parisSchools = $em->getRepository('AppBundle:ParisSchool')->findAll();

        return $this->render('parisschool/index.html.twig', array(
            'parisSchools' => $parisSchools,
        ));
    }

    /**
     * Creates a new ParisSchool entity.
     *
     * @Route("/new", name="school_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $parisSchool = new ParisSchool();
        $form = $this->createForm('AppBundle\Form\ParisSchoolType', $parisSchool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parisSchool);
            $em->flush();

            return $this->redirectToRoute('school_show', array('id' => $parisschool->getId()));
        }

        return $this->render('parisschool/new.html.twig', array(
            'parisSchool' => $parisSchool,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ParisSchool entity.
     *
     * @Route("/{id}", name="school_show")
     * @Method("GET")
     */
    public function showAction(ParisSchool $parisSchool)
    {
        $deleteForm = $this->createDeleteForm($parisSchool);

        return $this->render('parisschool/show.html.twig', array(
            'parisSchool' => $parisSchool,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ParisSchool entity.
     *
     * @Route("/{id}/edit", name="school_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ParisSchool $parisSchool)
    {
        $deleteForm = $this->createDeleteForm($parisSchool);
        $editForm = $this->createForm('AppBundle\Form\ParisSchoolType', $parisSchool);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parisSchool);
            $em->flush();

            return $this->redirectToRoute('school_edit', array('id' => $parisSchool->getId()));
        }

        return $this->render('parisschool/edit.html.twig', array(
            'parisSchool' => $parisSchool,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ParisSchool entity.
     *
     * @Route("/{id}", name="school_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ParisSchool $parisSchool)
    {
        $form = $this->createDeleteForm($parisSchool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($parisSchool);
            $em->flush();
        }

        return $this->redirectToRoute('school_index');
    }

    /**
     * Creates a form to delete a ParisSchool entity.
     *
     * @param ParisSchool $parisSchool The ParisSchool entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ParisSchool $parisSchool)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('school_delete', array('id' => $parisSchool->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
