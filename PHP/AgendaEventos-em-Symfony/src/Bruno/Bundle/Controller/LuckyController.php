<?php
// src/AppBundle/Controller/LuckyController.php
namespace Bruno\Bundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LuckyController extends Controller{
    //extends controller para poder renderizar uma página com twig
    
    public function numberAction($count){
        
        $numberList = array();
        
        for($i = 0; $i < $count; $i++){
            $numberList[] = rand(0, 100);
        }
        $numbers = implode(", ", $numberList);
        
        //Método que vem da classe controller
        return $this->render(
                'BrunoBundle:lucky:number.html.twig',
                array('luckyNumberList' => $numbers)
        );
        
        //Resposta requisitada
        //return Response($html);
    }
}