<?php

namespace App\Form;
use App\Entity\Checklist;
use App\Entity\Room;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChecklistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nurseName', null, ['label' => 'Votre nom'])
            ->add('Room',EntityType::class,[
                'class' => Room::class,
                'choice_label' => function ($room) {
                    return $room->getName();
                },
                'label' => 'Choix du bloc'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Checklist::class,
        ]);
    }
}
