<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParisRestaurantType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category')
            ->add('adresse')
            ->add('lat')
            ->add('lng')
            ->add('location')
            ->add('name')
            ->add('originalid')
            ->add('polarity')
            ->add('subcategory')
            ->add('details')
            ->add('reviews')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ParisRestaurant'
        ));
    }
}
