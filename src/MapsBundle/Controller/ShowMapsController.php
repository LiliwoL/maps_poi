<?php

namespace MapsBundle\Controller;

use MapsBundle\Entity\Marker;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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


    /**
     * @Route("/save",  options={"expose"=true}, name="save")
     * @Method({"POST"})
     */
    public function SaveAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $marker = new Marker();

        $marker->setName($request->request->get('name'));
        $marker->setLat($request->request->get('lat'));
        $marker->setLng($request->request->get('lng'));
        $em->persist($marker);
        $em->flush();
        $markers = count($em->getRepository('MapsBundle:Marker')->findAll());


        $return = json_encode(['success' => $markers]);
        return new Response($return, 200, array('Content-Type' => 'application/json'));
    }


    /**
     * @Route("/remove", options={"expose"=true}, name="remove")
     * @Method({"POST"})
     */
    public function RemoveAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $lat=$request->request->get('lat');
        $lng=$request->request->get('lng');
        $marker = $em->getRepository('MapsBundle:Marker')->findOneBy(['lat' => $lat, 'lng' => $lng]);
        if ($marker) {
        $em->remove($marker);
        $em->flush();
        } else {
            $marker = $em->getRepository('MapsBundle:Marker')->find($request->request->get('id'));
            if (!$marker){
                return new Response('error');
            }
            $em->remove($marker);
            $em->flush();
        }
        $markers = count($em->getRepository('MapsBundle:Marker')->findAll());
        $return = json_encode(['success' => $markers]);
        return new Response($return, 200, array('Content-Type' => 'application/json'));
    }



    /**
     * @Route("/all", options={"expose"=true}, name="all")
     * @Method({"GET"})
     */
    public function AllAction()
    {
        $em = $this->getDoctrine()->getManager();
        $markers = $em->getRepository('MapsBundle:Marker')->findAll();

        $jsonMarkers = [];
        foreach ($markers as $mark) {
            $jsonMarkers[] = ['id' => $mark->getId() , 'name' => $mark->getName() , 'lat' => $mark->getLat() , 'lng' => $mark->getLng() ];
        }

        $return = json_encode($jsonMarkers);
        return new Response($return, 200, array('Content-Type' => 'application/json'));
    }



}
