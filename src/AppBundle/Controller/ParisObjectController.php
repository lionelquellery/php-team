<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\ParisObject;

/**
 * ParisObject controller.
 *
 * @Route("school/{uai}/object")
 */
class ParisObjectController extends Controller
{
    /**
     * Lists all ParisObject entities.
     *
     * @Route("/", name="object_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction($uai, Request $request)
    {

        $response = $request->query->all();
        $em = $this->getDoctrine()->getManager();

        if ( isset( $response['userkey'] ) && !empty( $response['userkey'] )){

            $parisObjects = $em->getRepository('AppBundle:ParisObject')->getObjects($uai, $response['userkey']);

        }
        else
        {

            $parisObjects =  array("error" => "no rights");

        }

        return new JsonResponse($parisObjects);

    }

    /**
     * Creates a new ParisObject entity.
     *
     * @Route("/new", name="object_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $uai)
    {

        $response = $request->query->all();

        $em = $this->getDoctrine()->getManager();
        $object = $em->getRepository('AppBundle:ParisObject')->insertObject($response, $uai);


        $em = $this->getDoctrine()->getManager();
        $em->persist($object);
        $em->flush();

        $id = array('id'=>$object->getId());

        return new JsonResponse($id);

    }

    /**
     * Finds and displays a ParisObject entity.
     *
     * @Route("/{id}/", name="object_show")
     * @Method({"GET", "POST"})
     */
    public function showAction($uai, $id, Request $request)
    {

        $response = $request->query->all();
        $em = $this->getDoctrine()->getManager();

        if ( isset( $response['userkey'] ) && !empty( $response['userkey'] )){

            $parisObject = $em->getRepository('AppBundle:ParisObject')->getObject($uai, $id, $response['userkey']);

        }
        else
        {

            $parisObject =  array("error" => "no rights");

        }

        return new JsonResponse($parisObject);
    }

    /**
     * Displays a form to edit an existing ParisObject entity.
     *
     * @Route("/{id}/edit/", name="object_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $uai, $id)
    {

        $response = $request->query->all();


        $em = $this->getDoctrine()->getManager();
        $object = $em->getRepository('AppBundle:ParisObject')->editObject($response, $uai, $id);

        return new JsonResponse($object);

    }

    /**
     * Deletes a ParisObject entity.
     *
     * @Route("/{id}/delete/", name="object_delete")
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, $id, $uai)
    {
        $response = $request->query->all();

        $em = $this->getDoctrine()->getManager();
        $object = $em->getRepository('AppBundle:ParisObject')->deleteObject($response, $id, $uai);

        return new JsonResponse($object);
    }

}
