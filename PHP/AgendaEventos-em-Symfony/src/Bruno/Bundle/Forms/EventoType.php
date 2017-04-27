<?php
namespace Bruno\Bundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class EventoType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
                ->add('titulo', TextType::class)
                ->add('descricao', TextareaType::class)
                ->add('data', DateTimeType::class)
                ->add('file', FileType::class)
                ->add('save', SubmitType::class, array('label' => 'Crie um evento!'))
        ;
    }
}