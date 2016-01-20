<?php
/**
 * Created by PhpStorm.
 * User: hoavt
 * Date: 1/19/2016
 * Time: 11:06 AM
 */

namespace Mongo\TuviBundle\CoreTuVi;


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

    public function __construct($year,$timeZone)
    {
        $this->Year = $year;
        $this->Offset = doubleval($timeZone / 24.0 + 0.0);
        $prevDongChi = 0;
        $solarterm = array();

    }

}