<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;

/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends Controller
{

  /**
  * Lists all User entities.
  *
  * @Route("/", name="user_index")
  * @Method({"GET"})
  *
  * @param Request $request
  * @return JsonResponse
  */
  public function indexAction(Request $request)
  {

    $token = $request->query->get('token');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifySession($token))
      $users = $em->getRepository('AppBundle:User')->getAllUsers();
    else
      $users = $em->getRepository('AppBundle:User')->error();

    return new JsonResponse($users);
  }

  /**
  * Creates a new User entity.
  *
  * @Route("/new/", name="user_new")
  * @Method({"POST"})
  * 
  * @param Request $request
  * @return JsonResponse
  */
  public function newAction(Request $request)
  {

    $params = $request->request->all();

    $em = $this->getDoctrine()->getManager();

    $response = $em->getRepository('AppBundle:User')->registerNewUser($params);

    return new JsonResponse($response);

  }

  /**
  * Show user.
  *
  * @Route("/id/{id}/", name="user_show")
  * @Method({"GET"})
  * 
  * @param Request $request
  * @return JsonResponse
  */
  public function showAction($id, Request $request)
  {
    $token = $request->query->get('token');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifySession($token))
      $response = $em->getRepository('AppBundle:User')->getUser($id);
    else
      $response = $em->getRepository('AppBundle:User')->error();

    return new JsonResponse($response);

  }

  /**
  * Show edit.
  *
  * @Route("/{id}/edit/", name="user_edit")
  * @Method({"POST"})
  * 
  * @param Request $request
  * @return JsonResponse
  */
  public function editAction($id, Request $request)
  {

    $params = $request->request->all();

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifySession(params['token']))
      $response = $em->getRepository('AppBundle:User')->editUser($params, $id);
    else
      $response = $em->getRepository('AppBundle:User')->error();


    return new JsonResponse($response);

  }

  /**
   * Delete a user.
   *
   * @Route("/{id}/delete/", name="user_delete")
   * @Method({"DELETE"})
   *
   * @param Request $request
   * @param $id
   * @return JsonResponse
   */
  public function deleteAction(Request $request, $id)
  {

    $token = $request->query->get('token');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifySession($token))
      $status = $em->getRepository('AppBundle:User')->deleteUser($id);
    else
      $status = $em->getRepository('AppBundle:User')->error();

    return new JsonResponse($status);

  }

  /**
   * Get user by uai.
   *
   * @Route("/uai/{uai}/", name="user_uai")
   * @Method({"GET"})
   *
   * @param Request $request
   * @param $uai
   * @return JsonResponse
   */
  public function uaiAction(Request $request, $uai)
  {

    $token = $request->query->get('token');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifySession($token))
      $response = $em->getRepository('AppBundle:User')->getUserByUai($uai);
    else
      $response = $em->getRepository('AppBundle:User')->error();

    return new JsonResponse($response);

  }

  /**
   * Autentify a user.
   *
   * @Route("/connect/", name="user_connect")
   * @Method({"POST"})
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function connectAction(Request $request)
  {

    $pass = $request->request->get('pass');
    $mail = $request->request->get('mail');

    $em = $this->getDoctrine()->getManager();

    $response = $em->getRepository('AppBundle:User')->userConnect($pass, $mail);

    return new JsonResponse($response);

  }

  /**
   * Disconnect user
   *
   * @Route("/disconnect/{id}/", name="user_disconnect")
   * @Method({"GET"})
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function disconnetAction(Request $request, $id)
  {

    $token = $request->query->get('token');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifySession($token))
      $response = $em->getRepository('AppBundle:User')->disconnect($id);
    else
      $response = $em->getRepository('AppBundle:User')->error();


    return new JsonResponse($response);

  }

}


