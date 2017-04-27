<?php

namespace Bruno\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bruno\Bundle\Entity\Evento;
use Bruno\Bundle\Forms\EventoType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PainelController extends Controller {

    /**
     * Função responsável pelo index do painel de eventos. Tem a função de listar os eventos
     * @param Request $request
     * @return type
     */
    public function listaAction($listaEstilo, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repositorio = $em->getRepository("BrunoBundle:Evento");

        $eventos = $repositorio->findAll();

        return $this->render('BrunoBundle:Agenda:evento-lista.html.twig', array('eventos' => $eventos,
                    'usuarioNome' => $_SESSION['userlogin']->getNome(),
                    'listaEstilo' => $listaEstilo));
    }

    public function listaMesAction($listaEstilo, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repositorio = $em->getRepository("BrunoBundle:Evento");

        $mes = array();
        $form = $this->createFormBuilder($mes)
                ->add('data', DateType::class)
                ->add('save', SubmitType::class, array('label' => 'Mês!'))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mes = $form->getData();
            $mes = (int) date('m', strtotime($mes['data']->format('Y/m/d')));
        }


        $eventos = $repositorio->eventosMes($mes);

        return $this->render('BrunoBundle:Agenda:evento-lista-mes.html.twig', array('form' => $form->createView(),
            'eventos' => $eventos,
            'usuarioNome' => $_SESSION['userlogin']->getNome(),
            'listaEstilo' => $listaEstilo));
    }

    /**
     * Função responsável por controlar a operação de cadastrar um novo evento
     * @param Request $request
     * @return View
     */
    public function criarEventoAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $evento = new Evento();

        $form = $this->createForm(EventoType::class, $evento);

        $form->handleRequest($request);

        $error = '';
        if ($form->isSubmitted() && $form->isValid()) {

            $eventoForm = $form->getData();
            $eventoForm->setCriador($_SESSION['userlogin']->getId());

            $repositorio = $em->getRepository("BrunoBundle:Evento");
            $repositorio->ExecutaCreate($eventoForm);

            $error = $repositorio->getError()[0];
            if ($repositorio->getResult()) {
                return $this->redirectToRoute('agenda_editar', array('eventoID' => $repositorio->getResult()));
            }
        }

        return $this->render('BrunoBundle:Agenda:evento-criar.html.twig', array('form' => $form->createView(),
                    'error' => $error,
                    'usuarioNome' => $_SESSION['userlogin']->getNome()));
    }

    /**
     * Função responsável por controlar a operação de editar o evento
     * @param int $eventoID
     * @param Request $request
     */
    public function editarEventoAction($eventoID, Request $request) {

        $em = $this->getDoctrine()->getManager();
        $repositorio = $em->getRepository("BrunoBundle:Evento");

        //Obtem o evento do banco de dados
        $evento = $repositorio->find($eventoID);
        if (!$evento) {
            throw $this->createNotFoundException(
                    'No product found for id ' . $eventoID
            );
        }

        $form = $this->createForm(EventoType::class, $evento);

        $form->handleRequest($request);
        $error = '';
        if ($form->isSubmitted() && $form->isValid()) {

            $eventoForm = $form->getData();
            $repositorio->ExecutaUpdate($eventoID, $eventoForm);
            $error = $repositorio->getError()[0];
            if ($repositorio->getResult()) {
                return $this->redirectToRoute('agenda_painel');
            }
        }

        return $this->render('BrunoBundle:Agenda:evento-editar.html.twig', array('form' => $form->createView(),
                    'error' => $error,
                    'usuarioNome' => $_SESSION['userlogin']->getNome()));
    }

    /**
     * Função responsável por controlar a operação de deletar um evento
     * @param int $eventoID
     * @param Request $request
     * @return type
     */
    public function removerEventoAction($eventoID, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repositorio = $em->getRepository("BrunoBundle:Evento");
        $evento = $repositorio->find($eventoID);
        $em->remove($evento);
        $em->flush();

        return $this->redirectToRoute('agenda_painel');
    }

}
