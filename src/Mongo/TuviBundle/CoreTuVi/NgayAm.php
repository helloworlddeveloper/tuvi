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
        $year = date_format($this->NgayDuong, 'Y');
        $this->SolartoLunar($year);
        $this->FindTCDCNgay();
        $this->FindTCDCThang();

    }

    public function __construct2($ngayDuong, $timeZone)
    {
        $this->NgayDuong = $ngayDuong;
        $this->TimeZone = $timeZone;
        $year = date_format($this->NgayDuong, 'Y');
        $this->SolartoLunar($year);
        $this->FindTCDCNgay();
        $this->FindTCDCThang();
    }

    public function GetTCGio($chigio)
    {
        return $this->SoDu(1 + ($this->TCNgay - 1) * 12 + $chigio - 1, 10);
    }


    private function SolartoLunar($year)
    {
        NgayAm . ThangAm[] array = this . ListThangAm(year);
if ($this->NgayDuong < array[0] . $NewMoon) {
    $this->SolartoLunar($year - 1);
    return;
}
for (int i = 0; i < array.Length; i++)
			{
                if (i < array.Length - 1) {
                    if (this . NgayDuong < array[i + 1] . NewMoon) {
                        this . Thang = array[i] . Number;
                        this . IsLeapMonth = array[i] . Leap;
                        this . Mong = (this . NgayDuong - array[i] . NewMoon) . Days + 1;
                        if (this . Thang == 12) {
                            this . FindTCDCNam(year - 1);
                        } else {
                            this . FindTCDCNam(year);
                        }
                        this . IsFullMonth = array[i] . Full;
                        return;
                    }
                } else {
                    this . Thang = 12;
                    this . IsLeapMonth = false;
                    this . Mong = (this . NgayDuong - array[array.Length - 1] . NewMoon) . Days + 1;
                    this . FindTCDCNam(year);
                    this . IsFullMonth = array[array.Length - 1] . Full;
                }
            }
		}


    private function FindTCDCNam($nam)
    {
        $this->TCNam = (5 + $nam - 1898) % 10;
        if ($this->TCNam == 0) {
            $this->TCNam = 10;
        }
        $this->DCNam = (11 + $nam - 1898) % 12;
        if ($this->DCNam == 0) {
            $this->DCNam = 12;
        }
    }

    private function FindTCDCNgay()
    {
        $timeSpan = $this->NgayDuong - new DateTime('1898-01-22 00:00:00');
        $this->TCNgay = (2 + $timeSpan . Days) % 10;
        if ($this->TCNgay == 0) {
            $this->TCNgay = 10;
        }
        $this->DCNgay = (10 + $timeSpan . Days) % 12;
        if ($this->DCNgay == 0) {
            $this->DCNgay = 12;
        }
    }

    private function FindTCDCThang()
    {
        $this->TCThang = $this->SoDu(1 + ($this->TCNam - 1) * 12 + 2 + $this->Thang - 1, 10);
        $this->DCThang = $this->SoDu(3 + $this->Thang - 1, 12);
    }

    public function SoDu($so, $coso)
    {
        $num = $so % $coso;
        if ($num <= 0) {
            return $num + $coso;
        }
        return $num;
    }
}

class ThangAm
{
    public $NewMoon;
    public $Leap;
    public $Full;
    public $number;
}