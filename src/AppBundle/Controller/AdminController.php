<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\User;
use AppBundle\Entity\ParisFlat;

/**
 * Admin controller.
 *
 * @Route("admin")
 */
class AdminController extends Controller
{
  /**
     * Index of Admin.
     *
     * @Route("/", name="admin_index")
     * @Method({"GET", "POST"})
     */
  public function indexAction(Request $request)
  {

    $key = $request->query->get('key');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifyPermission($key) == true)
      return $this->render('admin/index.html.twig', array(
        'key' => $key
      ));
    else{
      $users = array('code' => 403,'response' => 'You don\'t have the rights to access these datas');
      return new JsonResponse($users);
    }
  }

  /**
     * See all schools
     *
     * @Route("/school/", name="admin_school")
     * @Method({"GET", "POST"})
     */
  public function schoolAction(Request $request)
  {

    $key = $request->query->get('key');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifyPermission($key) == true){
      $schools = $em->getRepository('AppBundle:ParisSchool')->findAll();
      return $this->render('admin/school.html.twig',array(
        'schools' => $schools,
        'key'     => $key
      ));
    }
    else{
      $users = array('code' => 403,'response' => 'You don\'t have the rights to access these datas');
      return new JsonResponse($users);
    }
  }

  /**
     * See all users
     *
     * @Route("/user/", name="admin_user")
     * @Method({"GET", "POST"})
     */
  public function userAction(Request $request)
  {

    $key = $request->query->get('key');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifyPermission($key) == true){
      $users = $em->getRepository('AppBundle:User')->getAllUsers($key);      

      return $this->render('admin/user.html.twig', array(
        'users' => $users['response'],
        'key'   => $key
      ));
    }
    else{
      $users = array('code' => 403, 'response' => 'You don\'t have the rights to access these datas');
      return new JsonResponse($users);
    }
  }

  /**
     * Delete user
     *
     * @Route("/user/delete/{id}/", name="admin_deleteuser")
     * @Method({"GET", "POST", "DELETE"})
     */
  public function duserAction(Request $request, $id)
  {

    $key = $request->query->get('key');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifyPermission($key) == true){

      $response = $em->getRepository('AppBundle:User')->deleteUser($id);

      return $this->render('admin/duser.html.twig', array(
        'response'  => $response['response'],
        'key'       => $key
      ));
    }
    else{
      $users = array('code' => 403,'response' => 'You don\'t have the rights to access these datas');
      return new JsonResponse($users);
    }
  }

  /**
     * See one school
     *
     * @Route("/school/{uai}/", name="admin_schoolshow")
     * @Method({"GET", "POST"})
     */
  public function schoolshowAction(Request $request, $uai)
  {

    $key = $request->query->get('key');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifyPermission($key) == true){

      $school  = $em->getRepository('AppBundle:ParisSchool')->getByUai($uai);

      $flats   = $em->getRepository('AppBundle:ParisFlat')->getFlats($uai, $key);

      $objects = $em->getRepository('AppBundle:ParisObject')->getObjects($uai, $key);

      return $this->render('admin/schoolshow.html.twig', array(
        'objects' => $objects['response'],
        'flats'   => $flats['response'],
        'key'     => $key,
        'schools' => $school
      ));
    }
    else{
      $users = array('code' => 403,'response' => 'You don\'t have the rights to access these datas');
      return new JsonResponse($users);
    }
  }

  /**
     * See flat's details
     *
     * @Route("/school/{uai}/flat/{id}/", name="admin_flatshow")
     * @Method({"GET", "POST"})
     */
  public function flatshowAction(Request $request, $id, $uai)
  {

    $key = $request->query->get('key');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifyPermission($key) == true){

      $flat = $em->getRepository('AppBundle:ParisFlat')->getFlat($uai, $id, $key);

      return $this->render('admin/flatshow.html.twig', array(
        'flat'    => $flat['response'][0],
        'key'     => $key
      ));
    }
    else{
      $users = array('code' => 403,'response' => 'You don\'t have the rights to access these datas');
      return new JsonResponse($users);
    }
  }

  /**
     * Delete a flat
     *
     * @Route("/school/{uai}/flat/delete/{id}/", name="admin_flatdelete")
     * @Method({"GET", "DELETE"})
     */
  public function flatdeleteAction(Request $request, $id, $uai)
  {

    $key = $request->query->get('key');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifyPermission($key) == true){

      $flat = $em->getRepository('AppBundle:ParisFlat')->deleteFlat($key, $id, $uai);

      return $this->render('admin/dflat.html.twig', array(
        'response'    => $flat['response'],
        'key'     => $key
      ));
    }
    else{
      $users = array('code' => 403,'response' => 'You don\'t have the rights to access these datas');
      return new JsonResponse($users);
    }
  }

  /**
     * Edit a flat
     *
     * @Route("/school/{uai}/flat/edit/{id}/", name="admin_flatedit")
     * @Method({"GET", "POST"})
     */
  public function flateditAction(Request $request, $id, $uai)
  {

    $key = $request->query->get('key');

    $em = $this->getDoctrine()->getManager();

    if($em->getRepository('AppBundle:User')->verifyPermission($key) == true){

      $flat = $em->getRepository('AppBundle:ParisFlat')->getFlat($uai, $id, $key);

      $form = $this->createFormBuilder()
        ->add('Uai', TextType::class, array('data' => $flat['response'][0]['uai']))
        ->add('Name', TextType::class, array('data' => $flat['response'][0]['name']))
        ->add('Price', IntegerType::class, array('data' => $flat['response'][0]['price']))
        ->add('Type', TextType::class, array('data' => $flat['response'][0]['type']))
        ->add('Thumbnail', TextType::class, array('data' => $flat['response'][0]['thumbnail']))
        ->add('Date', IntegerType::class, array('data' => $flat['response'][0]['date']))
        ->add('Album', TextType::class, array('data' => $flat['response'][0]['album']))
        ->add('Description', TextType::class, array('data' => $flat['response'][0]['description']))
        ->add('Longitude', IntegerType::class, array('data' => $flat['response'][0]['longitude']))
        ->add('Latitude', IntegerType::class, array('data' => $flat['response'][0]['latitude']))
        ->add('save', SubmitType::class, array('label' => 'Create Task'))        
        ->getForm();

      $form->handleRequest($request);

      if ($form->isValid()) {

        $formValues = $form->getData();

        $update = array( 
          'id'          => $id,
          'uai'         => $formValues['Uai'],
          'name'        => $formValues['Name'],
          'price'       => $formValues['Price'],
          'type'        => $formValues['Type'],
          'thumbnail'   => $formValues['Thumbnail'],
          'date'        => $formValues['Date'],
          'album'       => $formValues['Album'],
          'description' => $formValues['Description'],
          'longitude'   => $formValues['Longitude'],
          'latitude'    => $formValues['Latitude'],
        );
        
        $em->getRepository('AppBundle:ParisFlat')->editFlat($update, $key, $uai, $id);

        return $this->redirectToRoute('admin_schoolshow', array('uai' => $uai, 'key' => $key));
      }

      return $this->render('admin/eflat.html.twig', array(
        'form' => $form->createView(),
        'key'  => $key
      ));
    }
    else{
      $users = array('code' => 403,'response' => 'You don\'t have the rights to access these datas');
      return new JsonResponse($users);
    }
  }

}
