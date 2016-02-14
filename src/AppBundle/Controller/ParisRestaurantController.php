<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     * @Route("/{id}", name="restaurant_show")
     * @Method("GET")
     */
  public function showAction(ParisRestaurant $parisRestaurant)
  {

    return $this->render('parisrestaurant/show.html.twig', array(
      'parisRestaurant' => $parisRestaurant,
    ));
  }

}
