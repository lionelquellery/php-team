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

    if($location == NULL){
      $query = $em->createQuery('SELECT s FROM AppBundle:ParisSchool s');
    }else{
      $query = $em->createQuery('SELECT s FROM AppBundle:ParisSchool s WHERE s.cp = :loc')
        ->setParameter('loc', '750'.$location);
    }

    $school = $query->getArrayResult();

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

    $rayon = $request->query->get('rayon');

    if($rayon != NULL)
      $distance = $rayon/100000;
    else
      $distance = 0.001;

    $school = array(
      'id'       => $parisSchool->getId(),
      'uai'      => $parisSchool->getUai(),
      'name'     => $parisSchool->getName(),
      'adresse'  => $parisSchool->getAdresse(),
      'cp'       => $parisSchool->getCp(),
      'lat'      => $parisSchool->getLatitude(),
      'long'     => $parisSchool->getLongitude(),
    );

    $em = $this->getDoctrine()->getRepository('AppBundle:ParisRestaurant');

    $lat = $parisSchool->getLatitude();
    $long = $parisSchool->getLongitude();

    $query = $em->createQueryBuilder('r')
      ->where('r.latitude < :latup')
      ->setParameter('latup', $lat+$distance)
      ->andWhere('r.latitude > :latdown')
      ->setParameter('latdown', $lat-$distance)
      ->andWhere('r.longitude < :longup')
      ->setParameter('longup', $long+$distance)
      ->andWhere('r.longitude > :longdown')
      ->setParameter('longdown', $long-$distance)
      ->getQuery();

    $restaurants = $query->getArrayResult();

    return new JsonResponse(array(
      'school'      => $school,
      'restaurants' => $restaurants
    ));

  }

}
