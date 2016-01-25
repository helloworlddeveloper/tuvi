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

    public function __construct() {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();
        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

    public function __construct9($id, $ten, $hanh, $dac, $ham, $mieu, $vuong, $binh, $bacdt)
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
    public function __construct6($id, $ctinh, $ten, $hanh, $dac, $ham)
    {
        $this->ID = $id;
        $this->Ten = $ten;
        $this->Hanh = $hanh;
        $this->Dac = $dac;
        $this->Ham = $ham;
        $this->CacTinh = $ctinh;
    }
    public function __construct4($id, $ctinh, $ten, $hanh)
    {
        $this->ID = $id;
        $this->Ten = $ten;
        $this->Hanh = $hanh;
        $this->CacTinh = $ctinh;
    }
}