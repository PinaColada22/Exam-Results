<?php

namespace App\Form;

use App\Entity\ExamResult;
use App\Entity\Pupil;
use App\Entity\Subject;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExamResultType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('score', IntegerType::class, [
                'label' => 'Score',
                'required' => true,
            ])
            ->add('remarks', TextareaType::class, [
                'label' => 'Remarks',
                'required' => false,
            ])
            ->add('pupil', EntityType::class, [
                'class' => Pupil::class,
                'choice_label' => 'name',
                'label' => 'Pupil',
                'required' => true,
            ])
            ->add('subject', EntityType::class, [
                'class' => Subject::class,
                'choice_label' => 'name',
                'label' => 'Subject',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ExamResult::class,
        ]);
    }
}
