<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SchoolController extends Controller
{

    /**
     * @Route("/school/")
     */
    public function indexAction()
    {

        $reponse  = '<html><body>';
        $reponse .= '<a href="/school/2/">Page 2</a><br>';
        $reponse .= '<a href="/school/1/">Page 1</a><br>';
        $reponse .= '</body></html>';

        return new Response(
            $reponse
        );
    }

    /**
     * @Route("/school/{id}/")
     */
    public function idAction($id)
    {

        return new Response(
            '<html><body>'.$id.'<br><a href="/school/'.$id.'/plan">plan</a></body></html>'
        );
    }

    /**
     * @Route("/school/{id}/plan/")
     */
    public function planAction()
    {
        return new Response(
            '<html><body>Plan school  </body></html>'
        );
    }

}