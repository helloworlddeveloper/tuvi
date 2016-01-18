<?php
/**
 * Created by PhpStorm.
 * User: hoa
 * Date: 16/01/2016
 * Time: 20:14
 */

namespace Mongo\TuviBundle\CoreTuVi;


class LaSo
{
    /*var string*/
    public $Ten = "";

    /*var bool*/
    public $Male = true;

    /*var datetime */
    public $NgayDuong;

    /*var bool*/
    public $HasNgayDuong = true;

    /*var int*/
    public $DCGio;

    /*var int*/
    public $MuiGio = 7;

    /*var int*/
    public $NgayA;

    /*var int*/
    public $ThangA;

    /*var int*/
    public $TCNam; // Thiên can n?m

    /*var int*/
    public $DCNam; // ??a can n?m

    /*var int*/
    public $BinhGiai = "";

    function __construct1($ten, $male, $ngay, $thang, $tcnam, $dcnam, $dcgio, $muigio)
    {
        $this->Ten = $ten;
        $this->NgayA = $ngay;
        $this->ThangA = $thang;
        $this->TCNam = $tcnam;
        $this->DCNam = $dcnam;
        $this->DCGio = $dcgio;
        $this->MuiGio = $muigio;
        $this->Male = $male;
        $this->HasNgayDuong = false;
    }
    function __construct2($ten, $male, $ngay, $thang, $nam, $dcgio, $muigio)
    {
        $this->Ten = $ten;
        $this->NgayA = $ngay;
        $this->ThangA = $thang;
//        $this->TCNam = $tcnam;
//        $this->DCNam = $dcnam;
        $this->DCGio = $dcgio;
        $this->MuiGio = $muigio;
        $this->Male = $male;
        $this->HasNgayDuong = false;
    }
}