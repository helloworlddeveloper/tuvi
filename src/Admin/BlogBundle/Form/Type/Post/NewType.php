<?php

namespace Admin\BlogBundle\Form\Type\Post;

use Admingenerated\AdminBlogBundle\Form\BasePostType\NewType as BaseNewType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;


/**
 * NewType
 */
class NewType extends BaseNewType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder,$options);
        $builder->add('description','textarea', array('attr'   => [
            'class' => 'form-control'
        ]));

        $builder->add('imageUrl','elfinder', array('instance'=>'form', 'enable'=>true,'attr'   => [
            'class' => 'form-control'
        ]));
        $builder->add('content', 'ckeditor',array(
        'config' => array(
            'filebrowserBrowseRoute' => 'elfinder',
            'filebrowserBrowseRouteParameters' => array('instance' => 'default')
                        ),
        ));

        $formOptions = $this->getFormOption('category', array(  'multiple' => false,
            'em' => 'default',
            'class' => 'Admin\\BlogBundle\\Entity\\Categories',
            'required' => false,
            'query_builder' => function (EntityRepository $er) use ($builder) {
                return $er->createQueryBuilder('u')
                    ->orderBy('u.root, u.lft', 'ASC');
            },
            'label' => 'Category',
            'translation_domain' => 'Admin',
            'choice_label' => 'name'
        ));
        $builder->add('category', 'entity', $formOptions);

    }


    protected function getFormOption($name, array $formOptions)
    {
        return $formOptions;
    }
}
