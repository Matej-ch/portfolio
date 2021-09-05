<?php

namespace App\Form;

use App\Entity\Language;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class LanguageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
            ->add('versions',null,[
                'label' => 'Versions, separate with comma',
            ])
            ->add('icon',FileType::class,[
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new Image(['maxSize' => '2048k'])
                ],
            ])
            ->add('type',ChoiceType::class,[
                'placeholder' => 'Choose type',
                'choices'  => [
                    'language' => 'Language',
                    'framework' => 'Framework',
                    'library' => 'Library',
                    'tool' => 'Tool'
                ],
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Language::class,
        ]);
    }
}
