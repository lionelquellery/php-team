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
     * @Method({"GET"})
     *
     * @param $uai
     * @param Request $request
     * @return JsonResponse
     */
  public function indexAction($uai, Request $request)
  {

    $token = $request->query->get('token');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifySession($token))
      $result = $em->getRepository('AppBundle:ParisFlat')->getFlats($uai);
    else
      $result = $em->getRepository('AppBundle:User')->error();

    return new JsonResponse($result);
  }

  /**
     * Creates a new ParisFlat entity.
     *
     * @Route("/new/", name="parisflat_new")
     * @Method({"POST"})
     *
     * @param Request $request
     * @param $uai
     * @return JsonResponse
     */
  public function newAction(Request $request, $uai)
  {

    $response = $request->request->all();

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifySession($response['token']))
      $parisInsert = $em->getRepository('AppBundle:ParisFlat')->insertFlat($response, $uai);
    else
      $parisInsert = $em->getRepository('AppBundle:User')->error();

    return new JsonResponse($parisInsert);
  }

  /**
     * Finds and displays a ParisFlat entity.
     *
     * @Route("/{id}/", name="parisflat_show")
     * @Method({"GET"})
     *
     * @param $uai
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
  public function showAction($uai, $id, Request $request)
  {

    $token = $request->query->get('token');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifySession($token))
      $result = $em->getRepository('AppBundle:ParisFlat')->getFlat($uai, $id);
    else
      $result = $em->getRepository('AppBundle:User')->error();

    return new JsonResponse($result);
  }

  /**
     * Displays a form to edit an existing ParisFlat entity.
     *
     * @Route("/{id}/edit/", name="parisflat_edit")
     * @Method({"POST"})
     *
     * @param Request $request
     * @param $uai
     * @param $id
     * @return JsonResponse
     */
  public function editAction(Request $request, $uai, $id)
  {

    $response = $request->request->all();

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifySession($response['token']))
      $result = $em->getRepository('AppBundle:ParisFlat')->editFlat($response, $uai, $id);
    else
      $result = $em->getRepository('AppBundle:User')->error();

    return new JsonResponse($result);
  }

  /**
     * Deletes a ParisFlat entity.
     *
     * @Route("/{id}/delete/", name="parisflat_delete")
     * @Method({"DELETE"})
     *
     * @param Request $request
     * @param $id
     * @param $uai
     * @return JsonResponse
     */
  public function deleteAction(Request $request, $id, $uai)
  {

    $token = $request->query->get('token');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifySession($token))
      $result = $em->getRepository('AppBundle:ParisFlat')->deleteFlat($id, $uai);
    else
      $result = $em->getRepository('AppBundle:User')->error();

    return new JsonResponse($result);
  }

}
