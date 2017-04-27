<?php

namespace Bruno\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bruno\Bundle\Entity\Usuario;
use Bruno\Bundle\Forms\UsuarioType;

class AgendaController extends Controller {

    public function indexAction(Request $request) {

        $usuario = new Usuario();

        //Pega o objeto que gerencia o doctrine
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(UsuarioType::class, $usuario);

        $form->handleRequest($request);
        $usuarioForm = array();
        $error = '';
        if ($form->isSubmitted() && $form->isValid()) {
            $usuarioForm = $form->getData();

            $repositorio = $em->getRepository("BrunoBundle:Usuario");
            $repositorio->ExecutaLogin($usuarioForm);
            $error = $repositorio->getError()[0];
            if ($repositorio->getResult()) {
                return $this->redirectToRoute('agenda_painel');
            }
        }

        return $this->render('BrunoBundle:Agenda:index.html.twig', array('form' => $form->createView(),
                    'error' => $error));
    }

}
