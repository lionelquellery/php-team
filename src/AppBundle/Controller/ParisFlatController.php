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
     *
     * @param $uai
     * @param Request $request
     * @return JsonResponse
     */
  public function indexAction($uai, Request $request)
  {

    $em = $this->getDoctrine()->getManager();
    $result = $em->getRepository('AppBundle:ParisFlat')->getFlats($uai);

    return new JsonResponse($result);
  }

  /**
     * Creates a new ParisFlat entity.
     *
     * @Route("/new/", name="parisflat_new")
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
    $parisInsert = $em->getRepository('AppBundle:ParisFlat')->insertFlat($response, $uai);

    return new JsonResponse($parisInsert);
  }

  /**
     * Finds and displays a ParisFlat entity.
     *
     * @Route("/{id}/", name="parisflat_show")
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
    $result = $em->getRepository('AppBundle:ParisFlat')->getFlat($uai, $id);

    return new JsonResponse($result);
  }

  /**
     * Displays a form to edit an existing ParisFlat entity.
     *
     * @Route("/{id}/edit/", name="parisflat_edit")
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
    $result = $em->getRepository('AppBundle:ParisFlat')->editFlat($response, $uai, $id);

    return new JsonResponse($result);
  }

  /**
     * Deletes a ParisFlat entity.
     *
     * @Route("/{id}/delete/", name="parisflat_delete")
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
    $result = $em->getRepository('AppBundle:ParisFlat')->deleteFlat($id, $uai);

    return new JsonResponse($result);
  }

}
