<?php

namespace Admin\BlogBundle\Form\Type\Category;

use Admingenerated\AdminBlogBundle\Form\BaseCategoryType\EditType as BaseEditType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

/**
 * EditType
 */
class EditType extends BaseEditType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder,$options);
        $formOptions = $this->getFormOption('parent', array(  'multiple' => false,
            'em' => 'default',
            'class' => 'Admin\\BlogBundle\\Entity\\Categories',
            'required' => false,
            'query_builder' => function (EntityRepository $er) use ($builder) {
//                 $id = $builder->getData()->getId();
//                print_r($builder->getData()->getRoot()) ;die;
                return $er->createQueryBuilder('u')
//                    ->where('u.')
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
