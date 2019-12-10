<?php

namespace App\Form;
use App\Entity\Checklist;
use App\Entity\Room;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChecklistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) /* input we render in form page new checklist #} */
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
            ->add('id', HiddenType::class)
            ->add('CreateTime', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Checklist::class,
        ]);
    }
}
