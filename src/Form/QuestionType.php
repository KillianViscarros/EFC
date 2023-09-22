<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('question', TextType::class, [
            'label' => 'Question'
        ])
        ->add('enjeu_efc', NumberType::class, [
            'label' => 'EFC',
            'required' => false,
            'invalid_message' => 'Vous devez rentrer un nombre',
            'html5' => true,  
            'attr'=>[
                'min'=>0, 
                'max'=>100, 
                'step'=>0.1
            ]
        ])
        ->add('enjeu_eit', NumberType::class, [
            'label' => 'EIT',
            'required' => false,
            'invalid_message' => 'Vous devez rentrer un nombre',
            'html5' => true,  
            'attr'=>[
                'min'=>0, 
                'max'=>100, 
                'step'=>0.1
            ]

        ])
        ->add('enjeu_ec', NumberType::class, [
            'label' => 'EC',
            'required' => false,
            'invalid_message' => 'Vous devez rentrer un nombre',
            'html5' => true,  
            'attr'=>[
                'min'=>0, 
                'max'=>100, 
                'step'=>0.1
            ]
        ])
        ->add('submit', SubmitType::class, ['label' => 'Ajouter']);
    ;
    }


}