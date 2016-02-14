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

        $em = $this->getDoctrine()->getManager();

        $lat = $parisSchool->getLatitude();
        $long = $parisSchool->getLongitude();

        $query = $em->createQuery(
            'SELECT r
            FROM AppBundle:ParisRestaurant r
            WHERE r.latitude < :latup   AND r.latitude > :latdown
            AND   r.longitude < :longup AND r.longitude > :longdown')
            ->setParameter('latup', $lat+0.005 )
            ->setParameter('latdowm', $lat-0.005 )
            ->setParameter('longup', $long+0.005 )
            ->setParameter('longdown', $long-0.005 );

        $restaurants = $query->getResult();

        return $this->render('parisschool/show.html.twig', array(
            'parisSchool' => $parisSchool,
            'restaurants' => $restaurants
        ));
    }

}
