<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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

        $parisSchools = $em->getRepository('AppBundle:ParisSchool')->findAll();

        return $this->render('parisschool/index.html.twig', array(
            'parisSchools' => $parisSchools,
        ));
    }

    /**
     * Finds and displays a ParisSchool entity.
     *
     * @Route("/{uai}", name="school_show")
     * @Method("GET")
     */
    public function showAction(ParisSchool $parisSchool)
    {

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

        $restaurants = $query->getResult();

        return $this->render('parisschool/show.html.twig', array(
            'parisSchool' => $parisSchool,
            'restaurants' => $restaurants
        ));
    }

}
