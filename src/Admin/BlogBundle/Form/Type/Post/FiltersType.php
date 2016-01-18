<?php

namespace Admin\BlogBundle\Form\Type\Post;

use Admingenerated\AdminBlogBundle\Form\BasePostType\FiltersType as BaseFiltersType;

/**
 * FiltersType
 */
class FiltersType extends BaseFiltersType
{
    protected function getFormOption($name, array $formOptions)
    {
        switch($name) {
            case 'category':
                $formOptions['query_builder'] = function (CategoryRepository $er) {
                    return $er->getQueryBuilderForFind();
                };
                break;
        }

        return $formOptions;
    }
}
