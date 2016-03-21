<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Mails controller.
 *
 * @Route("mail")
 */
class MailsController extends Controller
{
  /**
     * Lists all Mails entities.
     *
     * @Route("/", name="mail_new")
     * @Method({"POST"})
     *
     * @param $mail
     * @return JsonResponse
     */
  public function newAction(Request $request)
  {

    $mail = $request->request->get('mail');

    $em = $this->getDoctrine()->getManager();

    if($mail)
      $mailInsert = $em->getRepository('AppBundle:Mails')->inserMail($mail);
    else
      $mailInsert = array('code' => 404, 'response' => 'No mail to insert');

      return new JsonResponse($mailInsert);
  }


}
