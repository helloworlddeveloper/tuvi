<?php
/**
 * Created by PhpStorm.
 * User: hoavt
 * Date: 1/20/2016
 * Time: 10:14 AM
 */

namespace Mongo\TuviBundle\CoreTuVi;
class SolarTerm
{
    private static $tlast = 0.0;

    private static $sine;

    private static $cose;

    private static $tmass;

    private static $pbary = array();

    private static $vbary = array();

    private static $pm = array(

        1047.349,
        3497.898,
        22903.0,
        19412.2
    );
    private static $pa = array(

        5.203363,
        9.53707,
        19.191264,
        30.068963
    );

    private static $pl = array(
        0.60047,
        0.871693,
        5.466933,
        5.32116
    );

    private static $pn = array(

        0.001450138,
        0.0005841727,
        0.0002047497,
        0.0001043891
    );
    public static $con;


    public static function addDataSolarTerm()
    {
        SolarTerm::$con = array(
            new sun_con(403406.0, 0.0, 4.721964, 1.621043),
            new sun_con(195207.0, -97597.0, 5.937458, 62830.348067),
            new sun_con(119433.0, -59715.0, 1.115589, 62830.821524),
            new sun_con(112392.0, -56188.0, 5.781616, 62829.634302),
            new sun_con(3891.0, -1556.0, 5.5474, 125660.5691),
            new sun_con(2819.0, -1126.0, 1.512, 125660.9845),
            new sun_con(1721.0, -861.0, 4.1897, 62832.4766),
            new sun_con(0.0, 941.0, 1.163, 0.813),
            new sun_con(660.0, -264.0, 5.415, 125659.31),
            new sun_con(350.0, -163.0, 4.315, 57533.85),
            new sun_con(334.0, 0.0, 4.553, -33.931),
            new sun_con(314.0, 309.0, 5.198, 777137.715),
            new sun_con(268.0, -158.0, 5.989, 78604.191),
            new sun_con(242.0, 0.0, 2.911, 5.412),
            new sun_con(234.0, -54.0, 1.423, 39302.098),
            new sun_con(158.0, 0.0, 0.061, -34.861),
            new sun_con(132.0, -93.0, 2.317, 115067.698),
            new sun_con(129.0, -20.0, 3.193, 15774.337),
            new sun_con(114.0, 0.0, 2.828, 5296.67),
            new sun_con(99.0, -47.0, 0.52, 58849.27),
            new sun_con(93.0, 0.0, 4.65, 5296.11),
            new sun_con(86.0, 0.0, 4.35, -3980.7),
            new sun_con(78.0, -33.0, 2.75, 52237.69),
            new sun_con(72.0, -32.0, 4.5, 55076.47),
            new sun_con(68.0, 0.0, 3.23, 261.08),
            new sun_con(64.0, -10.0, 1.22, 15773.85),
            new sun_con(46.0, -16.0, 0.14, 188491.03),
            new sun_con(38.0, 0.0, 3.44, -7756.55),
            new sun_con(37.0, 0.0, 4.37, 264.89),
            new sun_con(32.0, -24.0, 1.14, 117906.27),
            new sun_con(29.0, -13.0, 2.84, 55075.75),
            new sun_con(28.0, 0.0, 5.96, -7961.39),
            new sun_con(27.0, -9.0, 5.09, 188489.81),
            new sun_con(27.0, 0.0, 1.72, 2132.19),
            new sun_con(25.0, -17.0, 2.56, 109771.03),
            new sun_con(24.0, -11.0, 1.92, 54868.56),
            new sun_con(21.0, 0.0, 0.09, 25443.93),
            new sun_con(21.0, 31.0, 5.98, -55731.43),
            new sun_con(20.0, -10.0, 4.03, 60697.74),
            new sun_con(18.0, 0.0, 4.27, 2132.79),
            new sun_con(17.0, -12.0, 0.79, 109771.63),
            new sun_con(14.0, 0.0, 4.24, -7752.82),
            new sun_con(13.0, -5.0, 2.01, 188491.91),
            new sun_con(13.0, 0.0, 2.65, 207.81),
            new sun_con(13.0, 0.0, 4.98, 29424.63),
            new sun_con(12.0, 0.0, 0.93, -7.99),
            new sun_con(10.0, 0.0, 2.21, 46941.14),
            new sun_con(10.0, 0.0, 3.59, -68.29),
            new sun_con(10.0, 0.0, 1.5, 21463.25),
            new sun_con(10.0, -9.0, 2.55, 157208.4)
        );
    }

