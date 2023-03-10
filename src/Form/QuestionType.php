<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question', TextType::class, [
                'label' => 'Question '
            ])
            ->add('enjeu_efc', CheckboxType::class, [
                'label' => 'EFC ',
                'required' => false
            ])
            ->add('enjeu_eit', CheckboxType::class, [
                'label' => 'EIT ',
                'required' => false
            ])
            ->add('enjeu_ec', CheckboxType::class, [
                'label' => 'EC ',
                'required' => false
            ])
            ->add('submit', SubmitType::class, ['label' => 'Mettre à jour']);
        ;
    }


}
