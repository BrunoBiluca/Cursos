<?php

namespace Bruno\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bruno\Bundle\Entity\Evento;

class PageEventoController extends Controller {

    public function mostrarEventoAction($eventoName) {
        
        $em = $this->getDoctrine()->getManager();
        $repositorio = $em->getRepository("BrunoBundle:Evento");
        
        /** @var Evento */
        $evento = $repositorio->findBy(array('name' => $eventoName))[0];
        
        return $this->render("BrunoBundle:Agenda:evento-mostrar.html.twig", array('evento' => $evento));
    }

}
