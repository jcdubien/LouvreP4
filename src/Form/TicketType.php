<?php

namespace App\Form;

use App\Entity\TicketLouvre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('firstName',TextType::class)
            ->add('lastName',TextType::class)
            ->add('birthDate',DateType::class,array ('widget' => 'single_text','html5'=>true,'attr' => ['class' => 'js-datepicker']))
            ->add('halfDay',CheckboxType::class,array('label'=>'Demi-journée ?', 'required'=>false))
            ->add('reducedRate',CheckboxType::class,array('label'=>'Prix réduit (justificatifs à fournir) ?', 'required'=>false))
            ->add('dateTicket',DateType::class,array ('widget' => 'single_text','html5'=>true,'attr' => ['class' => 'js-datepicker']));

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TicketLouvre::class,
        ]);
    }
}
