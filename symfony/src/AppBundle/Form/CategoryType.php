<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Category;

class CategoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $types = [
            'Publicación' => Category::PUBLICACION,
            'Monografía' => Category::MONOGRAFIA,
            'Fuentes' => Category::FUENTES,
        ];
        $builder
            ->add('name')
            ->add('description')
            ->add('orden')
            ->add('type', ChoiceType::class, array(
                'choices'  => $types,
                'choices_as_values' => true,
                'choice_translation_domain' => false,
                )
            );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Category'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_category';
    }


}
