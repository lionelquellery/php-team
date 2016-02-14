<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ParisRestaurant;
use AppBundle\Form\ParisRestaurantType;

/**
 * ParisRestaurant controller.
 *
 * @Route("school/{uai}/restaurant")
 */
class ParisRestaurantController extends Controller
{
    /**
     * Lists all ParisRestaurant entities.
     *
     * @Route("/", name="restaurant_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $parisRestaurants = $em->getRepository('AppBundle:ParisRestaurant')->findAll();

        return $this->render('parisrestaurant/index.html.twig', array(
            'parisRestaurants' => $parisRestaurants,
        ));
    }

    /**
     * Creates a new ParisRestaurant entity.
     *
     * @Route("/new", name="restaurant_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $parisRestaurant = new ParisRestaurant();
        $form = $this->createForm('AppBundle\Form\ParisRestaurantType', $parisRestaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parisRestaurant);
            $em->flush();

            return $this->redirectToRoute('restaurant_show', array('id' => $parisrestaurant->getId()));
        }

        return $this->render('parisrestaurant/new.html.twig', array(
            'parisRestaurant' => $parisRestaurant,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ParisRestaurant entity.
     *
     * @Route("/{id}", name="restaurant_show")
     * @Method("GET")
     */
    public function showAction(ParisRestaurant $parisRestaurant)
    {
        $deleteForm = $this->createDeleteForm($parisRestaurant);

        return $this->render('parisrestaurant/show.html.twig', array(
            'parisRestaurant' => $parisRestaurant,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ParisRestaurant entity.
     *
     * @Route("/{id}/edit", name="restaurant_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ParisRestaurant $parisRestaurant)
    {
        $deleteForm = $this->createDeleteForm($parisRestaurant);
        $editForm = $this->createForm('AppBundle\Form\ParisRestaurantType', $parisRestaurant);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parisRestaurant);
            $em->flush();

            return $this->redirectToRoute('restaurant_edit', array('id' => $parisRestaurant->getId()));
        }

        return $this->render('parisrestaurant/edit.html.twig', array(
            'parisRestaurant' => $parisRestaurant,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ParisRestaurant entity.
     *
     * @Route("/{id}", name="restaurant_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ParisRestaurant $parisRestaurant)
    {
        $form = $this->createDeleteForm($parisRestaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($parisRestaurant);
            $em->flush();
        }

        return $this->redirectToRoute('restaurant_index');
    }

    /**
     * Creates a form to delete a ParisRestaurant entity.
     *
     * @param ParisRestaurant $parisRestaurant The ParisRestaurant entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ParisRestaurant $parisRestaurant)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('restaurant_delete', array('id' => $parisRestaurant->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
