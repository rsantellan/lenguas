<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;

class PublicacionType extends TrabajoType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('authors')->add('description')->add('year')->add('url');
    }
}
