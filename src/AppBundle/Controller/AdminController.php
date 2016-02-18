<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Entity\ParisFlat;

/**
 * Admin controller.
 *
 * @Route("admin")
 */
class AdminController extends Controller
{
  /**
     * Index of Admin.
     *
     * @Route("/", name="admin_index")
     * @Method({"GET", "POST"})
     */
  public function indexAction(Request $request)
  {

    $key = $request->query->get('key');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifyPermission($key) == true)
      return $this->render('admin/index.html.twig', array(
        'key' => $key
      ));
    else{
      $users = array('status' => 'You don\'t have the rights to access these datas');
      return new JsonResponse($users);
    }
  }

  /**
     * See all schools
     *
     * @Route("/school/", name="admin_school")
     * @Method({"GET", "POST"})
     */
  public function schoolAction(Request $request)
  {

    $key = $request->query->get('key');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifyPermission($key) == true){
      $schools = $em->getRepository('AppBundle:ParisSchool')->findAll();
      return $this->render('admin/school.html.twig',array(
        'schools' => $schools,
        'key'     => $key
      ));
    }
    else{
      $users = array('status' => 'You don\'t have the rights to access these datas');
      return new JsonResponse($users);
    }
  }

  /**
     * See all users
     *
     * @Route("/user/", name="admin_user")
     * @Method({"GET", "POST"})
     */
  public function userAction(Request $request)
  {

    $key = $request->query->get('key');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifyPermission($key) == true){
      $users = $em->getRepository('AppBundle:User')->getAllUsers($key);      
      return $this->render('admin/user.html.twig', array(
        'users' => $users,
        'key'   => $key
      ));
    }
    else{
      $users = array('status' => 'You don\'t have the rights to access these datas');
      return new JsonResponse($users);
    }
  }

  /**
     * Delete user
     *
     * @Route("/user/delete/{id}/", name="admin_deleteuser")
     * @Method({"GET", "POST", "DELETE"})
     */
  public function duserAction(Request $request, $id)
  {

    $key = $request->query->get('key');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifyPermission($key) == true){
      return $this->render('admin/duser.html.twig', array(
        'id' => $id,
        'key'   => $key
      ));
    }
    else{
      $users = array('status' => 'You don\'t have the rights to access these datas');
      return new JsonResponse($users);
    }
  }

  /**
     * See one school
     *
     * @Route("/school/{uai}/", name="admin_schoolshow")
     * @Method({"GET", "POST"})
     */
  public function schoolshowAction(Request $request, $uai)
  {

    $key = $request->query->get('key');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifyPermission($key) == true){

      $school = $em->getRepository('AppBundle:ParisSchool')->getByUai($uai);

      $flats  = $em->getRepository('AppBundle:ParisFlat')->getFlatsByUai($uai);

      return $this->render('admin/schoolshow.html.twig', array(
        'flats'   => $flats,
        'key'     => $key,
        'schools' => $school
      ));
    }
    else{
      $users = array('status' => 'You don\'t have the rights to access these datas');
      return new JsonResponse($users);
    }
  }

  /**
     * See one school
     *
     * @Route("/school/{uai}/flat/{id}", name="admin_flatshow")
     * @Method({"GET", "POST"})
     */
  public function flatshowAction(Request $request, $id)
  {

    $key = $request->query->get('key');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifyPermission($key) == true){

      $flat = $em->getRepository('AppBundle:ParisFlat')->getFlatbyId($id);

      return $this->render('admin/schoolshow.html.twig', array(
        'flat'    => $flat,
        'key'     => $key
      ));
    }
    else{
      $users = array('status' => 'You don\'t have the rights to access these datas');
      return new JsonResponse($users);
    }
  }

}
