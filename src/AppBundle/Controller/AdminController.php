<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ParisRestaurant;
use AppBundle\Form\ParisRestaurantType;
use AppBundle\Entity\ParisSchool;
use AppBundle\Form\ParisSchoolType;

/**
 * Admin controller.
 *
 * @Route("admin")
 */
class AdminController extends Controller
{
  /**
     * @Route("/", name="show")
     * @Method("GET")
     */
  public function showAction(Request $request)
  {

    $em = $this->getDoctrine()->getManager();

    $parisSchool = $em->getRepository('AppBundle:ParisSchool')->findAll();

    return $this->render('admin/index.html.twig', array(
      'parisSchool' => $parisSchool,
    ));
  }

  /**
     * @Route("/school/", name="admin_school")
     * @Method("GET")
     */
  public function schoolAction()
  {

    $em = $this->getDoctrine()->getManager();

    $parisSchool = $em->getRepository('AppBundle:ParisSchool')->findAll();

    return $this->render('admin/school.html.twig', array(
      'parisSchool' => $parisSchool,
    ));

  }

  /**
     * Displays a form to edit an existing ParisObject entity.
     *
     * @Route("/school/{uai}/edit/", name="school_edit")
     * @Method({"GET", "POST"})
     */
  public function editAction(Request $request, ParisSchool $parisSchool)
  {
    $deleteForm = $this->createDeleteForm($parisSchool);
    $editForm = $this->createForm('AppBundle\Form\ParisSchoolType', $parisSchool);
    $editForm->handleRequest($request);

    if ($editForm->isSubmitted() && $editForm->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($parisObject);
      $em->flush();

      return $this->redirectToRoute('school_edit', array('uai' => $parisSchool->getId()));
    }

    return $this->render('admin/edit.html.twig', array(
      'parisSchool' => $parisSchool,
      'edit_form' => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    ));
  }

  //  /**
  //     * Deletes a ParisObject entity.
  //     *
  //     * @Route("/{id}", name="object_delete")
  //     * @Method("DELETE")
  //     */
  //  public function deleteAction(Request $request, ParisObject $parisObject)
  //  {
  //    $form = $this->createDeleteForm($parisObject);
  //    $form->handleRequest($request);
  //
  //    if ($form->isSubmitted() && $form->isValid()) {
  //      $em = $this->getDoctrine()->getManager();
  //      $em->remove($parisObject);
  //      $em->flush();
  //    }
  //
  //    return $this->redirectToRoute('object_index');
  //  }
  //
  //  /**
  //     * Creates a form to delete a ParisObject entity.
  //     *
  //     * @param ParisObject $parisObject The ParisObject entity
  //     *
  //     * @return \Symfony\Component\Form\Form The form
  //     */
  //  private function createDeleteForm(ParisObject $parisObject)
  //  {
  //    return $this->createFormBuilder()
  //      ->setAction($this->generateUrl('object_delete', array('id' => $parisObject->getId())))
  //      ->setMethod('DELETE')
  //      ->getForm()
  //      ;
  //  }

  //  /**
  //     * @Route("/flat", name="flats")
  //     */
  //  public function flatAction(Request $request)
  //  {
  //
  //    return $this->render('admin/index.html.twig', array(
  //      'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
  //    ));
  //  }
  //
  //  /**
  //     * @Route("/object", name="objects")
  //     */
  //  public function objectAction(Request $request)
  //  {
  //
  //    return $this->render('admin/index.html.twig', array(
  //      'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
  //    ));
  //  }

}