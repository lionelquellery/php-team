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
     * @Method("GET")
     */
    public function indexAction($uai)
    {

        $em = $this->getDoctrine()->getManager();

        $parisObjects = $em->getRepository('AppBundle:ParisObject')->getObjects($uai);

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
     * @Route("/{id}", name="object_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $parisObject = $em->getRepository('AppBundle:ParisObject')->getObject($id);

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
    public function deleteAction(Request $request, $id)
    {
        $response = $request->query->all();

        $em = $this->getDoctrine()->getManager();
        $object = $em->getRepository('AppBundle:ParisObject')->deleteObject($response, $id);

        return new JsonResponse($object);
    }

    /**
     * Creates a form to delete a ParisObject entity.
     *
     * @param ParisObject $parisObject The ParisObject entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ParisObject $parisObject)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('object_delete', array('id' => $parisObject->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
