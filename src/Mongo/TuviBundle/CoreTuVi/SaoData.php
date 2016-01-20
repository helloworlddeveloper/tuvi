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


    public $Vuong = "";
    /*var: string*/
    public $Mieu = "";
    /*var: string*/
    public $Dac = "";
    /*var: string*/
    public $Binh = "";
    /*var: string*/
    public $Ham = "";

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