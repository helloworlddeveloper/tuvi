<?php
/**
 * Created by PhpStorm.
 * User: hoavt
 * Date: 1/21/2016
 * Time: 11:18 AM
 */

namespace Mongo\TuviBundle\CoreTuVi;

use DateTime;

class NgayBatTu
{
    const  CANNAMGOC = 5;

    const  CHINAMGOC = 11;

    const  CANNGAYGOC = 2;

    const  CHINGAYGOC = 10;

    private static $CANCHIGOC;

    public $NgayDuong;

    public $Offset;

    public $TCNam;

    public $DCNam;

    public $TCThang;

    public $DCThang;

    public $TCNgay;

    public $DCNgay;

    public $TCGio;

    public $DCGio;

    public $IsBeforeHaChi;

    public $NamHaLac;

    public $Nguon;

    function __construct1($ngayDuong, $dcgio, $timezone)
    {
        $this->NgayDuong = new DateTime($ngayDuong);
        $this->Offset = doubleval($timezone / 24);
        $this->DCGio = $dcgio;
        $this->TinhCanChiThang();
        $this->TinhCanChiNgay();
        $this->TCGio = $this->SoDu(1 + ($this->TCNgay - 1) * 12 + $this->DCGio - 1, 10);
        $this->Nguon = NgayBatTu::XetNguon($this->NamHaLac);
    }

    private function TinhCanChiNgay()
    {
        $songay = $this->NgayDuong->diff(new DateTime(1898, 1, 22, 0, 0, 0))->days;
        $this->TCNgay = $this->SoDu(2 + $songay, 10);
        $this->DCNgay = $this->SoDu(10 + $songay, 12);
    }

    private function TinhCanChiNam()
    {
        $this->TCNam = $this->SoDu(5 + $this->NamHaLac - 1898, 10);
        $this->DCNam = $this->SoDu(11 + $this->NamHaLac - 1898, 12);
    }

    private function TinhCanChiThang()
    {
        $Thang = 0;
        $calYear = $this->NgayDuong->format("y");
        $Hachi = new DateTime();
        $solarTerms = $this->CalSolarTerm($calYear, $Hachi);
        if ($this->NgayDuong < $solarTerms[0]) {
            $calYear--;
            $solarTerms = $this->CalSolarTerm($calYear, $Hachi);
        }
        if ($this->NgayDuong < $Hachi) {
            $this->IsBeforeHaChi = true;
        } else {
            $this->IsBeforeHaChi = false;
        }
        if ($this->NgayDuong >= $solarTerms[0] & $this->NgayDuong < $solarTerms[1]) {
            $Thang = 12;
            $this->NamHaLac = $calYear - 1;
            $this->IsBeforeHaChi = false;
        }
        $i = 0;
        for ($i = 1; $i < 11; $i++) {
            if ($this->NgayDuong >= $solarTerms[$i] & $this->NgayDuong < $solarTerms[$i + 1]) {
                $Thang = $i;
                $this->NamHaLac = $calYear;
                break;
            }
        }
        if ($this->NgayDuong >= $solarTerms[11]) {
            $Thang = $i;
            $this->NamHaLac = $calYear;
        }
        $this->TinhCanChiNam();
        $this->TCThang = $this->SoDu(1 + ($this->TCNam - 1) * 12 + 2 + $Thang - 1, 10);
        $this->DCThang = $this->SoDu(3 + $Thang - 1, 12);
    }

    private function CalSolarTerm($year, &$hachi)
    {
        $JDSolarTerms = array();
        $solarTerms = array();
        $JDDChi = 0;
        SolarTerm::solarterm($year, $JDDChi, $JDSolarTerms);
        for ($i = 0; $i < 24; $i++) {
            if ($i % 2 == 0) {
                $solarTerms[$i/2] = NgayBatTu::JDtoDate($JDSolarTerms[$i] + $this->Offset);
            }
        }
        $hachi = NgayBatTu::JDtoDate($JDSolarTerms[11] + $this->Offset);
        return $solarTerms;
    }

    public static function JDtoDate($jd)
    {
        $dateTimeString = jdtogregorian($jd);
        return new DateTime($dateTimeString);
    }


    private function SoDu($so, $coso)
    {
        $ret = $so % $coso;
        if ($ret <= 0) {
            return $ret + $coso;
        }
        return $ret;
    }

    private function  XetNguon($namdng)
    {
        if ($namdng >= 1864 && $namdng < 1924) {
            return 1;
        }
        if ($namdng >= 1924 && $namdng < 1984) {
            return 2;
        }
        if ($namdng >= 1984 && $namdng < 2044) {
            return 3;
        }
        return 0;
    }
}