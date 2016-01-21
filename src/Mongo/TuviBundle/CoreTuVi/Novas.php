<?php
/**
 * Created by PhpStorm.
 * User: hoavt
 * Date: 1/19/2016
 * Time: 3:34 PM
 */

namespace Mongo\TuviBundle\CoreTuVi;
use \DateTime;

class Novas
{

    const FN0 = 0;

    const T0 = 2451545.0;

    const C = 173.14463348;

    const TWOPI = 6.2831853071795862;

    const RAD2SEC = 206264.80624709636;

    const DEG2RAD = 0.017453292519943295;

    const  RAD2DEG = 57.295779513082323;

    const  BARYC = 0;

    const  HELIOC = 1;

//    private static double PSI_COR;
    private static $PSI_COR;

//    private static double EPS_COR;
    private static $EPS_COR;

//    private static double tjd_last;
    private static $tjd_last;

//    private static double t;
    private static $t;

//    private static double dp;
    private static $dp;

//    private static double de;
    private static $de;

    private static function earthtilt($tjd, &$mobl, &$tobl, &$eq, &$dpsi, &$deps)
    {
        $args = array();
        Novas::$t = ($tjd - 2451545.0) / 36525.0;
        if (abs($tjd - Novas::$tjd_last) > 1E-06) {
            Novas::nutation_angles(Novas::$t, Novas::$dp, Novas::$de);
        }
        $d_psi = Novas::$dp + Novas::$PSI_COR;
        $d_eps = Novas::$de + Novas::$EPS_COR;
        $mean_obliq = 84381.448 - 46.815 * Novas::$t - 0.00059 * pow(Novas::$t, 2.0) + 0.001813 * pow(Novas::$t, 3.0);
        $true_obliq = $mean_obliq + $d_eps;
        $mean_obliq /= 3600.0;
        $true_obliq /= 3600.0;
        Novas::fund_args(Novas::$t, $args);
        $eq_eq = $d_psi * cos($mean_obliq * 0.017453292519943295) + (0.00264 * sin($args[4]) + 6.3E-05 * sin(2.0 * $args[4]));
        $eq_eq /= 15.0;
        Novas::$tjd_last = $tjd;
        $dpsi = $d_psi;
        $deps = $d_eps;
        $eq = $eq_eq;
        $mobl = $mean_obliq;
        $tobl = $true_obliq;
    }

    public static function aberration($pos, $ve, $lighttime, &$pos2)
    {
        $p1mag = 0;
        if ($lighttime == 0.0) {
            $p1mag = sqrt(pow($pos[0], 2.0) + pow($pos[1], 2.0) + pow($pos[2], 2.0));
            $lighttime = $p1mag / 173.14463348;
        } else {
            $p1mag = $lighttime * 173.14463348;
        }
        $vemag = sqrt(pow($ve[0], 2.0) + pow($ve[1], 2.0) + pow($ve[2], 2.0));
        $beta = $vemag / 173.14463348;
        $dot = $pos[0] * $ve[0] + $pos[1] * $ve[1] + $pos[2] * $ve[2];
        $cosd = $dot / ($p1mag * $vemag);
        $gammai = sqrt(1.0 - pow($beta, 2.0));
        $p = $beta * $cosd;
        $q = (1.0 + $p / (1.0 + $gammai)) * $lighttime;
        $r = 1.0 + $p;
        $pos2 = array();
        for ($i = 0; $i < 3; $i += 1) {
            $pos2[(int)$i] = ($gammai * $pos[(int)$i] + $q * $ve[(int)$i]) / $r;
        }
        return 0;
    }

