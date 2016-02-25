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
  * Finds and displays a ParisRestaurant entity.
  *
  * @Route("/{id}/", name="restaurant_show")
  * @Method("GET")
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
