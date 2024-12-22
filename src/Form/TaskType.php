<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Task;
use App\Enum\EnumTaskStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Pending' => EnumTaskStatus::PENDING,
                    'In Progress' => EnumTaskStatus::IN_PROGRESS,
                    'Completed' => EnumTaskStatus::FINISHED,
                ],
                'choice_label' => function (?EnumTaskStatus $choice, $key, $value) {
                    return $choice ? $choice->value : $key;
                },
            ])
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
