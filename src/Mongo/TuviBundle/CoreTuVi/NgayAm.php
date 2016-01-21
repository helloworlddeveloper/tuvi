<?php
/**
 * Created by PhpStorm.
 * User: hoa
 * Date: 16/01/2016
 * Time: 22:40
 */

namespace Mongo\TuviBundle\CoreTuVi;
use Mongo\TuviBundle\CoreTuVi\LunarYear;
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
        $this->NgayDuong = new DateTime($ngayDuong);
        $year = date_format($this->NgayDuong, 'Y');
        $this->SolartoLunar($year);
        $this->FindTCDCNgay();
        $this->FindTCDCThang();

    }

    public function __construct2($ngayDuong, $timeZone)
    {
        $this->NgayDuong = new DateTime($ngayDuong);
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
        $listThang = $this->ListThangAm($year);
			if ($this->NgayDuong < $listThang[0]->NewMoon)
			{
                $this->SolartoLunar($year - 1);
                return;
            }
			for ($i = 0; $i < count($listThang); $i++)
			{
                if ($i < count($listThang) - 1)
                {
                    if ($this->NgayDuong < $listThang[$i + 1]->NewMoon)
					{
                        $this->Thang = $listThang[$i]->Number;
						$this->IsLeapMonth = $listThang[$i]->Leap;
						$this->Mong = $this->NgayDuong->diff($listThang[$i]->NewMoon)->days + 1;
						if ($this->Thang == 12)
                        {
                            $this->FindTCDCNam($year - 1);
                        }
                        else
                        {
                            $this->FindTCDCNam($year);
                        }
						$this->IsFullMonth = $listThang[$i]->Full;
						return;
					}
				}
                else
                {
                    $this->Thang = 12;
                    $this->IsLeapMonth = false;
                    $this->Mong = $this->NgayDuong->diff($listThang[count($listThang) - 1]->NewMoon)->days + 1;
					$this->FindTCDCNam($year);
					$this->IsFullMonth = $listThang[count($listThang) - 1]->Full;
				}
            }
		}

    public function listStructThangAm($so_luong)
    {
        $ret = array();
        for ($i = 0; $i < $so_luong; $i++) {
            $ret[] = Struct::factory('NewMoon', 'Leap', 'Full', 'Number');
        }
        return $ret;
    }

    private function ListThangAm($Year)
    {
        $Nam = new LunarYear($Year, $this->TimeZone);
        $NamN = new LunarYear(($Year + 1), $this->TimeZone);

        if ($Nam->Leap < 0) {
            $ret = $this->listStructThangAm(13);
            for ($i = 0; $i < 12; $i++) {
                $ret[$i]->NewMoon = $Nam->NewMoons[$i];
                $ret[$i]->Leap = false;
                if ($i == 0) {
                    $ret[$i]->Number = 12;
                } else {
                    $ret[$i]->Number = $i;
                }
            }
            $ret[12]->NewMoon = $NamN->NewMoons[0];
            $ret[12]->Leap = false;
            $ret[12]->Number = 12;
        } else {
            $ret = $this->listStructThangAm(14);
            for ($i = 0; $i < 13; $i++) {
                $ret[$i]->NewMoon = $Nam->NewMoons[$i];
                $ret[$i]->Leap = false;
                if ($i == 0) {
                    $ret[$i]->Number = 12;
                } else {
                    $ret[$i]->Number = $i;
                }
                if ($Nam->Leap == 1 & $i == 1) {
                    $ret[$i]->Number = 12;
                    $ret[$i]->Leap = true;
                }
                if ((int)$Nam->Leap <= $i & $i > 1) {
                    $ret[$i]->Number = $i - 1;
                    if ((int)$Nam->Leap == $i) {
                        $ret[$i]->Leap = true;
                    }
                }
            }
            $ret[13]->NewMoon = $NamN->NewMoons[0];
            $ret[13]->Leap = false;
            $ret[13]->Number = 12;
        }
        for ($i = 0; $i < count($ret); $i++) {
            if ($i < count($ret) - 1) {
                $tuantrang = $ret[$i + 1]->NewMoon->diff($ret[$i]->NewMoon);
            } else {
                $tuantrang = $NamN->NewMoons[1]->diff($ret[$i]->NewMoon);
            }
            $ret[$i]->Full = ($tuantrang->days > 29) ? true : false;
        }
        return $ret;
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
        $timeSpan = $this->NgayDuong->diff(new DateTime('1898-01-22 00:00:00'));
        $this->TCNgay = (2 + $timeSpan->days) % 10;
        if ($this->TCNgay == 0) {
            $this->TCNgay = 10;
        }
        $this->DCNgay = (10 + $timeSpan->days) % 12;
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

