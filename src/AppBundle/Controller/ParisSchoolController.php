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
        return $this->render('parisschool/show.html.twig', array(
            'parisSchool' => $parisSchool
        ));
    }

}
