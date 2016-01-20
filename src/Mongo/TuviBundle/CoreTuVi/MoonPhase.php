<?php
/**
 * Created by PhpStorm.
 * User: hoavt
 * Date: 1/20/2016
 * Time: 5:10 PM
 */

namespace Mongo\TuviBundle\CoreTuVi;


use Symfony\Component\Validator\Constraints\DateTime;

class MoonPhase
{
    const  START_LUNATION = -300;

    const  END_LUNATION = 4008;

    const  LUNATION_OFFSET = 953;

    public static function NewMoon($TheDay, &$newmoon)
    {
        $tnewmoon = new DateTime();
        for ($lun = -300; $lun <= 4008; $lun++) {
            $tnewmoon = MoonPhase::NewMoonLun($lun);
            if ($tnewmoon > $TheDay) {
                $newmoon = $tnewmoon;
                return $lun;
            }
        }
        $newmoon = $tnewmoon;
        return -301;
    }

    public static function NewMoonLun($lun)
    {
        $newmoon = new DateTime(1900, 1, 1, 0, 0, 0);
        $JDE = MoonPhase::moonphasebylunation($lun - 953, 0);
        $event_date = MoonPhase::JDtoDate($JDE);
        return $event_date;
    }

    public static function JDtoDate($jd)
    {
        return $dateTimeString = jdtogregorian($jd);
    }
    public static function torad($x)
    {
        $x %= 360.0;
        return $x * 0.017453292519943295;
    }

    public static function moonphasebylunation($lun, $phi)
    {
        $i = doubleval($lun) + doubleval($phi) / 4.0;
        return MoonPhase::moonphase($i, $phi);
    }

