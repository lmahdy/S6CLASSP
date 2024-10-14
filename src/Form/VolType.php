<?php

namespace App\Form;

use App\Entity\Vol;
use App\Entity\Aeroport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('villeDestination', TextType::class, [
                'label' => 'Ville de Destination',
            ])
            ->add('dateDeDepart', DateTimeType::class, [ // Updated field name
                'label' => 'Date de Départ',
                'widget' => 'single_text',
            ])
            ->add('dateDArrivee', DateTimeType::class, [ // Updated field name
                'label' => 'Date d\'Arrivée',
                'widget' => 'single_text',
            ])
            ->add('aeroport', EntityType::class, [
                'class' => Aeroport::class,
                'choice_label' => 'nom',
                'label' => 'Aéroport',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vol::class,
        ]);
    }
}
