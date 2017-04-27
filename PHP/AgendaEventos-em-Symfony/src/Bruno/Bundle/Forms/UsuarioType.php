<?php
namespace Bruno\Bundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UsuarioType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
                ->add('nickName', TextType::class)
                ->add('password', TextType::class)
                ->add('save', SubmitType::class, array('label' => 'Login!'))
        ;
    }
}