<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;

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
     * @Route("/", name="amdin_index")
     * @Method("GET")
     */
  public function indexAction(Request $request)
  {

    $key = $request->query->get('key');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifyPermission($key) == true)
      return $this->render('admin/index.html.twig');
    else{
      $users = array('status' => 'You don\'t have the rights to access these datas');
      return new JsonResponse($users);
    }
  }
}