    public static function  precession($tjd1, $pos, $tjd2, &$pos2)
    {
        $t = ($tjd1 - 2451545.0) / 36525.0;
        $t2 = ($tjd2 - $tjd1) / 36525.0;
        $t3 = $t * $t;
        $t4 = $t2 * $t2;
        $t5 = $t4 * $t2;
        $zeta0 = (2306.2181 + 1.39656 * $t - 0.000139 * $t3) * $t2 + (0.30188 - 0.000344 * $t) * $t4 + 0.017998 * $t5;
        $zee = (2306.2181 + 1.39656 * $t - 0.000139 * $t3) * $t2 + (1.09468 + 6.6E-05 * $t) * $t4 + 0.018203 * $t5;
        $theta = (2004.3109 - 0.8533 * $t - 0.000217 * $t3) * $t2 + (-0.42665 - 0.000217 * $t) * $t4 - 0.041833 * $t5;
        $zeta0 /= 206264.80624709636;
        $zee /= 206264.80624709636;
        $theta /= 206264.80624709636;
        $cz0 = cos($zeta0);
        $sz0 = sin($zeta0);
        $ct = cos($theta);
        $st = sin($theta);
        $cz = cos($zee);
        $sz = sin($zee);
        $xx = $cz0 * $ct * $cz - $sz0 * $sz;
        $yx = -$sz0 * $ct * $cz - $cz0 * $sz;
        $zx = -$st * $cz;
        $xy = $cz0 * $ct * $sz + $sz0 * $cz;
        $yy = -$sz0 * $ct * $sz + $cz0 * $cz;
        $zy = -$st * $sz;
        $xz = $cz0 * $st;
        $yz = -$sz0 * $st;
        $zz = $ct;
        $pos2 = array();
        $pos2[0] = $xx * $pos[0] + $yx * $pos[1] + $zx * $pos[2];
        $pos2[1] = $xy * $pos[0] + $yy * $pos[1] + $zy * $pos[2];
        $pos2[2] = $xz * $pos[0] + $yz * $pos[1] + $zz * $pos[2];
    }

    public static function nutate($tjd, $fn, $pos, &$pos2)
    {
        $oblm = 0;
        $oblt = 0;
        $eqeq = 0;
        $psi = 0;
        $eps = 0;
        Novas::earthtilt($tjd, $oblm, $oblt, $eqeq, $psi, $eps);
        $cobm = cos($oblm * 0.017453292519943295);
        $sobm = sin($oblm * 0.017453292519943295);
        $cobt = cos($oblt * 0.017453292519943295);
        $sobt = sin($oblt * 0.017453292519943295);
        $cpsi = cos($psi / 206264.80624709636);
        $spsi = sin($psi / 206264.80624709636);
        $xx = $cpsi;
        $yx = -$spsi * $cobm;
        $zx = -$spsi * $sobm;
        $xy = $spsi * $cobt;
        $yy = $cpsi * $cobm * $cobt + $sobm * $sobt;
        $zy = $cpsi * $sobm * $cobt - $cobm * $sobt;
        $xz = $spsi * $sobt;
        $yz = $cpsi * $cobm * $sobt - $sobm * $cobt;
        $zz = $cpsi * $sobm * $sobt + $cobm * $cobt;
        if ($fn > 0) {
            $pos2 = array();
            $pos2[0] = $xx * $pos[0] + $yx * $pos[1] + $zx * $pos[2];
            $pos2[1] = $xy * $pos[0] + $yy * $pos[1] + $zy * $pos[2];
            $pos2[2] = $xz * $pos[0] + $yz * $pos[1] + $zz * $pos[2];
        } else {
            $pos2 = array();
            $pos2[0] = $xx * $pos[0] + $xy * $pos[1] + $xz * $pos[2];
            $pos2[1] = $yx * $pos[0] + $yy * $pos[1] + $yz * $pos[2];
            $pos2[2] = $zx * $pos[0] + $zy * $pos[1] + $zz * $pos[2];
        }
        return 0;
    }

