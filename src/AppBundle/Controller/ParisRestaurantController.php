<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\ParisRestaurant;
use AppBundle\Form\ParisRestaurantType;

/**
 * ParisRestaurant controller.
 *
 * @Route("school/{uai}/restaurant")
 */
class ParisRestaurantController extends Controller
{

  /**
  * Return all restaurant in a given radius
  *
  * @Route("/", name="restaurant_index")
  * @Method({"GET"})
  *
  * @param ParisRestaurant $parisRestaurant
  * @param Request $request
  * @return JsonResponse
  */
  public function indexAction(Request $request, $uai)
  {

    $radius = $request->query->get('radius');
    $token  = $request->query->get('token');

    $em = $this->getDoctrine()->getManager();
    if($em->getRepository('AppBundle:User')->verifySession($token)){

      $school = $em->getRepository('AppBundle:ParisSchool')->getByUai($uai, true);

      $radiusRatio = $em->getRepository('AppBundle:ParisSchool')->getRadius($radius);

      $restaurants = $em->getRepository('AppBundle:ParisRestaurant')->getPerimeter($school[0]['latitude'], $school[0]['longitude'], $radiusRatio);

      $response = array('code' => 200, 'response' => $restaurants);
    }
    else
      $response = $em->getRepository('AppBundle:User')->error();

    return new JsonResponse($response);

  }

  /**
  * Finds and displays a ParisRestaurant entity.
  *
  * @Route("/{id}/", name="restaurant_show")
  * @Method({"GET", "POST"})
  *
  * @param ParisRestaurant $parisRestaurant
  * @param Request $request
  * @return JsonResponse
  */
  public function showAction(ParisRestaurant $parisRestaurant, Request $request)
  {

    $token = $request->query->get('token');

    if($em->getRepository('AppBundle:User')->verifySession($token))
      $response = array(
      'code'     => 200,
      'response' => array(
        'id'       => $parisRestaurant->getId(),
        'category' => $parisRestaurant->getCategory(),
        'adresse'  => $parisRestaurant->getAdresse(),
        'lat'      => $parisRestaurant->getLatitude(),
        'long'     => $parisRestaurant->getLongitude(),
      )
    );
    else
      $response = $em->getRepository('AppBundle:User')->error();

    return new JsonResponse($response);

  }

}
