<?php
/**
 * Created by PhpStorm.
 * User: hoa
 * Date: 16/01/2016
 * Time: 15:05
 */

namespace Mongo\TuviBundle\CoreTuVi;

class Sao
{
    /*
     * @var int
     * */
    public $ID;
    /*
     * @var string
     * */
    public $Ten;
    /*
     * @var int
     * */
    public $Type;
    /*
     * @var int
     * */
    public $Pos;
    /*
     * @var string
     */
    public $Dia = "";
    /*
     * @var int
     */
    public $Hanh;
    /*
     * @var bool
     */
    public  $BacDauTinh = false;
    /*
     * @var bool
     */
    public  $CatTinh = false;
    /*
     * @var bool
     */
    public  $IsRealSao =false;
    /*
     * @var bool
     */
    public  $IsPhiTinh = false;

    function __construct($id = null,$pos = null, $type = null)
    {
        if($id != null && $pos != null && $type != null)
        {
            $SaoDatabase = new SaoDatabase();
            $this->ID = $id;
            $this->Type = $type;
            $this->Pos = $pos;
            if ($type == 'C' || $type == 'B' || $type == 'S' || $type == 'K') {
                $SaoData = $SaoDatabase->getCSData()[$id - 1];
                $this->Ten = $SaoData->Ten;
                $this->Hanh = $SaoData->Hanh;
                $this->BacDauTinh = isset($SaoData->BacDT) && !empty($SaoData->BacDT)? $SaoData->BacDT : false;
                $this->CatTinh =  isset($SaoData->CacTinh) && !empty($SaoData->CacTinh)? $SaoData->CacTinh : false;
                $this->IsRealSao = true;
                $this->IsPhiTinh = false;
                $this->Dia = $this->DacHamDia($pos, $SaoData);
            }
        }

    }

    private function DacHamDia($pos,SaoData $csao)
    {
        $dh = '';
        if ($pos == 10)
        {
            $dh = "a";
        }
        else if ($pos == 11)
        {
            $dh = "b";
        }
        else if ($pos == 12)
        {
            $dh = "c";
        }
        else
        {
            $dh = strval($pos);
        }
        $temp = $csao->Dac;
        if (strpos($temp,$dh)> -1)
        {
            return 'Đ';
        }
        if (strlen($csao->Ham) == 0 && strlen($temp) >0)
        {
            return 'H';
        }
        $temp = $csao->Ham;
        if (strpos($temp,$dh)> -1)
        {
            return 'H';
        }

        $temp = $csao->Mieu;
        if (strpos($temp,$dh)> -1)
        {
            return 'M';
        }
        $temp = $csao->Vuong;
        if (strpos($temp,$dh)> -1)
        {
            return 'V';
        }

        $temp = $csao->Binh;
        if (strpos($temp,$dh)> -1)
        {
            return 'B';
        }
        return 'N';
    }
}