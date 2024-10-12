<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('published', CheckboxType::class, [
                'required' => false,
            ])
            ->add('publicationDate', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'choice_label' => function (Author $author) {
                    return $author->getFullName();
                },
                'placeholder' => 'Choose an author',
            ])
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'Science-Fiction' => 'science_fiction',
                    'Mystery' => 'mystery',
                    'Autobiography' => 'autobiography',
                ],
                'placeholder' => 'Choose a category',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
