<?php

namespace Bruno\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bruno\Bundle\Entity\Evento;
use Bruno\Bundle\Forms\EventoType;

class AgendaController extends Controller {

    public function indexAction($name, Request $request) {

        //Pega a sessão
        $session = $request->getSession();

        //verifica se a sessão ainda não foi iniciada
        if (!$session->isStarted()) {
            $session->set("foo", 2);
        }

        //Seta o valor de foo na sessão
        $session->set("foo", $session->get("foo") + 1);

        //Setando a zona de fuso horário
        date_default_timezone_set('America/Sao_Paulo');

        $evento = new Evento();
        $evento->setTitulo("Dia do UTC 2!");
        $evento->setData(new \DateTime(gmdate('d-m-Y H:i:s')));
        $evento->setDescricao("Dia em Homenagem UTC como padrão de horários no mundo! Agora com horário certo");
        $evento->setCriador(1);

        //Pega o objeto que gerencia o doctrine
        $em = $this->getDoctrine()->getManager();

        //Cria o prepared statement
        //$em->persist($evento);
        //Executa as query prontas no prepared statement
        //$em->flush();

        $id = 3;
        //$eventoSelect = $this->getDoctrine()->getRepository('BrunoBundle:Evento')->find($id);
//        if (!$eventoSelect) {
//            throw $this->createNotFoundException(
//                    'No product found for id ' . $id
//            );
//        }
        //Pegar o gerenciador do doctrine
        //$em = $this->getDoctrine()->getManager();
        //Obtem o objeto do banco de dados
//        $eventoUpdate = $em->getRepository('BrunoBundle:Evento')->find($id);
//
//        if (!$eventoUpdate) {
//            throw $this->createNotFoundException(
//                    'No product found for id ' . $id
//            );
//        }
        //Modifica o objeto
        //$eventoUpdate->setTitulo("Dia da marmota!");
//        $eventoRemove = $em->getRepository("BrunoBundle:Evento")->find($id);
//        $em->remove($eventoRemove);
//        
//        //Executa a query
//        $em->flush();
        //$eventos = $em->getRepository("BrunoBundle:Evento")->findAllOrderedByName();
        //var_dump($eventos);

//        $form = $this->createFormBuilder($evento)
//                ->add('titulo', TextType::class)
//                ->add('descricao', TextType::class)
//                ->add('data', DateType::class)
//                ->add('save', SubmitType::class, array('label' => 'Crie um evento!'))
//                ->getForm();

        $form = $this->createForm(EventoType::class, $evento);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            /** @var Evento */
            $eventoForm = $form->getData();
            
            $em->persist($eventoForm);
            $em->flush();
        }
        
        //return $this->render('BrunoBundle:Agenda:index.html.twig', array('name' => $name . " - " . $session->get("foo")));
        return $this->render('BrunoBundle:Agenda:form.html.twig', array('form' => $form->createView()));
    }

}
