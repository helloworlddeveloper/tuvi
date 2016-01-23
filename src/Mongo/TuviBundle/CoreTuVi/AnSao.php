<?php
/**
 * Created by PhpStorm.
 * User: hoavt
 * Date: 1/22/2016
 * Time: 11:23 AM
 */

namespace Mongo\TuviBundle\CoreTuVi;

use Mongo\TuviBundle\CoreTuVi\Sao;

class AnSao
{
    const  LTHAN = 'L';

    const  THAN = 'H';

    const  CHTINH = 'C';

    const  BTINH = 'B';

    const  TSINH = 'S';

    const  DVAN = 'D';

    const  TVAN = 'V';

    const  KVONG = 'K';

    public static $HQuyenThienLuong = false;

    public static $KhoaKyDongAm = false;

    private static $TCPhiTinh = 1;

    private static $DCPhiTinh = 1;

    private static $_namPhiTinh = 0;

    public $BoSao;

    public $Ten;

    public $Ngay;

    public $Thang;

    public $TCNam;

    public $DCNam;

    public $Gio;

    public $Phai;

    public $CurPos;

    public $Menh;

    public $Cuc;

    public $DNAN;

    public static function getNamPhiTinh()
    {
        return AnSao::$_namPhiTinh;
    }

    public static function setNamPhiTinh($value)
    {
        AnSao::$_namPhiTinh = $value;
        AnSao::$TCPhiTinh = AnSao::XetSo(5 + AnSao::$_namPhiTinh - 2008, 10);
        AnSao::$DCPhiTinh = AnSao::XetSo(1 + AnSao::$_namPhiTinh - 2008, 12);
    }

    private static function XetSo($so, $heso = null)
    {
        if ($heso != null) {
            $ret = $so % $heso;
            if ($ret <= 0) {
                $ret += $heso;
            }
            return $ret;
        } else {
            $heso = 12;
            $ret = $so % $heso;
            if ($ret <= 0) {
                $ret += $heso;
            }

            return $ret;
        }
    }

    public function __construct($gio, $ngay, $thang, $tcnam, $dcnam, $phai)
    {
        $this->BoSao = new Sao[162];
        for ($i = 0; $i < count($this->BoSao); $i++) {
            $this->BoSao[$i] = new Sao();
        }
        $this->CurPos = 0;
        $this->Ngay = $ngay;
        $this->Thang = $thang;
        $this->TCNam = $tcnam;
        $this->DCNam = $dcnam;
        $this->Gio = $gio;
        $this->Phai = $phai;
        if (($phai && $this->TCNam % 2 > 0) || (!$phai && $this->TCNam % 2 == 0)) {
            $this->DNAN = true;
        } else {
            $this->DNAN = false;
        }
        $this->AnAll();
    }

    private function AnAll()
    {
        $this->LucThan();
        $this->DinhCuc();
        $this->TuVi();
        $this->ThaiTue();
        $this->LocTon();
        $this->TrangSinh();
        $this->LucSat();
        $this->XuongKhucKhoiViet();
        $this->TaHuuLongPhuong();
        $this->KhocHuThienNguyetDuc();
        $this->HinhRieuYAnPhu();
        $this->DaoHongHi();
        $this->ThienDiaGiaiPhuCao();
        $this->TaiThoThuongSuLaVong();
        $this->TuHoa();
        $this->CoQuaMaPha();
        $this->QuanPhucHaTru();
        $this->KiepSatHoaCai();
        $this->LNVanTinh();
        $this->DauQuanThienKhong();
        $this->TuanTriet();
        $this->DaiVan();
        $this->TieuVan();
        if (AnSao::getNamPhiTinh() > 1929) {
            $this->PhiTueTangHo(AnSao::$DCPhiTinh);
            $this->PhiKhocHu(AnSao::$DCPhiTinh);
            $this->PhiLocKinhDa(AnSao::$TCPhiTinh);
            $this->PhiThienMa(AnSao::$DCPhiTinh);
        }
    }

