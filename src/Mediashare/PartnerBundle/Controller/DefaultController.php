<?php

namespace Mediashare\PartnerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{


    public function indexAction()
    {
        $list = $this->getDoctrine()->getRepository('MediasharePartnerBundle:Partner')->findAll();
        return $this->render('MediasharePartnerBundle:Default:index.html.twig', array('list' => $list));
    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $detail = $em->getRepository('MediasharePartnerBundle:Partner')->find($id);
        return $this->render('MediasharePartnerBundle:Default:show.html.twig', array('detail' => $detail));
    }

}
