<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
  /**
     * @Route("/", name="homepage")
     */
  public function indexAction(Request $request)
  {


    $message = \Swift_Message::newInstance()
      ->setSubject('Hello Email')
      ->setFrom('send@example.com')
      ->setTo('vtom.pro@gmail.com')
      ->setBody('yolo');
    
    $this->get('mailer')->send($message);


    // replace this example code with whatever you need
    return $this->render('default/index.html.twig', array(
      'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
    ));
  }
}
