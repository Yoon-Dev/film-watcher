<?php

namespace App\Form;

use App\Entity\VideoSearch;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('tag', EntityType::class,[
                'required' => false,
                'label' => false,
                'class' => Tag::class,
                'choice_label' => "nom",
                'multiple' => true
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Filtrer' 
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VideoSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        // permet de soigner les parametres 
        return '';
    }
}
