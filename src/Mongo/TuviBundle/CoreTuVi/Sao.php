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
     * @var string
     * */
    public $Pos;
    /*
     * @var string
     */
    public $Dia;
    /*
     * @var int
     */
    public $Hanh;
    /*
     * @var bool
     */
    public  $BacDauTinh;
    /*
     * @var bool
     */
    public  $CatTinh;
    /*
     * @var bool
     */
    public  $IsRealSao;
    /*
     * @var bool
     */
    public  $IsPhiTinh;

    function __construct1($id,$pos, $type,SaoData $SaoData, SaoDatabase $SaoDatabase)
    {
        $this->ID = $id;
        $this->Type = $type;
        $this->Pos = $pos;
        if ($type == 'C' || $type == 'B' || $type == 'S' || $type == 'K') {
            $SaoData = $SaoDatabase->getCSData()[$id - 1];
            $this->Ten = $SaoData->Ten;
            $this->Hanh = $SaoData->Hanh;
            $this->BacDauTinh = $SaoData->BacDT;
            $this->CatTinh = $SaoData->CacTinh;
            $this->IsRealSao = true;
            $this->Dia = $this->DacHamDia($pos, $SaoData);
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