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
  * @Method({"GET", "POST"})
  *
  * @param ParisRestaurant $parisRestaurant
  * @param Request $request
  * @return JsonResponse
  */
  public function indexAction(Request $request, $uai)
  {

    $key = $request->query->get('key');
    $radius = $request->query->get('radius');

    if(!is_null($key)){
      
      $em = $this->getDoctrine()->getManager();
      $school = $em->getRepository('AppBundle:ParisSchool')->getByUai($uai, true);

      $radiusRatio = $em->getRepository('AppBundle:ParisSchool')->getRadius($radius);

      $restaurants = $em->getRepository('AppBundle:ParisRestaurant')->getPerimeter($school[0]['latitude'], $school[0]['longitude'], $radiusRatio);

      $response = array('code' => 200, 'response' => $restaurants);

    }
    else
      $reponse = array('code' => 401, 'response' => 'Data missing');

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

    $key = $request->query->get('key');

    if(!is_null($key)){
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
    }
    else
      $response = array('code' => 401, 'response' => 'Data missing');

    return new JsonResponse($response);

  }

}
