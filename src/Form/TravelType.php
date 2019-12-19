<?php


namespace App\Form;

use App\Entity\Travel;
use App\Services\StationsService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TravelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $stationsService = new StationsService();
        $stations = array_combine(array_keys($stationsService->getStations()), array_keys($stationsService->getStations()));
        $builder
            ->add('start', ChoiceType::class, [
                'choices' => $stations,
                'label' => 'Départ',
                'mapped' => false,
            ])
            ->add('finish', ChoiceType::class, [
                'choices' => $stations,
                'label' => 'Arrivée',
                'mapped' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Travel::class,
        ]);
    }
}
