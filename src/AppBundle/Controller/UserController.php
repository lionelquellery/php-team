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
  * @Method({"GET", "POST"})
  *
  * @param Request $request
  * @return JsonResponse
  */
  public function indexAction(Request $request)
  {

    $em = $this->getDoctrine()->getManager();

    $users = $em->getRepository('AppBundle:User')->getAllUsers();

    return new JsonResponse($users);
  }

  /**
  * Creates a new User entity.
  *
  * @Route("/new/", name="user_new")
  * @Method({"GET", "POST"})
  * 
  * @param Request $request
  * @return JsonResponse
  */
  public function newAction(Request $request)
  {

    $response = $request->query->all();

    $em = $this->getDoctrine()->getManager();

    $response = $em->getRepository('AppBundle:User')->registerNewUser($response);

    return new JsonResponse($response);

  }

  /**
  * Show user.
  *
  * @Route("/id/{id}/", name="user_show")
  * @Method({"GET", "POST"})
  * 
  * @param Request $request
  * @return JsonResponse
  */
  public function showAction($id, Request $request)
  {

    $em = $this->getDoctrine()->getManager();

    $response = $em->getRepository('AppBundle:User')->getUser($id);

    return new JsonResponse($response);

  }

  /**
  * Show edit.
  *
  * @Route("/{id}/edit/", name="user_edit")
  * @Method({"GET", "POST"})
  * 
  * @param Request $request
  * @return JsonResponse
  */
  public function editAction($id, Request $request)
  {

    $response = $request->query->all();

    $em = $this->getDoctrine()->getManager();

    $response = $em->getRepository('AppBundle:User')->editUser($response, $id);

    return new JsonResponse($response);

  }

  /**
   * Delete a user.
   *
   * @Route("/{id}/delete/", name="user_delete")
   * @Method({"GET", "POST", "DELETE"})
   *
   * @param Request $request
   * @param $id
   * @return JsonResponse
   */
  public function deleteAction(Request $request, $id)
  {

    $em = $this->getDoctrine()->getManager();

    $status = $em->getRepository('AppBundle:User')->deleteUser($id);

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

    $em = $this->getDoctrine()->getManager();

    $response = $em->getRepository('AppBundle:User')->getUserByUai($uai);

    return new JsonResponse($response);

  }

  /**
   * Autentify a user.
   *
   * @Route("/connect/", name="user_connect")
   * @Method({"GET"})
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function connectAction(Request $request)
  {

    $pass = $request->query->get('pass');
    $mail = $request->query->get('mail');

    $em = $this->getDoctrine()->getManager();

    $response = $em->getRepository('AppBundle:User')->userConnect($pass, $mail);

    return new JsonResponse($response);

  }
  
  /**
   * Disconnect user
   *
   * @Route("/disconnect/", name="user_disconnect")
   * @Method({"GET"})
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function disconnetAction(Request $request)
  {

    $token = $request->query->get('token');

    $em = $this->getDoctrine()->getManager();

    $response = $em->getRepository('AppBundle:User')->disconnect($token);

    return new JsonResponse($response);

  }

}


