<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

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
     *
     * @param $uai
     * @param Request $request
     * @return JsonResponse
     */
  public function indexAction($uai, Request $request)
  {

    $em = $this->getDoctrine()->getManager();
    $result = $em->getRepository('AppBundle:ParisObject')->getObjects($uai);

    return new JsonResponse($result);

  }

  /**
     * Creates a new ParisObject entity.
     *
     * @Route("/new/", name="object_new")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param $uai
     * @return JsonResponse
     */
  public function newAction(Request $request, $uai)
  {

    $response = $request->query->all();

    $em = $this->getDoctrine()->getManager();
    $parisInsert = $em->getRepository('AppBundle:ParisObject')->insertObject($response, $uai);

    return new JsonResponse($parisInsert);

  }

  /**
     * Finds and displays a ParisObject entity.
     *
     * @Route("/{id}/", name="object_show")
     * @Method({"GET", "POST"})
     *
     * @param $uai
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
  public function showAction($uai, $id, Request $request)
  {

    $em = $this->getDoctrine()->getManager();
    $result = $em->getRepository('AppBundle:ParisObject')->getObject($uai, $id);

    return new JsonResponse($result);
  }

  /**
     * Displays a form to edit an existing ParisObject entity.
     *
     * @Route("/{id}/edit/", name="object_edit")
     * @Method({"GET", "POST", "UPDATE"})
     *
     * @param Request $request
     * @param $uai
     * @param $id
     * @return JsonResponse
     */
  public function editAction(Request $request, $uai, $id)
  {

    $response = $request->query->all();

    $em = $this->getDoctrine()->getManager();
    $result = $em->getRepository('AppBundle:ParisObject')->editObject($response, $uai, $id);

    return new JsonResponse($result);

  }

  /**
     * Deletes a ParisObject entity.
     *
     * @Route("/{id}/delete/", name="object_delete")
     * @Method({"GET", "POST", "DELETE"})
     *
     * @param Request $request
     * @param $id
     * @param $uai
     * @return JsonResponse
     */
  public function deleteAction(Request $request, $id, $uai)
  {

    $em = $this->getDoctrine()->getManager();
    $result = $em->getRepository('AppBundle:ParisObject')->deleteObject($id, $uai);

    return new JsonResponse($result);

  }

}