    private static function timeangle($t)
    {
        $sposg = array();
        $spos = array();
        $eposb = array();
        $evelb = array();
        $eposh = array();
        $evelh = array();
        $dummy = 0;
        $secdiff = 0;
        Novas::tdb2tdt($t, $dummy, $secdiff);

        $tdb = $t + $secdiff / 86400.0;
        SolarTerm::solarsystem($tdb, 3, 1, $eposh, $evelh);
        SolarTerm::solarsystem($tdb, 3, 0, $eposb, $evelb);
        $spos[0] = -$eposh[0];
        $spos[1] = -$eposh[1];
        $spos[2] = -$eposh[2];
        $lighttime = sqrt($spos[0] * $spos[0] + $spos[1] * $spos[1] + $spos[2] * $spos[2]) / 173.14463348;
        Novas::aberration($spos, $evelb, $lighttime, $sposg);
        Novas::precession(2451545.0, $sposg, $tdb, $spos);
        Novas::nutate($tdb, 0, $spos, $sposg);
        $y = sqrt($sposg[1] * $sposg[1] + $sposg[2] * $sposg[2]);
        $y *= (($sposg[1] > 0.0) ? 1.0 : -1.0);
        $angle = atan2($y, $sposg[0]) + 1.5707963267948966;
        if ($angle < 0.0) {
            $angle += 6.2831853071795862;
        }
        return $angle * 57.295779513082323;
    }

    private static function termtime($tstart, $tend, $termang)
    {
        $errlimit = 0.00034722222222222224;
        $f = (sqrt(5.0) - 1.0) / 2.0;
        $vs = abs(SolarTerm::timeangle($tstart) - $termang);
        $ve = abs(SolarTerm::timeangle($tend) - $termang);
        $tdif = $f * ($tend - $tstart);
        $tl = $tend - $tdif;
        $tu = $tstart + $tdif;
        $vl = abs(SolarTerm::timeangle($tl) - $termang);
        $vu = abs(SolarTerm::timeangle($tu) - $termang);
        while ($tend - $tstart > $errlimit) {
            if (($vl < $vu && $vl < $vs && $vl < $ve) || ($vs < $vu && $vs < $vl && $vs < $ve)) {
                $tend = $tu;
                $ve = $vu;
                $tu = $tl;
                $vu = $vl;
                $tdif = $f * ($tend - $tstart);
                $tl = $tend - $tdif;
                $vl = abs(SolarTerm::timeangle($tl) - $termang);
            } else {
                $tstart = $tl;
                $vs = $vl;
                $tl = $tu;
                $vl = $vu;
                $tdif = $f * ($tend - $tstart);
                $tu = $tstart + $tdif;
                $vu = abs(SolarTerm::timeangle($tu) - $termang);
            }
        }
        return ($tstart + $tend) / 2.0;
    }

    public static function solarterm($year, &$jdpws, &$vjdterms)
    {
        $dstart = (int)Novas::julian_date($year - 1, 12, 18, 12.0);
        $dend = (int)Novas::julian_date($year - 1, 12, 25, 12.0);
        $jdpws = SolarTerm::termtime(doubleval($dstart), doubleval($dend), 0.0);
        $vjdterms = array();
        for ($i = 0; $i < 24; $i += 1) {
            $month = $i / 2 + 1;
            $day = $i % 2 * 14;
            $dstart = (int)Novas::julian_date($year, $month, 1 + $day, 12.0);
            $dend = (int)Novas::julian_date($year, $month, 10 + $day, 12.0);
            $angle = doubleval($i + 1) * 15.0;
            $vjdterms[(int)$i] = SolarTerm::termtime(doubleval($dstart), doubleval($dend), $angle);
        }
    }

