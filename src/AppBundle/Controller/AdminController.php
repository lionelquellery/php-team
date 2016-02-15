<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ParisSchool;
use AppBundle\Form\ParisSchoolType;
use AppBundle\Entity\ParisFlat;
use AppBundle\Form\ParisFlatType;
use AppBundle\Entity\ParisObject;
use AppBundle\Form\ParisObjectType;

/**
 * Admin controller.
 *
 * @Route("admin")
 */
class AdminController extends Controller
{
  /**
     * @Route("/", name="admin_index")
     * @Method("GET")
     */
  public function indexAction(Request $request)
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
     * @Route("/school/{uai}/show/", name="admin_show")
     * @Method({"GET", "POST"})
     */
  public function showAction(Request $request, ParisSchool $parisSchool)
  {

    $uai = $parisSchool->getUai();

    $em = $this->getDoctrine()->getRepository('AppBundle:ParisObject');

    $query = $em->createQueryBuilder('o')
      ->where('o.uai = :uai')
      ->setParameter('uai', $uai)
      ->getQuery();

    $objects = $query->getResult();

    $em = $this->getDoctrine()->getRepository('AppBundle:ParisFlat');

    $query = $em->createQueryBuilder('f')
      ->where('f.uai = :uai')
      ->setParameter('uai', $uai)
      ->getQuery();

    $flats = $query->getResult();

    return $this->render('admin/show.html.twig', array(
      'school'  => $parisSchool,
      'objects' => $objects,
      'flats'   => $flats,
    ));
  }

  /**
     * Displays a form to edit an existing ParisFlat entity.
     *
     * @Route("/school/{uai}/show/flat/{id}/", name="admin_flat")
     * @Method({"GET", "POST"})
     */
  public function flatAction(Request $request, ParisFlat $parisFlat)
  {

    return $this->render('admin/subshow.html.twig', array(
      'obj'  => $parisFlat,
    ));
  }

  /**
     * Displays a form to edit an existing ParisObject entity.
     *
     * @Route("/school/{uai}/show/object/{id}/", name="admin_object")
     * @Method({"GET", "POST"})
     */
  public function objectAction(Request $request, ParisObject $parisObject)
  {

    return $this->render('admin/subshow.html.twig', array(
      'obj'  => $parisObject,
    ));
  }

  //  /**
  //       * Deletes a ParisObject entity.
  //       *
  //       * @Route("/school/{uai}/show/", name="object_delete")
  //       * @Method("DELETE")
  //       */
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
  //    return $this->redirectToRoute('admin_show');
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