    private function LucThan()
    {
        $pos = AnSao::XetSo(2 + $this->Thang - $this->Gio + 1);
        $this->Menh = $pos;
        for ($i = 0; $i < 12; $i++) {
            $this->BoSao[$this->CurPos]->ID = $i + 1;
            $this->BoSao[$this->CurPos]->Pos = AnSao::XetSo($pos + $i);
            $this->BoSao[$this->CurPos]->Type = 'L';
            $this->CurPos++;
        }
        $pos = AnSao::XetSo(2 + $this->Thang + $this->Gio - 1);
        $this->BoSao[$this->CurPos]->ID = 1;
        $this->BoSao[$this->CurPos]->Pos = $pos;
        $this->BoSao[$this->CurPos]->Type = 'H';
        $this->CurPos++;
    }

    private function DinhCuc()
    {
        if ($this->TCNam == 1 || $this->TCNam == 6) {
            $GKY = array(
                2,
                2,
                6,
                6,
                3,
                3,
                5,
                5,
                4,
                4,
                6,
                6
            );
            $this->Cuc = $GKY[$this->Menh - 1];
            return;
        }
        if ($this->TCNam == 2 || $this->TCNam == 7) {
            $ACA = array(
                6,
                6,
                5,
                5,
                4,
                4,
                3,
                3,
                2,
                2,
                5,
                5
            );
            $this->Cuc = $ACA[$this->Menh - 1];
            return;
        }
        if ($this->TCNam == 3 || $this->TCNam == 8) {
            $BTA = array(

                5,
                5,
                3,
                3,
                2,
                2,
                4,
                4,
                6,
                6,
                3,
                3
            );
            $this->Cuc = $BTA[$this->Menh - 1];
            return;
        }
        if ($this->TCNam == 4 || $this->TCNam == 9) {
            $DNH = array(

                3,
                3,
                4,
                4,
                6,
                6,
                2,
                2,
                5,
                5,
                4,
                4
            );
            $this->Cuc = $DNH[$this->Menh - 1];
            return;
        }
        if ($this->TCNam == 5 || $this->TCNam == 10) {
            $MQU = array(

                4,
                4,
                2,
                2,
                5,
                5,
                6,
                6,
                3,
                3,
                2,
                2
            );
            $this->Cuc = $MQU[$this->Menh - 1];
        }
    }

