<?php
/**
 * Created by PhpStorm.
 * User: hoa
 * Date: 16/01/2016
 * Time: 15:35
 */

namespace Mongo\TuviBundle\CoreTuVi;

class  SaoData
{
    /*var: int*/
    public $ID;
    /*var: string*/
    public $Ten = ""; //Tên sao
    /*var: int*/
    public $Hanh;

    /*var: bool*/
    public $BacDT;
    /*var: bool*/
    public $CacTinh;

    //M?i m?t sao mang m?t hành,tu? theo v? trí ?óng thu?c cung nào thì ng??i ta quy ??nh mi?u, v??ng ,??c , bình , hãm
    public $Vuong = ""; // V??ng
    /*var: string*/
    public $Mieu = "";  // Mi?u
    /*var: string*/
    public $Dac = "";   // ??c
    /*var: string*/
    public $Binh = "";  // Bình
    /*var: string*/
    public $Ham = "";  // Hãm

    public function __construct1($id, $ten, $hanh, $dac, $ham, $mieu, $vuong, $binh, $bacdt)
    {
        $this->ID = $id;
        $this->Ten = $ten;
        $this->Hanh = $hanh;
        $this->BacDT = $bacdt;
        $this->Mieu = $mieu;
        $this->Vuong = $vuong;
        $this->Dac = $dac;
        $this->Binh = $binh;
        $this->Ham = $ham;
    }
    public function __construct2($id, $ctinh, $ten, $hanh, $dac, $ham)
    {
        $this->ID = $id;
        $this->Ten = $ten;
        $this->Hanh = $hanh;
        $this->Dac = $dac;
        $this->Ham = $ham;
        $this->CacTinh = $ctinh;
    }
    public function __construct3($id, $ctinh, $ten, $hanh)
    {
        $this->ID = $id;
        $this->Ten = $ten;
        $this->Hanh = $hanh;
        $this->CacTinh = $ctinh;
    }
}