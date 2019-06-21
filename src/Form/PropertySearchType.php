<?php

namespace App\Form;

use App\Entity\PropertySearch;
use App\Entity\Option;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrice', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Budget max'
                ]
            ])
            ->add('minSurface', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Surfance minimum'
                ]
            ])
            //ajout de lelement option dans la recherche
            ->add('options', EntityType::class, [
                'required' => false,
                'label' => false,
                'class' => option::class,
                'multiple' => true,
                'choice_label' => 'name'
            ])
                    
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            //mettre le method du form en ger
            'method' => 'get',
            // enlever la protection du token pas besoin pour le recherche
            'csrf_protection' => false
        ]);
    }
   // eviter l'utilisaton des parametre par defaut dans l'url 
    public function getBlockPrefix()
    {
        return '';
    }
}
