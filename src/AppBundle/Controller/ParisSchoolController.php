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
     * @Method("GET")
     */
  public function indexAction(Request $request)
  {

    $location = $request->query->get('location');

    $em = $this->getDoctrine()->getManager();
    $school = $em->getRepository('AppBundle:ParisSchool')->getLocation($location);

    return new JsonResponse($school);

  }

  /**
     * Finds and displays a ParisSchool entity.
     *
     * @Route("/{uai}/", name="school_show")
     * @Method("GET")
     */
  public function showAction(ParisSchool $parisSchool, Request $request)
  {

    $radius = $request->query->get('radius');
    
    $em = $this->getDoctrine()->getManager();
    
    $radiusRatio = $em->getRepository('AppBundle:ParisSchool')->getRadius($radius);
    
    $school = $em->getRepository('AppBundle:ParisSchool')->getArray($parisSchool);    
    
    $restaurants = $em->getRepository('AppBundle:ParisRestaurant')->getPerimeter($parisSchool->getLatitude(), $parisSchool->getLongitude(), $radiusRatio);
        
    return new JsonResponse(array(
      'school'      => $school,
      'restaurants' => $restaurants
    ));

  }

}
