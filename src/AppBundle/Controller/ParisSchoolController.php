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
  public function indexAction()
  {
    $em = $this->getDoctrine()->getManager();
    $query = $em->createQuery(
      'SELECT s
        FROM AppBundle:ParisSchool s'
    );
    $school = $query->getArrayResult();

    return new JsonResponse($school);

  }

  /**
     * Finds and displays a ParisSchool entity.
     *
     * @Route("/{uai}/", name="school_show")
     * @Method("GET")
     */
  public function showAction(ParisSchool $parisSchool)
  {

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
      ->setParameter('latup', $lat+0.001)
      ->andWhere('r.latitude > :latdown')
      ->setParameter('latdown', $lat-0.001)
      ->andWhere('r.longitude < :longup')
      ->setParameter('longup', $long+0.001)
      ->andWhere('r.longitude > :longdown')
      ->setParameter('longdown', $long-0.001)
      ->getQuery();

    $restaurants = $query->getArrayResult();

    return new JsonResponse(array(
      'school'      => $school,
      'restaurants' => $restaurants
    ));

  }

}
