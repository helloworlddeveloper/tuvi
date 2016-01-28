<?php
/**
 * Created by PhpStorm.
 * User: hoavt
 * Date: 1/26/2016
 * Time: 5:06 PM
 */

namespace Mongo\TuviBundle\CoreTuVi;


use Symfony\Component\Config\Definition\Exception\Exception;

class BinhChu
{
    public $SaoId = array();
    public $CungId = array();
    public $LucThanId = array();
    public $LoiBinh = "";


    public function __construct()
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct' . $number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

    function __construct4($listSaoData = array(), $cungId = array(), $lucThanId = array(), $loiBinh = "")
    {

        foreach ($listSaoData as $sao) {
            array_push($this->SaoId, $sao->ID);
        }
        $this->CungId = $cungId;
        $this->LucThanId = $lucThanId;
        $this->LoiBinh = $loiBinh;
    }

    public static function LoadFromFile($pathFile)
    {

        $saoData = new SaoDatabase();
        $listBinhChu = array();
        $xmlData = simpleXML_load_file($pathFile);
        foreach($xmlData->children() as $binhChu) {
            try{
                $saosNode = $binhChu->Saos;
                $cungsNode = $binhChu->Cungs;
				$lthansNode = $binhChu->LucThans;
                $lbinh = $binhChu->LoiBinh;
                $saos = array();
                $cungs = array();
                $lthans = array();
                foreach($saosNode->Sao as $sao)
                {

                    $CSData = $saoData->getCSData();
                    $ID = intval(BinhChu::xml_attribute($sao,'ID'));
                    array_push($saos,$CSData[$ID-1]);
                }

                foreach($cungsNode->Cung as $cung)
                {
                    $ID = intval(BinhChu::xml_attribute($cung,'ID'));
                    array_push($cungs,$ID);
                }

                foreach($lthansNode->LucThan as $lucthan)
                {
                    $ID = intval(BinhChu::xml_attribute($lucthan,'ID'));
                    array_push($lthans,$ID);
                }

                array_push($listBinhChu,new BinhChu($saos,$cungs,$lthans,$lbinh));

            }
            catch(Exception $e){

            }
        }
    }

    public static function xml_attribute($object, $attribute)
    {
        if(isset($object[$attribute]))
            return (string) $object[$attribute];
    }
}