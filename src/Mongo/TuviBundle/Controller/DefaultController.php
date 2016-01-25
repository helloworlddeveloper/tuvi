<?php

namespace Mongo\TuviBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Mongo\TuviBundle\CoreTuVi\AnSao;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction()
    {
        $temp = new AnSao(1, 1, 1, 6, 6, true);
            print_r($temp);die;
        return array('name' => 'hello');

    }
}
