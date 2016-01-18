<?php

namespace Admin\BlogBundle\Form\Type\Category;

use Doctrine\ORM\EntityRepository;
use Admingenerated\AdminBlogBundle\Form\BaseCategoryType\NewType as BaseNewType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * NewType
 */
class NewType extends BaseNewType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        parent::buildForm($builder,$options);
        $formOptions = $this->getFormOption('parent', array(  'multiple' => false,
            'em' => 'default',
            'class' => 'Admin\\BlogBundle\\Entity\\Categories',
            'required' => false,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->orderBy('u.name', 'ASC');
            },
            'label' => 'Category Parent',
            'translation_domain' => 'Admin',
            'choice_label' => 'name'
        ));
        $builder->add('parent', 'entity', $formOptions);

    }

    protected function getFormOption($name, array $formOptions)
    {
        return $formOptions;
    }

}
