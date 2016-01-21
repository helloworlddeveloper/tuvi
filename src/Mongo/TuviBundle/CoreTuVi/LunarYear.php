<?php
/**
 * Created by PhpStorm.
 * User: hoavt
 * Date: 1/19/2016
 * Time: 11:06 AM
 */

namespace Mongo\TuviBundle\CoreTuVi;
use \DateTime;

class LunarYear
{
    /*var : short*/
    public $Year;

    /*var : Datetime array*/
    public $NewMoons;

    /*var : Datetime array*/
    public $SolarTerms;
    /*var : int*/
    public $Leap;

    /*var : double*/
    public $Offset = 0.29166666666666669;

    public function __construct($year, $timeZone)
    {
        $this->Year = $year;
        $this->Offset = doubleval($timeZone / 24.0 + 0.0);
        $prevDongChi = 0;
        $solarterm = array();
        SolarTerm::solarterm($this->Year, $prevDongChi, $solarterm);
        for ($i = 0; $i < 24; $i++) {
            $this->SolarTerms[$i] = LunarYear::JDtoDate($solarterm[$i] + $this->Offset);
        }
        $lun = $this->StrartLun($prevDongChi, $this->Offset);
        $newMoon = MoonPhase::moonphasebylunation($lun, 0);
        $this->NewMoons = array();
        $this->NewMoons[0] = LunarYear::JDtoDate($newMoon + $this->Offset);
        $j = 0;
        while ($this->NewMoons[$j] < $this->SolarTerms[23]) {
            $j++;
            $newMoon = MoonPhase::moonphasebylunation($lun + $j, 0);
            $this->NewMoons[$j] = LunarYear::JDtoDate($newMoon + $this->Offset);
        }
        $this->Leap = $this->FindLeafMonth($this->NewMoons, $this->SolarTerms);
    }

    private function  FindLeafMonth($NewMoons, $SolarTerms)
    {
        if (count($NewMoons) < 13) {
            return -1;
        }
        for ($i = 0; $i < 12; $i++) {
            if ($SolarTerms[2 * $i + 1] >= $NewMoons[$i + 1]) {
                return (int)$i;
            }
        }
        return -1;
    }

    public static function JDtoDate($jd)
    {
        return $dateTimeString = jdtogregorian($jd);
    }

    private function StrartLun($prevDongChi, $offset)
    {
        $lunperiod = 29.530588853;
        $lun = (int)(($prevDongChi - 2451550.09765) / $lunperiod);
        $newMoonAfterDongChi = MoonPhase::moonphasebylunation($lun, 0);
        $newMoonAfterDongChi2 = MoonPhase::moonphasebylunation($lun + 1, 0);
        $dongChi = LunarYear::JDtoDate($prevDongChi + $offset);
        $newMoon = LunarYear::JDtoDate($newMoonAfterDongChi + $offset);
        $newMoon2 = LunarYear::JDtoDate($newMoonAfterDongChi2 + $offset);

        $newMoon = new DateTime($newMoon);
        $dongChi = new DateTime($dongChi);
        $newMoon2 = new DateTime($newMoon2);

        if ($newMoon < $dongChi & $newMoon2 >= $dongChi) {
            $lun++;
        }
        if ($newMoon2 < $dongChi) {
            $lun += 2;
        }
        return $lun;
    }
}