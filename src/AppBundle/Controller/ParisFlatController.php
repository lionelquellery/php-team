<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * ParisFlat controller.
 *
 * @Route("school/{uai}/flat")
 */
class ParisFlatController extends Controller
{
    /**
     * Lists all ParisFlat entities.
     *
     * @Route("/", name="parisflat_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction($uai, Request $request)
    {
        $response = $request->query->all();


        if ( isset( $response['userkey'] ) && !empty( $response['userkey'] ))
        {

            $em = $this->getDoctrine()->getManager();
            $result = $em->getRepository('AppBundle:ParisFlat')->getFlats($uai, $response['userkey']);

        }
        else
        {

            $result =  array("error" => "no rights");

        }

        return new JsonResponse($result);
    }

    /**
     * Creates a new ParisFlat entity.
     *
     * @Route("/new/", name="parisflat_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $uai)
    {
        $response = $request->query->all();


        if ( isset( $response['userkey'] ) && !empty( $response['userkey'] ) )
        {
            $em = $this->getDoctrine()->getManager();
            $parisInsert = $em->getRepository('AppBundle:ParisFlat')->insertFlat($response, $uai);

        }
        else
        {
            $parisInsert = array("error" => "No arguments passed, nothing to create");
        }



        return new JsonResponse($parisInsert);
    }

    /**
     * Finds and displays a ParisFlat entity.
     *
     * @Route("/{id}/", name="parisflat_show")
     * @Method({"GET", "POST"})
     */
    public function showAction($uai, $id, Request $request)
    {
        $response = $request->query->all();


        if ( isset( $response['userkey'] ) && !empty( $response['userkey'] ))
        {

            $em = $this->getDoctrine()->getManager();
            $result = $em->getRepository('AppBundle:ParisFlat')->getFlat($uai, $id, $response['userkey']);

        }
        else
        {

            $result =  array("error" => "no rights");

        }

        return new JsonResponse($result);
    }

    /**
     * Displays a form to edit an existing ParisFlat entity.
     *
     * @Route("/{id}/edit/", name="parisflat_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $uai, $id)
    {
        $response = $request->query->all();


        if ( isset( $response['userkey'] ) && !empty( $response['userkey'] ))
        {

            $em = $this->getDoctrine()->getManager();
            $result = $em->getRepository('AppBundle:ParisFlat')->editFlat($response, $uai, $id);

        }
        else
        {

            $result =  array("error" => "no rights");

        }

        return new JsonResponse($result);
    }

    /**
     * Deletes a ParisFlat entity.
     *
     * @Route("/{id}/delete/", name="parisflat_delete")
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, $id, $uai)
    {
        $response = $request->query->all();

        if ( isset( $response['userkey'] ) && !empty( $response['userkey'] ))
        {

            $em = $this->getDoctrine()->getManager();
            $result = $em->getRepository('AppBundle:ParisFlat')->deleteFlat($response, $id, $uai);

        }
        else
        {

            $result =  array("error" => "no rights");

        }

        return new JsonResponse($result);
    }

}
