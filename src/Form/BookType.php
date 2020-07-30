<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            

            ->add('stock', TextType::class, [
                'required' => true,
                
            ])

           
            
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'Main Statuses' => [
                        'Action' => 'Action',
                        'Aventure' => 'Aventure',
                        'Comedie' => 'Comedie',
                        'Romance' => 'Romance',
                    ]]])

            ->add('isInvolvedIns', CollectionType::class,
                [
                    'entry_type' => IsInvolvedInWithReferencedProductType::class,
                    'label' => 'Creators',
                    'allow_add' => true,
                    'allow_delete' => true,
                ])
            ->add('title')
            ->add('pages')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