    private static function  solarsystem($tjd, $body, $origin, &$pos, &$vel)
    {
        $ierr = 0;
        $pos2 = array();
        $p = array(); //3x3
        if (SolarTerm::$tlast == 0.0) {
            $oblr = 0.40909280420293637;
            SolarTerm::$sine = sin($oblr);
            SolarTerm::$cose = cos($oblr);
            SolarTerm::$tmass = 1.0;
            for ($i = 0; $i < 4; $i += 1) {
                SolarTerm::$tmass += 1.0 / SolarTerm::$pm[(int)$i];
            }
            SolarTerm::$tlast = 1.0;
        }
        $pos = array();
        $vel = array();
        if ($body == 0 || $body == 1 || $body == 10) {
            for ($i = 0; $i < 3; $i += 1) {
                $pos[(int)$i] = ($vel[(int)$i] = 0.0);
            }
        } else {
            if ($body != 2 && $body != 3) {
                return 2;
            }
            for ($i = 0; $i < 3; $i += 1) {
                $qjd = $tjd + doubleval($i - 1) * 0.1;
                $ras = 0;
                $decs = 0;
                $diss = 0;
                SolarTerm::sun_eph($qjd, $ras, $decs, $diss);
                Novas::radec2vector($ras, $decs, $diss, $pos2);
                Novas::precession($qjd, $pos2, 2451545.0, $pos);
                $p[$i][0] = -$pos[0];
                $p[$i][1] = -$pos[1];
                $p[$i][2] = -$pos[2];
            }
            for ($i = 0; $i < 3; $i += 1) {
                $pos[(int)$i] = $p[1][(int)$i];
                $vel[(int)$i] = ($p[2][(int)$i] - $p[0][(int)$i]) / 0.2;
            }
        }
        if ($origin == 0) {
            if (abs($tjd - SolarTerm::$tlast) >= 1E-06) {
                for ($i = 0; $i < 3; $i += 1) {
                    SolarTerm::$pbary[(int)$i] = (SolarTerm::$vbary[(int)$i] = 0.0);
                }
                for ($i = 0; $i < 4; $i += 1) {
                    $dlon = SolarTerm::$pl[(int)$i] + SolarTerm::$pn[(int)$i] * ($tjd - 2451545.0);
                    $dlon %= 6.2831853071795862;
                    $sinl = Sin($dlon);
                    $cosl = Cos($dlon);
                    $x = SolarTerm::$pa[(int)$i] * $cosl;
                    $y = SolarTerm::$pa[(int)$i] * $sinl * SolarTerm::$cose;
                    $z = SolarTerm::$pa[(int)$i] * $sinl * SolarTerm::$sine;
                    $xdot = -SolarTerm::$pa[(int)$i] * SolarTerm::$pn[(int)$i] * $sinl;
                    $ydot = SolarTerm::$pa[(int)$i] * SolarTerm::$pn[(int)$i] * $cosl * SolarTerm::$cose;
                    $zdot = SolarTerm::$pa[(int)$i] * SolarTerm::$pn[(int)$i] * $cosl * SolarTerm::$sine;
                    $f = 1.0 / (SolarTerm::$pm[(int)$i] * SolarTerm::$tmass);
                    SolarTerm::$pbary[0] += $x * $f;
                    SolarTerm::$pbary[1] += $y * $f;
                    SolarTerm::$pbary[2] += $z * $f;
                    SolarTerm::$vbary[0] += $xdot * $f;
                    SolarTerm::$vbary[1] += $ydot * $f;
                    SolarTerm::$vbary[2] += $zdot * $f;
                }
                SolarTerm::$tlast = $tjd;
            }
            for ($i = 0; $i < 3; $i += 1) {
                $pos[(int)$i] -= SolarTerm::$pbary[(int)$i];
                $vel[(int)$i] -= SolarTerm::$vbary[(int)$i];
            }
        }
        return $ierr;
    }

    private static function sun_eph($jd, &$ra, &$dec, &$dis)
    {
        SolarTerm::addDataSolarTerm();
        $sum_lon = 0.0;
        $sum_r = 0.0;
        $u = ($jd - 2451545.0) / 3652500.0;
        for ($i = 0; $i < 50; $i += 1) {
            $arg = SolarTerm::$con[(int)$i]->alpha + SolarTerm::$con[(int)$i]->nu * $u;
            $sum_lon += SolarTerm::$con[(int)$i]->l * sin($arg);
            $sum_r += SolarTerm::$con[(int)$i]->r * cos($arg);
        }
        $lon = 4.9353929 + 62833.196168 * $u + 1E-07 * $sum_lon;
        $lon %= 6.2831853071795862;
        if ($lon < 0.0) {
            $lon += 6.2831853071795862;
        }
        $dis = 1.0001026 + 1E-07 * $sum_r;
        $t = $u * 100.0;
        $t2 = $t * $t;
        $emean = (0.001813 * $t2 * $t - 0.00059 * $t2 - 46.815 * $t + 84381.448) / 206264.80624709636;
        $sin_lon = sin($lon);
        $ra = atan2(cos($emean) * $sin_lon, cos($lon)) * 57.295779513082323;
        $ra %= 360.0;
        if ($ra < 0.0) {
            $ra += 360.0;
        }
        $ra /= 15.0;
        $dec = asin(sin($emean) * $sin_lon) * 57.295779513082323;
    }
}

class sun_con
{
    public $l;

    public $r;

    public $alpha;

    public $nu;

    public function __construct($L, $R, $Alpha, $Nu)
    {
        $this->l = $L;
        $this->r = $R;
        $this->alpha = $Alpha;
        $this->nu = $Nu;
    }

    public function getL()
    {
        return $this->l;
    }
    public function getR()
    {
        return $this->r;
    }
    public function getAlpha()
    {
        return $this->alpha;
    }
    public function getNu()
    {
        return $this->nu;
    }
}

