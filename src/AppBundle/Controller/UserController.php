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
     * @Method("GET")
     */
  public function indexAction()
  {

    $em = $this->getDoctrine()->getManager();

    $users = $em->getRepository('AppBundle:User')->findAll();

    return new JsonResponse($users);
  }

  /**
     * Creates a new User entity.
     *
     * @Route("/new/", name="user_new")
     * @Method({"GET", "POST"})
     */
  public function newAction(Request $request)
  {

    $mail = $request->query->get('mail');

    $em = $this->getDoctrine()->getManager();

    $response = $em->getRepository('AppBundle:User')->registerNewUser($mail);

    return new JsonResponse($response);

  }

}