    private function TuVi()
    {
        $CCuc = array();
        if ($this->Cuc == 2) {
            $CCuc = array(

                2,
                3,
                3,
                4,
                4,
                5,
                5,
                6,
                6,
                7,
                7,
                8,
                8,
                9,
                9,
                10,
                10,
                11,
                11,
                12,
                12,
                1,
                1,
                2,
                2,
                3,
                3,
                4,
                4,
                5
            );
        }
        if ($this->Cuc == 3) {
            $CCuc = array(
                5,
                2,
                3,
                6,
                3,
                4,
                7,
                4,
                5,
                8,
                5,
                6,
                9,
                6,
                7,
                10,
                7,
                8,
                11,
                8,
                9,
                12,
                9,
                10,
                1,
                10,
                11,
                2,
                11,
                12
            );
        }
        if ($this->Cuc == 4) {
            $CCuc = array(
                12,
                5,
                2,
                3,
                1,
                6,
                3,
                4,
                2,
                7,
                4,
                5,
                3,
                8,
                5,
                6,
                4,
                9,
                6,
                7,
                5,
                10,
                7,
                8,
                6,
                11,
                8,
                9,
                7,
                12
            );
        }
        if ($this->Cuc == 5) {
            $CCuc = array(
                7,
                12,
                5,
                2,
                3,
                8,
                1,
                6,
                3,
                4,
                9,
                2,
                7,
                4,
                5,
                10,
                3,
                8,
                5,
                6,
                11,
                4,
                9,
                6,
                7,
                12,
                5,
                10,
                7,
                8
            );
        }
        if ($this->Cuc == 6) {
            $CCuc = array(
                10,
                7,
                12,
                5,
                2,
                3,
                11,
                8,
                1,
                6,
                3,
                4,
                12,
                9,
                2,
                7,
                4,
                5,
                1,
                10,
                3,
                8,
                5,
                6,
                2,
                11,
                4,
                9,
                6,
                7
            );
        }
        $pos = $CCuc[$this->Ngay - 1];
        $tvpos = $pos;
        $this->BoSao[$this->CurPos] = new Sao(1, $pos, 'C');
        $this->CurPos++;
        $pos += 4;
        $pos = AnSao::XetSo(pos);
        $this->BoSao[$this->CurPos] = new Sao(2, $pos, 'C');
        $this->CurPos++;
        $pos += 3;
        $pos = AnSao::XetSo(pos);
        $this->BoSao[$this->CurPos] = new Sao(3, $pos, 'C');
        $this->CurPos++;
        $pos++;
        $pos = AnSao::XetSo($pos);
        $this->BoSao[$this->CurPos] = new Sao(4, $pos, 'C');
        $this->CurPos++;
        $pos++;
        $pos = AnSao::XetSo($pos);
        $this->BoSao[$this->CurPos] = new Sao(5, $pos, 'C');
        $this->CurPos++;
        $pos += 2;
        $pos = AnSao::XetSo($pos);
        $this->BoSao[$this->CurPos] = new Sao(6, $pos, 'C');
        $this->CurPos++;
        $pos = AnSao::XetSo(3 - ($tvpos - 3));
        $this->BoSao[$this->CurPos] = new Sao(7, $pos, 'C');
        $this->CurPos++;
        $pos++;
        $pos = AnSao::XetSo($pos);
        $this->BoSao[$this->CurPos] = new Sao(8, $pos, 'C');
        $this->CurPos++;
        $pos++;
        $pos = AnSao::XetSo($pos);
        $this->BoSao[$this->CurPos] = new Sao(9, $pos, 'C');
        $this->CurPos++;
        $pos++;
        $pos = AnSao::XetSo($pos);
        $this->BoSao[$this->CurPos] = new Sao(10, $pos, 'C');
        $this->CurPos++;
        $pos++;
        $pos = AnSao::XetSo($pos);
        $this->BoSao[$this->CurPos] = new Sao(11, $pos, 'C');
        $this->CurPos++;
        $pos++;
        $pos = AnSao::XetSo($pos);
        $this->BoSao[$this->CurPos] = new Sao(12, $pos, 'C');
        $this->CurPos++;
        $pos++;
        $pos = AnSao::XetSo($pos);
        $this::BoSao[$this->CurPos] = new Sao(13, $pos, 'C');
        $this->CurPos++;
        $pos += 4;
        $pos = AnSao::XetSo($pos);
        $this->BoSao[$this->CurPos] = new Sao(14, $pos, 'C');
        $this->CurPos++;
    }

    private function ThaiTue()
    {
        $pos = $this->DCNam;
        for ($i = 0; $i < 12; $i++) {
            $this->BoSao[$this->CurPos] = new Sao(15 + $i, $pos, 'B');
            $pos++;
            $pos = AnSao::XetSo($pos);
            $this->CurPos++;
        }
    }

    private function LocTon()
    {
        $lt = array(
            3,
            4,
            6,
            7,
            6,
            7,
            9,
            10,
            12,
            1
        );
        $pos = $lt[$this->TCNam - 1];
        $posbs = $pos;
        for ($i = 0; $i < 12; $i++) {
            $this->BoSao[$this->CurPos] = new Sao(27 + $i, $pos, 'B');
            if ($this->DNAN) {
                $pos++;
            } else {
                $pos--;
            }
            $pos = AnSao::XetSo($pos);
            $this->CurPos++;
        }
        $this->BoSao[$this->CurPos] = new Sao(109, $posbs, 'B');
        $this->CurPos++;
    }