    private static function  nutation_angles($t, &$longnutation, &$obliqnutation)
    {
        $clng = array(
            1.0,
            1.0,
            -1.0,
            -1.0,
            1.0,
            -1.0,
            -1.0,
            -1.0,
            -1.0,
            -1.0,
            -1.0,
            1.0,
            -1.0,
            1.0,
            -1.0,
            1.0,
            1.0,
            -1.0,
            -1.0,
            1.0,
            1.0,
            -1.0,
            1.0,
            -1.0,
            1.0,
            -1.0,
            -1.0,
            -1.0,
            1.0,
            -1.0,
            -1.0,
            1.0,
            -1.0,
            1.0,
            2.0,
            2.0,
            2.0,
            2.0,
            2.0,
            -2.0,
            2.0,
            2.0,
            2.0,
            3.0,
            -3.0,
            -3.0,
            3.0,
            -3.0,
            3.0,
            -3.0,
            3.0,
            4.0,
            4.0,
            -4.0,
            -4.0,
            4.0,
            -4.0,
            5.0,
            5.0,
            5.0,
            -5.0,
            6.0,
            6.0,
            6.0,
            -6.0,
            6.0,
            -7.0,
            7.0,
            7.0,
            -7.0,
            -8.0,
            10.0,
            11.0,
            12.0,
            -13.0,
            -15.0,
            -16.0,
            -16.0,
            17.0,
            -21.0,
            -22.0,
            26.0,
            29.0,
            29.0,
            -31.0,
            -38.0,
            -46.0,
            48.0,
            -51.0,
            58.0,
            59.0,
            63.0,
            63.0,
            -123.0,
            129.0,
            -158.0,
            -217.0,
            -301.0,
            -386.0,
            -517.0,
            712.0,
            1426.0,
            2062.0,
            -2274.0,
            -13187.0,
            -171996.0
        );
        $clngx = array(
            0.1,
            -0.1,
            0.1,
            0.1,
            0.1,
            0.1,
            0.2,
            -0.2,
            -0.4,
            0.5,
            1.2,
            -1.6,
            -3.4,
            -174.2
        );
        $cobl = array(

            1.0,
            1.0,
            1.0,
            -1.0,
            -1.0,
            -1.0,
            1.0,
            1.0,
            1.0,
            1.0,
            1.0,
            -1.0,
            1.0,
            -1.0,
            1.0,
            -1.0,
            -1.0,
            -1.0,
            1.0,
            -1.0,
            1.0,
            1.0,
            -1.0,
            -2.0,
            -2.0,
            -2.0,
            3.0,
            3.0,
            -3.0,
            3.0,
            3.0,
            -3.0,
            3.0,
            3.0,
            -3.0,
            3.0,
            3.0,
            5.0,
            6.0,
            7.0,
            -7.0,
            7.0,
            -8.0,
            9.0,
            -10.0,
            -12.0,
            13.0,
            16.0,
            -24.0,
            26.0,
            27.0,
            32.0,
            -33.0,
            -53.0,
            54.0,
            -70.0,
            -95.0,
            129.0,
            200.0,
            224.0,
            -895.0,
            977.0,
            5736.0,
            92025.0
        );
        $coblx = array(
            -0.1,
            -0.1,
            0.3,
            0.5,
            -0.5,
            -0.6,
            -3.1,
            8.9
        );
        $nav = array(
            0,
            0,
            1,
            0,
            2,
            1,
            3,
            0,
            4,
            0
        );
        $nav2 = array(
            0,
            0,
            0,
            5,
            1,
            1,
            3,
            3,
            4,
            4
        );
        $nav3 = array(
            2,
            0,
            1,
            1,
            5,
            2,
            2,
            0,
            2,
            1,
            0,
            3,
            2,
            5,
            8,
            1,
            17,
            8,
            1,
            18,
            0,
            2,
            0,
            8,
            0,
            1,
            3,
            2,
            1,
            8,
            0,
            17,
            1,
            1,
            15,
            1,
            2,
            21,
            1,
            1,
            2,
            8,
            2,
            0,
            29,
            1,
            21,
            2,
            2,
            1,
            29,
            2,
            0,
            9,
            2,
            5,
            4,
            2,
            0,
            4,
            0,
            1,
            9,
            2,
            1,
            4,
            0,
            2,
            9,
            2,
            2,
            4,
            1,
            14,
            44,
            2,
            0,
            45,
            2,
            5,
            44,
            2,
            50,
            0,
            1,
            36,
            2,
            2,
            5,
            45,
            1,
            37,
            2,
            2,
            1,
            45,
            2,
            1,
            44,
            2,
            53,
            1,
            2,
            8,
            4,
            1,
            40,
            3,
            2,
            17,
            4,
            2,
            0,
            64,
            1,
            39,
            8,
            2,
            27,
            4,
            1,
            50,
            18,
            1,
            21,
            47,
            2,
            44,
            3,
            2,
            44,
            8,
            2,
            45,
            8,
            1,
            46,
            8,
            0,
            67,
            2,
            1,
            5,
            74,
            1,
            0,
            74,
            2,
            50,
            8,
            1,
            5,
            78,
            2,
            17,
            53,
            2,
            53,
            8,
            2,
            0,
            80,
            2,
            0,
            81,
            0,
            7,
            79,
            1,
            7,
            81,
            2,
            1,
            81,
            2,
            24,
            44,
            1,
            1,
            79,
            2,
            27,
            44
        );
        $llng = array(
            57,
            25,
            82,
            34,
            41,
            66,
            33,
            36,
            19,
            88,
            18,
            104,
            93,
            84,
            47,
            28,
            83,
            86,
            69,
            75,
            89,
            30,
            58,
            73,
            46,
            77,
            23,
            32,
            59,
            72,
            31,
            16,
            74,
            22,
            98,
            38,
            62,
            96,
            37,
            35,
            6,
            76,
            85,
            51,
            26,
            10,
            13,
            63,
            105,
            52,
            102,
            67,
            99,
            15,
            24,
            14,
            3,
            100,
            65,
            11,
            55,
            68,
            20,
            87,
            64,
            95,
            27,
            60,
            61,
            80,
            91,
            94,
            12,
            43,
            71,
            42,
            97,
            70,
            7,
            49,
            29,
            2,
            5,
            92,
            50,
            78,
            56,
            17,
            48,
            40,
            90,
            8,
            39,
            54,
            81,
            21,
            103,
            53,
            45,
            101,
            0,
            1,
            9,
            44,
            79,
            4
        );
        $llngx = array(
            81,
            7,
            97,
            0,
            39,
            40,
            9,
            44,
            45,
            103,
            101,
            79,
            1,
            4
        );
        $lobl = array(
            51,
            98,
            17,
            21,
            5,
            2,
            63,
            105,
            38,
            52,
            102,
            62,
            96,
            37,
            35,
            76,
            36,
            88,
            85,
            104,
            93,
            84,
            83,
            67,
            99,
            8,
            68,
            100,
            60,
            61,
            91,
            87,
            64,
            80,
            95,
            65,
            55,
            94,
            43,
            97,
            0,
            71,
            70,
            42,
            49,
            92,
            50,
            78,
            56,
            90,
            48,
            40,
            39,
            54,
            1,
            81,
            103,
            53,
            45,
            101,
            9,
            44,
            79,
            4
        );
        $loblx = array(
            53,
            1,
            103,
            9,
            44,
            101,
            79,
            4
        );

        $a = array();
        $c = array();
        $s = array();
        Novas::fund_args($t, $a);
        $i = 0;
        for ($ii = 0; $ii < 10; $ii += 2) {
            $angle = $a[(int)$nav[(int)$ii]] * doubleval($nav[(int)(1 + $ii)] + 1);
            $c[(int)$i] = cos($angle);
            $s[(int)$i] = sin($angle);
            $i += 1;
        }
        $i = 5;
        for ($ii = 0; $ii < 10; $ii += 2) {
            $i2 = $nav2[(int)$ii];
            $i3 = $nav2[(int)(1 + $ii)];
            $c[(int)$i] = $c[(int)$i2] * $c[(int)$i3] - $s[(int)$i2] * $s[(int)$i3];
            $s[(int)$i] = $s[(int)$i2] * $c[(int)$i3] + $c[(int)$i2] * $s[(int)$i3];
            $i += 1;
        }
        $i = 10;
        for ($ii = 0; $ii < 183; $ii += 3) {
            $iop = $nav3[(int)$ii];
            $i2 = $nav3[(int)(1 + $ii)];
            $i3 = $nav3[(int)(2 + $ii)];
            switch ($iop) {
                case 0:
                    $c[(int)$i] = $c[(int)$i2] * $c[(int)$i3] - $s[(int)$i2] * $s[(int)$i3];
                    $s[(int)$i] = $s[(int)$i2] * $c[(int)$i3] + $c[(int)$i2] * $s[(int)$i3];
                    $i += 1;
                    break;
                case 1:
                    $c[(int)$i] = $c[(int)$i2] * $c[(int)$i3] + $s[(int)$i2] * $s[(int)$i3];
                    $s[(int)$i] = $s[(int)$i2] * $c[(int)$i3] - $c[(int)$i2] * $s[(int)$i3];
                    $i += 1;
                    break;
                case 2: {
                    $cc = $c[(int)$i2] * $c[(int)$i3];
                    $ss = $s[(int)$i2] * $s[(int)$i3];
                    $sc = $s[(int)$i2] * $c[(int)$i3];
                    $cs = $c[(int)$i2] * $s[(int)$i3];
                    $c[(int)$i] = $cc - $ss;
                    $s[(int)$i] = $sc + $cs;
                    $i += 1;
                    $c[(int)$i] = $cc + $ss;
                    $s[(int)$i] = $sc - $cs;
                    $i += 1;
                    break;
                }
            }
            if ($iop == 3) {
                break;
            }
        }
        $lng = 0.0;
        for ($i = 0; $i < 106; $i += 1) {
            $lng += $clng[(int)$i] * $s[(int)$llng[(int)$i]];
        }
        $lngx = 0.0;
        for ($i = 0; $i < 14; $i += 1) {
            $lngx += $clngx[(int)$i] * $s[(int)$llngx[(int)$i]];
        }
        $obl = 0.0;
        for ($i = 0; $i < 64; $i += 1) {
            $obl += $cobl[(int)$i] * $c[(int)$lobl[(int)$i]];
        }
        $oblx = 0.0;
        for ($i = 0; $i < 8; $i += 1) {
            $oblx += $coblx[(int)$i] * $c[(int)$loblx[(int)$i]];
        }
        $longnutation = ($lng + $t * $lngx) / 10000.0;
        $obliqnutation = ($obl + $t * $oblx) / 10000.0;
        return 0;
    }

