<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\ParisObject;
use AppBundle\Form\ParisObjectType;

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
    public function newAction(ParisObject $parisObject)
    {
        $response = array(
            'uai' => $parisObject->getUai(),
            'name'  => $parisObject->getName(),
            'price'      => $parisObject->getPrice(),
            'description'     => $parisObject->getDescription(),
            'type'     => $parisObject->getType(),
            'thumbnail'     => $parisObject->getThumbnail(),
            'album'     => $parisObject->getAlbum()
        );

        return $this->render('parisobject/new.html.twig', array(
            'parisObject' => $parisObject,
            'form' => $form->createView(),
        ));
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
     * @Route("/{id}/edit", name="object_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ParisObject $parisObject)
    {
        $deleteForm = $this->createDeleteForm($parisObject);
        $editForm = $this->createForm('AppBundle\Form\ParisObjectType', $parisObject);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parisObject);
            $em->flush();

            return $this->redirectToRoute('object_edit', array('id' => $parisObject->getId()));
        }

        return $this->render('parisobject/edit.html.twig', array(
            'parisObject' => $parisObject,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ParisObject entity.
     *
     * @Route("/{id}", name="object_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ParisObject $parisObject)
    {
        $form = $this->createDeleteForm($parisObject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($parisObject);
            $em->flush();
        }

        return $this->redirectToRoute('object_index');
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
