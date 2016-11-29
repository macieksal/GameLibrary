<?php

namespace GameLibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username')->add('description')
<<<<<<< HEAD
            ->add('picture', 'file', array('data_class' => null, 'required'=>false));
=======
            ->add('picture', 'file', array('data_class' => null));
>>>>>>> d15aaa7e94a2ff60410248749f055a36753d4166

    }

}