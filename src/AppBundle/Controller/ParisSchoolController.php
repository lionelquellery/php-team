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
  * @Method({"GET", "POST"})
  *
  * @param Request $request
  * @return JsonResponse
  */
  public function indexAction(Request $request)
  {

    $key = $request->query->get('key');
    $location = $request->query->get('location');

    $em = $this->getDoctrine()->getManager();

    if(!is_null($key))
      $school = $em->getRepository('AppBundle:ParisSchool')->getLocation($location);
    else
      $school = array('code' => 401, 'response' => 'Data missing');

    return new JsonResponse($school);

  }

  /**
  * Finds and displays a ParisSchool entity.
  *
  * @Route("/{uai}/", name="school_show")
  * @Method({"GET", "POST"})
  *
  * @param ParisSchool $parisSchool
  * @param Request $request
  * @return JsonResponse
  */
  public function showAction(ParisSchool $parisSchool, Request $request)
  {

    $radius = $request->query->get('radius');
    $key = $request->query->get('key');

    $em = $this->getDoctrine()->getManager();

    if(!is_null($key)){

      $school = $em->getRepository('AppBundle:ParisSchool')->getArray($parisSchool);    

      $response = array('code' => 200, 'response' => $school);

    }
    else
      $response = array('code' => 401, 'response' => 'Data missing');

    return new JsonResponse($response);

  }

}
