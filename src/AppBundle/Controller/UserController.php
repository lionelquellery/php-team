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
     */
  public function indexAction(Request $request)
  {

    $key = $request->query->get('key');

    $em = $this->getDoctrine()->getManager();

    if(is_null($key)){
      $users = array("statut" => 'Data missing');
    }
    else {
      if($em->getRepository('AppBundle:User')->verifyPermission($key) == true)
        $users = $em->getRepository('AppBundle:User')->getAllUsers();
      else
        $users = array('status' => 'You don\'t have the rights to access these datas');
    }

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

    $pass = $request->query->get('pass');

    $em = $this->getDoctrine()->getManager();

    $response = $em->getRepository('AppBundle:User')->registerNewUser($mail,$pass);

    return new JsonResponse($response);

  }

  /**
     * Returns user token.
     *
     * @Route("/token/", name="user_token")
     * @Method({"GET", "POST"})
     */
  public function tokenAction(Request $request)
  {

    $mail = $request->query->get('mail');

    $pass = $request->query->get('pass');

    $em = $this->getDoctrine()->getManager();

    $response = $em->getRepository('AppBundle:User')->verifyUser($mail,$pass);

    return new JsonResponse($response);

  }

}
