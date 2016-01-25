<?php
/**
 * Created by PhpStorm.
 * User: hoa
 * Date: 16/01/2016
 * Time: 20:14
 */

namespace Mongo\TuviBundle\CoreTuVi;
use Mongo\TuviBundle\CoreTuVi\NgayAm;

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
    public $TCNam; // Thiên can

    /*var int*/
    public $DCNam; // Địa can

    /*var int*/
    public $BinhGiai = "";

    public function __construct() {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

    function __construct8($ten, $male, $ngay, $thang, $tcnam, $dcnam, $dcgio, $muigio)
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

    function __construct7($ten, $male, $ngay, $thang, $nam, $dcgio, $muigio)
    {
        $this->Ten = $ten;
        $this->NgayDuong = "$nam-$thang-$ngay";
        $ngayam = new NgayAm($this->NgayDuong,$muigio);
        $this->NgayA = $ngayam->Mong;
        $this->ThangA = $ngayam->Thang;
        $this->TCNam = $ngayam->TCNam;
        $this->DCNam = $ngayam->DCNam;
        $this->DCGio = $dcgio;
        $this->MuiGio = $muigio;
        $this->Male = $male;
        $this->HasNgayDuong = false;
    }


}