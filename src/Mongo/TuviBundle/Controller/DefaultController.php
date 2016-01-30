<?php

namespace Mongo\TuviBundle\Controller;

use Mongo\TuviBundle\CoreTuVi\BinhChu;
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
        $anSaoDoc = new AnSao(1, 1, 1, 6, 6, true);
        $boSaoCung = $anSaoDoc->PhanCung();
        $binhchu = new BinhChu();
        $urlFileXml = realpath($this->get('kernel')->getRootDir() . "/../db/".'tuvi.xml');
        $binhchu::LoadFromFile($urlFileXml);
            print_r($binhchu);die;
        return array('name' => 'hello');

    }
}