    private static function fund_args($t, &$a)
    {
        $a[0] = 2.3555483935439407 + $t * (8328.6914228838959 + $t * (0.00015179516355539569 + 3.1028075591010306E-07 * $t));
        $a[1] = 6.240035939326023 + $t * (628.30195602418416 + $t * (-2.7973749400020225E-06 - 5.8177641733144313E-08 * $t));
        $a[2] = 1.6279019339719611 + $t * (8433.4661583184534 + $t * (-6.4271749704691185E-05 + 5.332950492204896E-08 * $t));
        $a[3] = 5.1984695135799219 + $t * (7771.3771461706419 + $t * (-3.3408510765258121E-05 + 9.2114599410811842E-08 * $t));
        $a[4] = 2.1824386243609943 + $t * (-33.75704593375351 + $t * (3.6142859926715909E-05 + 3.8785094488762882E-08 * $t));
        for ($i = 0; $i < 5; $i += 1) {
            $a[(int)$i] = $a[(int)$i] % 6.2831853071795862;
            if ($a[(int)$i] < 0.0) {
                $a[(int)$i] += 6.2831853071795862;
            }
        }
    }

    public static function radec2vector($ra, $dec, $dist, $vector)
    {
        $vector[0] = $dist * cos(0.017453292519943295 * $dec) * cos(0.26179938779914941 * $ra);
        $vector[1] = $dist * cos(0.017453292519943295 * $dec) * sin(0.26179938779914941 * $ra);
        $vector[2] = $dist * sin(0.017453292519943295 * $dec);
    }

