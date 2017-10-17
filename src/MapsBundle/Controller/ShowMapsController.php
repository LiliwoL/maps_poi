<?php

namespace MapsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ShowMapsController extends Controller
{
    /**
     * @Route("/", name="show")
     */
    public function ShowAction()
    {
        return $this->render('MapsBundle:ShowMaps:show.html.twig', array(
            // ...
        ));
    }

}
