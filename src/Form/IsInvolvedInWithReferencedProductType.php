<?php

namespace App\Form;

use App\Entity\IsInvolvedIn;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IsInvolvedInWithReferencedProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('creator')
            ->add('role', ChoiceType::class, [
                'choices' => [
                    
                    'Musique' => [
                        'Chanteur' => 'chanteur',
                        'Compositeur' => 'compositeur',
                        'Musicien' => 'musicien',
                    ],
                    'Livre' => [
                        'Auteur' => 'auteur',
                        'Editeur' => 'editeur',
                        'Illustrateur' => 'illustrateur',
                        'Narrateur' => 'narrateur'
                    ],
                    
                ],
            ]);


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IsInvolvedIn::class,
        ]);
    }
}
