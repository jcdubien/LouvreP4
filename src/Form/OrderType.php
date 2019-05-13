<?php

namespace App\Form;

use App\Entity\Orderlouvre;
use Doctrine\DBAL\Types\SmallIntType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, array('label'=>'Prénom'))
            ->add('lastName', TextType::class, array('label'=>'Nom'))
            ->add(
                'email',
                EmailType::class,
                array(
                'label'=>'Adresse mail'
                )
            )
            ->add(
                'country',
                CountryType::class,
                array('label'=>'Pays de résidence','preferred_choices'=>['FR'],
                    'attr'=>['class'=>'endorder'])
            )

            ->add(
                'ticketLouvre',
                CollectionType::class,
                array(
                'entry_type'   => TicketType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'attr'=>['class'=>'ticketlouvre'])
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
            'data_class' => Orderlouvre::class,
            ]
        );
    }
}
