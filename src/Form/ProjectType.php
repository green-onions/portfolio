<?php

namespace App\Form;

use App\Entity\Language;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Title', TextType::class, [
                'label' => 'Nom du projet'
            ])
            ->add('link', TextType::class, [
                'label' => 'URL'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image',
                'required' => true,
                'allow_delete' => false,
                'download_uri' => false,
                'image_uri' => false,
                'asset_helper' => false,
            ])
            ->add('client', TextType::class, [
                'label' => 'Client'
            ])
            ->add('languages', EntityType::class, [
                'class' => Language::class,
                'choice_label' => 'name',
                'label' => 'Techno',
                'multiple' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
