<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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
  * @Method({"GET"})
  *
  * @param Request $request
  * @return JsonResponse
  */
  public function indexAction(Request $request)
  {

    $string = $request->query->get('search');

    $em = $this->getDoctrine()->getManager();

    $school = $em->getRepository('AppBundle:ParisSchool')->search($string);

    return new JsonResponse($school);

  }

  /**
  * Finds and displays a ParisSchool entity.
  *
  * @Route("/{uai}/", name="school_show")
  * @Method({"GET"})
  *
  * @param ParisSchool $parisSchool
  * @param Request $request
  * @return JsonResponse
  */
  public function showAction(ParisSchool $parisSchool, Request $request)
  {

    $radius = $request->query->get('radius');
    $token = $request->query->get('token');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifySession($token)){

      $school = $em->getRepository('AppBundle:ParisSchool')->getArray($parisSchool);    

      $response = array('code' => 200, 'response' => $school);
    }
    else
      $response = $em->getRepository('AppBundle:User')->error();

    return new JsonResponse($response);

  }

}
