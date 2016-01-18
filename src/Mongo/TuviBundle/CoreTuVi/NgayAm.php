<?php
/**
 * Created by PhpStorm.
 * User: hoa
 * Date: 16/01/2016
 * Time: 22:40
 */

namespace Mongo\TuviBundle\CoreTuVi;

use DateTime as DateTime;

class NgayAm
{
    const  CANNAMGOC = 5;
    const  CHINAMGOC = 11;
    const  CANNGAYGOC = 2;
    const  CHINGAYGOC = 10;
    public $CANCHIGOC;

    public $Mong;

    public $Thang;

    public $TCNam;

    public $DCNam;

    public $TCThang;

    public $DCThang;

    public $TCNgay;

    public $DCNgay;

    public $IsLeapMonth;

    public $IsFullMonth;

    public $NgayDuong;

    public $TimeZone = 7;

    public $ThangAm;

    public function __construct1(DateTime $ngayDuong)
    {
        $this->CANCHIGOC = new DateTime('1898-01-22 00:00:00');
        $this->NgayDuong = $ngayDuong;
        $this->ThangAm = new ThangAm();

    }
}

class ThangAm
{
    public $NewMoon;
    public $Leap;
    public $Full;
    public $number;
}