    public static function moonphase($k, $phi)
    {
        $A = array();
        $T = $k / 1236.85;
        $JDE = 2451550.09765 + 29.530588853 * $k + $T * $T * (0.0001337 + $T * (-1.5E-07 + 7.3E-10 * $T));
        $E = 1.0 + $T * (-0.002516 + -7.4E-06 * $T);
        $M = 2.5534 + 29.10535669 * $k + $T * $T * (-2.18E-05 + -1.1E-07 * $T);
        $M2 = 201.5643 + 385.81693528 * $k + $T * $T * (0.0107438 + $T * (1.239E-05 + -5.8E-08 * $T));
        $F = 160.7108 + 390.67050274 * $k + $T * $T * (-0.0016341 * $T * (-2.27E-06 + 1.1E-08 * $T));
        $O = 124.7746 - 1.5637558 * $k + $T * $T * (0.0020691 + 2.15E-06 * $T);
        $A[0] = 0.0;
        $A[1] = 299.77 + 0.107408 * $k - 0.009173 * $T * $T;
        $A[2] = 251.88 + 0.016321 * $k;
        $A[3] = 251.83 + 26.651886 * $k;
        $A[4] = 349.42 + 36.412478 * $k;
        $A[5] = 84.66 + 18.206239 * $k;
        $A[6] = 141.74 + 53.303771 * $k;
        $A[7] = 207.14 + 2.453732 * $k;
        $A[8] = 154.84 + 7.30686 * $k;
        $A[9] = 34.52 + 27.261239 * $k;
        $A[10] = 207.19 + 0.121824 * $k;
        $A[11] = 291.34 + 1.844379 * $k;
        $A[12] = 161.72 + 24.198154 * $k;
        $A[13] = 239.56 + 25.513099 * $k;
        $A[14] = 331.55 + 3.592518 * $k;
        $M = MoonPhase::torad($M);
        $M2 = MoonPhase::torad($M2);
        $F = MoonPhase::torad($F);
        $O = MoonPhase::torad($O);
        for ($i = 1; $i <= 14; $i++) {
            $A[$i] = MoonPhase::torad($A[$i]);
        }
        switch ($phi) {
            case 0:
                $JDE = $JDE - 0.4072 * sin($M2) + 0.17241 * $E * sin($M) + 0.01608 * sin(2.0 * $M2) + 0.01039 * sin(2.0 * $F) + 0.00739 * $E * sin($M2 - $M) - 0.00514 * $E * sin($M2 + $M) + 0.00208 * $E * $E * sin(2.0 * $M) - 0.00111 * sin($M2 - 2.0 * $F) - 0.00057 * sin($M2 + 2.0 * $F) + 0.00056 * $E * sin(2.0 * $M2 + $M) - 0.00042 * sin(3.0 * $M2) + 0.00042 * $E * sin($M + 2.0 * $F) + 0.00038 * $E * sin($M - 2.0 * $F) - 0.00024 * $E * sin(2.0 * $M2 - $M) - 0.00017 * sin($O) - 7E-05 * sin($M2 + 2.0 * $M) + 4E-05 * sin(2.0 * $M2 - 2.0 * $F) + 4E-05 * sin(3.0 * $M) + 3E-05 * sin($M2 + $M - 2.0 * $F) + 3E-05 * sin(2.0 * $M2 + 2.0 * $F) - 3E-05 * sin($M2 + $M + 2.0 * $F) + 3E-05 * sin($M2 - $M + 2.0 * $F) - 2E-05 * sin($M2 - $M - 2.0 * $F) - 2E-05 * sin(3.0 * $M2 + $M) + 2E-05 * sin(4.0 * $M2);
                break;
            case 1:
            case 3: {
                $JDE = $JDE - 0.62801 * sin($M2) + 0.17172 * $E * sin($M) - 0.01183 * $E * sin($M2 + $M) + 0.00862 * sin(2.0 * $M2) + 0.00804 * sin(2.0 * $F) + 0.00454 * $E * sin($M2 - $M) + 0.00204 * $E * $E * sin(2.0 * $M) - 0.0018 * sin($M2 - 2.0 * $F) - 0.0007 * sin($M2 + 2.0 * $F) - 0.0004 * sin(3.0 * $M2) - 0.00034 * $E * sin(2.0 * $M2 - $M) + 0.00032 * $E * sin($M + 2.0 * $F) + 0.00032 * $E * sin($M - 2.0 * $F) - 0.00028 * $E * $E * sin($M2 + 2.0 * $M) + 0.00027 * $E * sin(2.0 * $M2 + $M) - 0.00017 * sin($O) - 5E-05 * sin($M2 - $M - 2.0 * $F) + 4E-05 * sin(2.0 * $M2 + 2.0 * $F) - 4E-05 * sin($M2 + $M + 2.0 * $F) + 4E-05 * sin($M2 - 2.0 * $M) + 3E-05 * sin($M2 + $M - 2.0 * $F) + 3E-05 * sin(3.0 * $M) + 2E-05 * sin(2.0 * $M2 - 2.0 * $F) + 2E-05 * sin($M2 - $M + 2.0 * $F) - 2E-05 * sin(3.0 * $M2 + $M);
                $W = 0.00306 - 0.00038 * $E * cos($M) + 0.00026 * cos($M2) - 2E-05 * cos($M2 - $M) + 2E-05 * cos($M2 + $M) + 2E-05 * cos(2.0 * $F);
                if ($phi == 3) {
                    $W = -$W;
                }
                $JDE += $W;
                break;
            }
            case 2:
                $JDE = $JDE - 0.40614 * sin($M2) + 0.17302 * $E * sin($M) + 0.01614 * sin(2.0 * $M2) + 0.01043 * sin(2.0 * $F) + 0.00734 * $E * sin($M2 - $M) - 0.00515 * $E * sin($M2 + $M) + 0.00209 * $E * $E * sin(2.0 * $M) - 0.00111 * sin($M2 - 2.0 * $F) - 0.00057 * sin($M2 + 2.0 * $F) + 0.00056 * $E * sin(2.0 * $M2 + $M) - 0.00042 * sin(3.0 * $M2) + 0.00042 * $E * sin($M + 2.0 * $F) + 0.00038 * $E * sin($M - 2.0 * $F) - 0.00024 * $E * sin(2.0 * $M2 - $M) - 0.00017 * sin($O) - 7E-05 * sin($M2 + 2.0 * $M) + 4E-05 * sin(2.0 * $M2 - 2.0 * $F) + 4E-05 * sin(3.0 * $M) + 3E-05 * sin($M2 + $M - 2.0 * $F) + 3E-05 * sin(2.0 * $M2 + 2.0 * $F) - 3E-05 * sin($M2 + $M + 2.0 * $F) + 3E-05 * sin($M2 - $M + 2.0 * $F) - 2E-05 * sin($M2 - $M - 2.0 * $F) - 2E-05 * sin(3.0 * $M2 + $M) + 2E-05 * sin(4.0 * $M2);
                break;
            default:
                return 0.0;
        }
        return $JDE + 0.000325 * sin($A[1]) +0.000165 * sin($A[2]) +0.000164 * sin($A[3]) +0.000126 * sin($A[4]) +0.00011 * sin($A[5]) +6.2E-05 * sin($A[6]) +6E-05 * sin($A[7]) +5.6E-05 * sin($A[8]) +4.7E-05 * sin($A[9]) +4.2E-05 * sin($A[10]) +4E-05 * sin($A[11]) +3.7E-05 * sin($A[12]) +3.5E-05 * sin($A[13]) +2.3E-05 * sin($A[14]);
    }

}