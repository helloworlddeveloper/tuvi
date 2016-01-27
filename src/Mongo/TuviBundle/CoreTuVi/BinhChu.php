<?php
/**
 * Created by PhpStorm.
 * User: hoavt
 * Date: 1/26/2016
 * Time: 5:06 PM
 */

namespace Mongo\TuviBundle\CoreTuVi;


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
        $listBinhChu = array();
        $xmlData = simpleXML_load_file($pathFile);
        if($xmlData ===  true)
        {
            foreach($xmlData->children() as $binhChu) {
                echo $binhChu->title . ", ";
                echo $binhChu->author . ", ";
                echo $binhChu->year . ", ";
                echo $binhChu->price . "<br>";
            }
        }
        else
        {
            die('Can not load file data xml');
        }
    }
}