    public static function tdb2tdt($tdb, &$tdtjd, &$secdiff)
    {
        $ecc = 0.01671022;
        $rev = 1296000.0;
        $tdays = $tdb - 2451545.0;
        $i = (357.51716 + 0.985599987 * $tdays) * 3600.0;
        $j = (280.46435 + 0.9856091 * $tdays) * 3600.0;
        $lj = (34.40438 + 0.083086762 * $tdays) * 3600.0;
        $i = $i % $rev / 206264.80624709636;
        $j = $j % $rev / 206264.80624709636;
        $lj = $lj % $rev / 206264.80624709636;
        $e = $i + $ecc * sin($i) + 0.5 * $ecc * $ecc * sin(2.0 * $i);
        $secdiff = 0.001658 * sin($e) + 2.073E-05 * sin($j - $lj);
        $tdtjd = $tdb - $secdiff / 86400.0;
    }

    public static function julian_date($year, $month, $day, $hour)
    {
        $jd12h = gregoriantojd($month, $day, $year);
        return doubleval($jd12h) - 0.5 + $hour / 24.0;
    }

    private static function cal_date($tjd, &$year, &$month, &$day, &$hour)
    {
        $djd = $tjd + 0.5;
        $jd = $djd;
        $hour = $djd % 1.0 * 24.0;
        $dateTimeString = jdtogregorian($jd);
        $datetime = new DateTime($dateTimeString);
        $datetime->format('w');
        $month = $datetime->format('m');
        $day = $datetime->format('d');
        $year = $datetime->format('y');
    }
}