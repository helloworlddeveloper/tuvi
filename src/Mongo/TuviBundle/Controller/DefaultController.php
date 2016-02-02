<?php

namespace Mongo\TuviBundle\Controller;

use Mongo\TuviBundle\CoreTuVi\BinhChu;
use Mongo\TuviBundle\CoreTuVi\SaoDatabase;
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
        $saoDatabase = new SaoDatabase();
        $cucCach = array(
                "Thủy nhị cục",
				"Mộc tam cục",
				"Kim tứ cục",
				"Thổ ngủ cục",
				"Hỏa lục cục"
			);
        $binhchu = new BinhChu();
        $urlFileXml = realpath($this->get('kernel')->getRootDir() . "/../db/".'tuvi.xml');
        $binhchu::LoadFromFile($urlFileXml);

        $dChiGio = 1;
        $dChiGio = 1;
        $thangAm = 1;
        $tcNam = 6;
        $dcNam = 6;
        $gioiTinh = true;

        $anSaoDoc = new AnSao($dChiGio, $dChiGio, $thangAm, $tcNam, $dcNam, $gioiTinh);


        if ($tcNam % 2 == 1)
        {
            $so = 5 * (($tcNam + 1) / 2 - 1) + ($tcNam + 1) / 2 - 1;
        }
        else
        {
            $so = 5 * ($dcNam / 2 - 1) + $dcNam / 2 - 1;
        }

        $napAm = $saoDatabase->NapAm[$so];
        $cuc = $cucCach[$anSaoDoc->Cuc - 2];
        $boSaoCung = $anSaoDoc->PhanCung();
        return array('name' => 'hello');

    }
}