    private function TrangSinh()
    {
        $pos = 0;
        switch ($this->Cuc) {
            case 3:
                $pos = 12;
                goto IL_31;
            case 4:
                $pos = 6;
                goto IL_31;
            case 6:
                $pos = 3;
                goto IL_31;
        }
        $pos = 9;
        IL_31:
        for ($i = 0; $i < 12; $i++) {
            $this->BoSao[$this->CurPos] = new Sao(39 + $i, $pos, 'S');
            if ($this->DNAN) {
                $pos++;
            } else {
                $pos--;
            }
            $pos = AnSao::XetSo($pos);
            $this->CurPos++;
        }
    }

    private function LucSat()
    {
        $pos = $this->BoSao[$this->FindID(27)]->Pos;
        $pos = AnSao::XetSo($pos - 1);
        $this->BoSao[$this->CurPos] = new Sao(51, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo($pos + 2);
        $this->BoSao[$this->CurPos] = new Sao(52, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo(12 + $this->Gio - 1);
        $this->BoSao[$this->CurPos] = new Sao(54, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo(12 - $this->Gio + 1);
        $this->BoSao[$this->CurPos] = new Sao(53, $pos, 'B');
        $this->CurPos++;
        $posh = 0;
        $posl = 0;
        switch ($this->DCNam) {
            case 1:
            case 5:
            case 9:
                $posh = 3;
                $posl = 11;
                goto IL_134;
            case 2:
            case 6:
            case 10:
                $posh = 4;
                $posl = 11;
                goto IL_134;
            case 3:
            case 7:
            case 11:
                $posh = 2;
                $posl = 4;
                goto IL_134;
        }
        $posh = 10;
        $posl = 11;
        IL_134:
        if ($this->DNAN) {
            $pos = AnSao::XetSo($posh + $this->Gio - 1);
            $this->BoSao[$this->CurPos] = new Sao(56, $pos, 'B');
            $this->CurPos++;
            $pos = AnSao::XetSo($posl - $this->Gio + 1);
            $this->BoSao[$this->CurPos] = new Sao(55, $pos, 'B');
            $this->CurPos++;
            return;
        }
        $pos = AnSao::XetSo($posh - $this->Gio + 1);
        $this->BoSao[$this->CurPos] = new Sao(56, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo($posl + $this->Gio - 1);
        $this->BoSao[$this->CurPos] = new Sao(55, $pos, 'B');
        $this->CurPos++;
    }

    private function XuongKhucKhoiViet()
    {
        $pos = AnSao::XetSo(11 - $this->Gio + 1);
        $this->BoSao[$this->CurPos] = new Sao(57, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo($pos + $this->Ngay - 1 - 1);
        $this->BoSao[$this->CurPos] = new Sao(67, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo(5 + $this->Gio - 1);
        $this->BoSao[$this->CurPos] = new Sao(58, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo($pos - $this->Ngay + 1 + 1);
        $this->BoSao[$this->CurPos] = new Sao(68, $pos, 'B');
        $this->CurPos++;
        $posk = 0;
        $posv = 0;
        switch ($this->TCNam) {
            case 1:
            case 5:
                $posk = 2;
                $posv = 8;
                break;
            case 2:
            case 6:
                $posk = 1;
                $posv = 9;
                break;
            case 3:
            case 4:
                $posk = 12;
                $posv = 10;
                break;
            case 7:
            case 8:
                $posk = 7;
                $posv = 3;
                break;
            case 9:
            case 10:
                $posk = 4;
                $posv = 6;
                break;
        }
        $this->BoSao[$this->CurPos] = new Sao(59, $posk, 'B');
        $this->CurPos++;
        $this->BoSao[$this->CurPos] = new Sao(60, $posv, 'B');
        $this->CurPos++;
    }

    private function TaHuuLongPhuong()
    {
        $pos = AnSao::XetSo(5 + $this->Thang - 1);
        $this->BoSao[$this->CurPos] = new Sao(61, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo($pos + $this->Ngay - 1);
        $this->BoSao[$this->CurPos] = new Sao(65, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo(11 - $this->Thang + 1);
        $this->BoSao[$this->CurPos] = new Sao(62, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo($pos - $this->Ngay + 1);
        $this->BoSao[$this->CurPos] = new Sao(66, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo(5 + $this->DCNam - 1);
        $this->BoSao[$this->CurPos] = new Sao(63, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo(11 - $this->DCNam + 1);
        $this->BoSao[$this->CurPos] = new Sao(64, $pos, 'B');
        $this->CurPos++;
    }

    private function KhocHuThienNguyetDuc()
    {
        $pos = AnSao::XetSo(7 - $this->DCNam + 1);
        $this->BoSao[$this->CurPos] = new Sao(69, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo(7 + $this->DCNam - 1);
        $this->BoSao[$this->CurPos] = new Sao(70, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo(10 + $this->DCNam - 1);
        $this->BoSao[$this->CurPos] = new Sao(71, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo(6 + $this->DCNam - 1);
        $this->BoSao[$this->CurPos] = new Sao(72, $pos, 'B');
        $this->CurPos++;
    }

    private function HinhRieuYAnPhu()
    {
        $pos = AnSao::XetSo(10 + $this->Thang - 1);
        $this->BoSao[$this->CurPos] = new Sao(73, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo(2 + $this->Thang - 1);
        $this->BoSao[$this->CurPos] = new Sao(74, $pos, 'B');
        $this->CurPos++;
        $this->BoSao[$this->CurPos] = new Sao(75, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo($this->BoSao[$this->FindID(27)]->Pos + 8);
        $this->BoSao[$this->CurPos] = new Sao(76, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo($this->BoSao[$this->FindID(27)]->Pos - 7);
        $this->BoSao[$this->CurPos] = new Sao(77, $pos, 'B');
        $this->CurPos++;
    }

    private function DaoHongHi()
    {
        $lf = $this->DCNam % 4;
        $pos = 0;
        if ($lf == 2) {
            $pos = 7;
        }
        if ($lf == 0) {
            $pos = 1;
        }
        if ($lf == 1) {
            $pos = 10;
        }
        if ($lf == 3) {
            $pos = 4;
        }
        $this->BoSao[$this->CurPos] = new Sao(78, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo(4 - $this->DCNam + 1);
        $this->BoSao[$this->CurPos] = new Sao(79, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo($pos + 6);
        $this->BoSao[$this->CurPos] = new Sao(80, $pos, 'B');
        $this->CurPos++;
    }

    private function ThienDiaGiaiPhuCao()
    {
        $pos = AnSao::XetSo(9 + $this->Thang - 1);
        $this->BoSao[$this->CurPos] = new Sao(81, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo(8 + $this->Thang - 1);
        $this->BoSao[$this->CurPos] = new Sao(82, $pos, 'B');
        $this->CurPos++;
        $pos = $this->BoSao[$this->FindID(64)]->Pos;
        $this->BoSao[$this->CurPos] = new Sao(83, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo($this->BoSao[$this . FindID(58)]->Pos + 2);
        $this->BoSao[$this->CurPos] = new Sao(84, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo($this->BoSao[$this . FindID(58)]->Pos - 2);
        $this->BoSao[$this->CurPos] = new Sao(85, $pos, 'B');
        $this->CurPos++;
    }

    private function TaiThoThuongSuLaVong()
    {
        $pos = AnSao::XetSo($this->BoSao[0]->Pos + $this->DCNam - 1);
        $this->BoSao[$this->CurPos] = new Sao(86, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo($this->BoSao[12]->Pos + $this->DCNam - 1);
        $this->BoSao[$this->CurPos] = new Sao(87, $pos, 'B');
        $this->CurPos++;
        $pos = $this->BoSao[5]->Pos;
        $this->BoSao[$this->CurPos] = new Sao(88, $pos, 'B');
        $this->CurPos++;
        $pos = $this->BoSao[7]->Pos;
        $this->BoSao[$this->CurPos] = new Sao(89, $pos, 'B');
        $this->CurPos++;
        $this->BoSao[$this->CurPos] = new Sao(90, 5, 'B');
        $this->CurPos++;
        $this->BoSao[$this->CurPos] = new Sao(91, 11, 'B');
        $this->CurPos++;
    }

    private function TuHoa()
    {
        $loc = array(
            2,
            6,
            3,
            8,
            9,
            4,
            5,
            10,
            12,
            14
        );
        $quyen = array(
            14,
            12,
            6,
            3,
            8,
            9,
            4,
            5,
            1,
            10
        );
        $khoa = array(
            4,
            1,
            57,
            6,
            62,
            12,
            8,
            58,
            61,
            8
        );
        $ky = array(

            5,
            8,
            2,
            10,
            6,
            58,
            3,
            57,
            4,
            9
        );
        if (AnSao::$HQuyenThienLuong) {
            $quyen[7] = 12;
        }
        if (AnSao::$KhoaKyDongAm) {
            $khoa[6] = 3;
            $ky[6] = 8;
        }
        $pos = $this->BoSao[$this->FindID($khoa[$this->TCNam - 1])]->Pos;
        $this->BoSao[$this->CurPos] = new Sao(92, $pos, 'B');
        $this->CurPos++;
        $pos = $this->BoSao[$this->FindID($quyen[$this->TCNam - 1])]->Pos;
        $this->BoSao[$this->CurPos] = new Sao(93, $pos, 'B');
        $this->CurPos++;
        $pos = $this->BoSao[$this->FindID($loc[$this->TCNam - 1])]->Pos;
        $this->BoSao[$this->CurPos] = new Sao(94, $pos, 'B');
        $this->CurPos++;
        $pos = $this->BoSao[$this->FindID($ky[$this->TCNam - 1])]->Pos;
        $this->BoSao[$this->CurPos] = new Sao(95, $pos, 'B');
        $this->CurPos++;
    }

    private function CoQuaMaPha()
    {
        $posc = 0;
        $posq = 0;
        switch ($this->DCNam) {
            case 1:
            case 2:
            case 12:
                $posc = 3;
                $posq = 11;
                goto IL_5A;
            case 3:
            case 4:
            case 5:
                $posc = 6;
                $posq = 2;
                goto IL_5A;
            case 6:
            case 7:
            case 8:
                $posc = 9;
                $posq = 5;
                goto IL_5A;
        }
        $posc = 12;
        $posq = 8;
        IL_5A:
        $this->BoSao[$this->CurPos] = new Sao(96, $posc, 'B');
        $this->CurPos++;
        $this->BoSao[$this->CurPos] = new Sao(97, $posq, 'B');
        $this->CurPos++;
        $pos = 0;
        if ($this->DCNam % 4 == 2) {
            $pos = 12;
        }
        if ($this->DCNam % 4 == 0) {
            $pos = 6;
        }
        if ($this->DCNam % 4 == 1) {
            $pos = 3;
        }
        if ($this->DCNam % 4 == 3) {
            $pos = 9;
        }
        $this->BoSao[$this->CurPos] = new Sao(98, $pos, 'B');
        $this->CurPos++;
        if ($this->DCNam % 3 == 1) {
            $pos = 6;
        }
        if ($this->DCNam % 3 == 0) {
            $pos = 10;
        }
        if ($this->DCNam % 3 == 2) {
            $pos = 2;
        }
        $this->BoSao[$this->CurPos] = new Sao(99, $pos, 'B');
        $this->CurPos++;
    }

    private function QuanPhucHaTru()
    {
        $quan = array(
            8,
            5,
            6,
            3,
            4,
            10,
            12,
            10,
            11,
            7
        );
        $phuc = array(
            10,
            9,
            1,
            12,
            4,
            3,
            7,
            6,
            7,
            6
        );
        $ha = array(
            10,
            11,
            8,
            5,
            6,
            7,
            9,
            4,
            12,
            3
        );
        $tru = array(
            6,
            7,
            1,
            6,
            7,
            9,
            3,
            7,
            10,
            11
        );
        $this->BoSao[$this->CurPos] = new Sao(100, $quan[$this->TCNam - 1], 'B');
        $this->CurPos++;
        $this->BoSao[$this->CurPos] = new Sao(101, $phuc[$this->TCNam - 1], 'B');
        $this->CurPos++;
        $this->BoSao[$this->CurPos] = new Sao(102, $ha[$this->TCNam - 1], 'B');
        $this->CurPos++;
        $this->BoSao[$this->CurPos] = new Sao(103, $tru[$this->TCNam - 1], 'B');
        $this->CurPos++;
    }

    private function KiepSatHoaCai()
    {
        $posk = 0;
        $posh = 0;
        if ($this->DCNam % 4 == 2) {
            $posk = 3;
            $posh = 2;
        }
        if ($this->DCNam % 4 == 0) {
            $posk = 9;
            $posh = 8;
        }
        if ($this->DCNam % 4 == 3) {
            $posk = 12;
            $posh = 11;
        }
        if ($this->DCNam % 4 == 1) {
            $posk = 6;
            $posh = 5;
        }
        $this->BoSao[$this->CurPos] = new Sao(104, $posk, 'B');
        $this->CurPos++;
        $this->BoSao[$this->CurPos] = new Sao(105, $posh, 'B');
        $this->CurPos++;
    }

    private function LNVanTinh()
    {
        $pos = array(
            6,
            7,
            9,
            10,
            9,
            10,
            12,
            1,
            10,
            4
        );
        $this->BoSao[$this->CurPos] = new Sao(106, $pos[$this->TCNam - 1], 'B');
        $this->CurPos++;
    }

    private function DauQuanThienKhong()
    {
        $pos = $this->BoSao[$this->FindID(15)]->Pos;
        $postt = $pos;
        $pos = AnSao::XetSo($pos - $this->Thang + 1 + $this->Gio - 1);
        $this->BoSao[$this->CurPos] = new Sao(107, $pos, 'B');
        $this->CurPos++;
        $pos = AnSao::XetSo($postt + 1);
        $this->BoSao[$this->CurPos] = new Sao(108, $pos, 'B');
        $this->CurPos++;
    }

    private function TuanTriet()
    {
        $dc = $this->DCNam;
        $tc = $this->TCNam;
        for ($i = 0; $i < 14; $i++) {
            $dc++;
            $dc = AnSao::XetSo(dc);
            $tc++;
            $tc = AnSao::XetSo($tc, 10);
            if ($tc == 1) {
                break;
            }
        }
        $this->BoSao[$this->CurPos] = new Sao(110, $dc, 'K');
        $this->CurPos++;
        $this->BoSao[$this->CurPos] = new Sao(110, AnSao::XetSo($dc + 1), 'K');
        $this->CurPos++;
        switch ($this->TCNam) {
            case 1:
            case 6:
                $dc = 9;
                break;
            case 2:
            case 7:
                $dc = 7;
                break;
            case 3:
            case 8:
                $dc = 5;
                break;
            case 4:
            case 9:
                $dc = 3;
                break;
            case 5:
            case 10:
                $dc = 1;
                break;
        }
        $this->BoSao[$this->CurPos] = new Sao(111, $dc, 'K');
        $this->CurPos++;
        $this->BoSao[$this->CurPos] = new Sao(111, AnSao::XetSo($dc + 1), 'K');
        $this->CurPos++;
    }

    private function DaiVan()
    {
        $ivan = array();
        for ($i = 0; $i < 10; $i++) {
            $ivan[$i] = $this->Cuc + 10 * $i;
        }
        $pos = $this->BoSao[0]->Pos;
        for ($i = 0; $i < 10; $i++) {
            if ($this->DNAN) {
                $this->BoSao[$this->CurPos] = new Sao($ivan[$i], AnSao::XetSo($pos + $i), 'D');
            } else {
                $this->BoSao[$this->CurPos] = new Sao($ivan[$i], AnSao::XetSo($pos - $i), 'D');
            }
            $this->CurPos++;
        }
    }

    private function TieuVan()
    {
        $pos = 0;
        if ($this->DCNam % 4 == 3) {
            $pos = 5;
        }
        if ($this->DCNam % 4 == 1) {
            $pos = 11;
        }
        if ($this->DCNam % 4 == 2) {
            $pos = 8;
        }
        if ($this->DCNam % 4 == 0) {
            $pos = 2;
        }
        for ($i = 0; $i < 12; $i++) {
            if ($this->Phai) {
                $this->BoSao[$this->CurPos] = new Sao(AnSao::XetSo($this->DCNam + $i), AnSao::XetSo($pos + $i), 'V');
            } else {
                $this->BoSao[$this->CurPos] = new Sao(AnSao::XetSo($this->DCNam + $i), AnSao::XetSo($pos - $i), 'V');
            }
            $this->CurPos++;
        }
    }

    private function PhiTueTangHo($dc)
    {
        $this->BoSao[$this->CurPos] = new Sao(15, $dc, 'B');
        $this->BoSao[$this->CurPos]->IsPhiTinh = true;
        $this->CurPos++;
        $this->BoSao[$this->CurPos] = new Sao(17, AnSao::XetSo($dc + 2), 'B');
        $this->BoSao[$this->CurPos]->IsPhiTinh = true;
        $this->CurPos++;
        $this->BoSao[$this->CurPos] = new Sao(23, AnSao::XetSo($dc + 8), 'B');
        $this->BoSao[$this->CurPos]->IsPhiTinh = true;
        $this->CurPos++;
    }

    private function PhiKhocHu($dc)
    {
        $pos = AnSao::XetSo(7 - $dc + 1);
        $this->BoSao[$this->CurPos] = new Sao(69, $pos, 'B');
        $this->BoSao[$this->CurPos]->IsPhiTinh = true;
        $this->CurPos++;
        $pos = AnSao::XetSo(7 + $dc - 1);
        $this->BoSao[$this->CurPos] = new Sao(70, $pos, 'B');
        $this->BoSao[$this->CurPos]->IsPhiTinh = true;
        $this->CurPos++;
    }

    private function PhiLocKinhDa($tc)
    {
        $lt = array(
            3,
            4,
            6,
            7,
            6,
            7,
            9,
            10,
            12,
            1
        );
        $pos = $lt[$tc - 1];
        $this->BoSao[$this->CurPos] = new Sao(27, $pos, 'B');
        $this->BoSao[$this->CurPos]->IsPhiTinh = true;
        $this->CurPos++;
        $pos = AnSao::XetSo($pos + 1);
        $this->BoSao[$this->CurPos] = new Sao(52, $pos, 'B');
        $this->BoSao[$this->CurPos]->IsPhiTinh = true;
        $this->CurPos++;
        $pos = AnSao::XetSo($pos - 2);
        $this->BoSao[$this->CurPos] = new Sao(51, $pos, 'B');
        $this->BoSao[$this->CurPos]->IsPhiTinh = true;
        $this->CurPos++;
    }

    private function PhiThienMa($dc)
    {
        $pos = 0;
        if ($dc % 4 == 2) {
            $pos = 12;
        }
        if ($dc % 4 == 0) {
            $pos = 6;
        }
        if ($dc % 4 == 1) {
            $pos = 3;
        }
        if ($dc % 4 == 3) {
            $pos = 9;
        }
        $this->BoSao[$this->CurPos] = new Sao(98, $pos, 'B');
        $this->BoSao[$this->CurPos]->IsPhiTinh = true;
        $this->CurPos++;
    }

    private function FindID($id)
    {
        for ($i = 0; $i < 141; $i++) {
            if ($this->BoSao[$i]->ID == $id & $this->BoSao[$i]->IsRealSao) {
                return $i;
            }
        }
        return -1;
    }

    public function PhanCung()
    {
        $BoCung = new Sao[12];
        for ($i = 0; $i < count($BoCung); $i++) {
            $BoCung[$i] = array();
        }
        $boSao = $this->BoSao;
        for ($j = 0; $j < count($boSao); $j++) {
            $sao = $boSao[$j];
            if ($sao->Pos > 0) {
                $BoCung[$sao->Pos - 1] = $sao;
            }
        }
        return $BoCung;
    }


}