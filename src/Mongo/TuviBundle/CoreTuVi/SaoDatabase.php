<?php
/**
 * Created by PhpStorm.
 * User: hoa
 * Date: 16/01/2016
 * Time: 15:33
 */

namespace Mongo\TuviBundle\CoreTuVi;
use Mongo\TuviBundle\CoreTuVi\SaoData as SaoData;

class SaoDatabase
{
     const KIM = 1;//Kim
     const THUY = 2;// Th?y
     const MOC = 3; // M?c
     const HOA = 4; // H?a
     const THO = 5; // Th?
     const BAC = 1; // B?c
     const NAM = 0; // Nam

     private $CSData = array();
     private $NapAm = array();
     private $DChi = array();
     private $TCan = array();
     private $LThan = array();

    public function __construct(){
        $this->LThan = array(
            "M?nh",
            "Ph? m?u",
            "Ph�c ??c",
            "?i?n tr?ch",
            "Quan l?c",
            "N� b?c",
            "Di",
            "T?t �ch",
            "T�i b?ch",
            "T? t?c",
            "Phu th�",
            "Huynh ??"
        );
        $this->TCan = array(
            "Gi�p",
            "?t",
            "B�nh",
            "?inh",
            "M?u",
            "K?",
            "Canh",
            "T�n",
            "Nh�m",
            "Qu�"
        );
        $this->DChi = array(
            "T�",
            "S?u",
            "D?n",
            "M�o",
            "Th�n",
            "T?",
            "Ng?",
            "M�i",
            "Th�n",
            "D?u",
            "Tu?t",
            "H?i"
        );
        $this->NapAm = array(
            "H?I TRUNG KIM",
            "GI�NG H? TH?Y",
            "T�CH L?CH H?A",
            "B�CH TH??NG TH?",
            "TANG �? M?C",
            "�?I KH� TH?Y",
            "L? TRUNG H?A",
            "TH�NH �?U TH?",
            "T�NG B� M?C",
            "KIM B?CH KIM",
            "PH� �?NG H?A",
            "SA TRUNG TH?",
            "�?I L�M M?C",
            "B?CH L?P KIM",
            "TR??NG L?U TH?Y",
            "SA TRUNG KIM",
            "THI�N H� TH?Y",
            "THI�N TH??NG H?A",
            "L? B�N TH?",
            "D??NG LI?U M?C",
            "TRUY?N TRUNG TH?Y",
            "S?N H? H?A",
            "�?I TR?CH TH?",
            "TH?CH L?U M?C",
            "KI?M PHONG KIM",
            "S?N �?U H?A",
            "?C TH??NG TH?",
            "B�NH �?A M?C",
            "XOA XUY?N KIM",
            "�?I H?I TH?Y"
        );
        $this->CSData = array(
            new SaoData(1, "T? vi", 5, "28", "-", "6739", "5b", "c14a", true),
            new SaoData(2, "Li�m trinh", 4, "28", "6c4a", "5b", "1739", "", true),
            new SaoData(3, "Thi�n ??ng", 2, "46c", "5a287b", "39", "1", "", false),
            new SaoData(4, "V? kh�c", 1, "4a", "6c", "5b28", "3917", "", true),
            new SaoData(5, "Th�i d??ng", 4, "28", "9abc1", "67", "345", "", false),
            new SaoData(6, "Thi�n c?", 3, "1728", "3c", "5b4a", "69", "", false),
            new SaoData(7, "Thi�n ph?", 5, "6c8", "-", "3917", "5b", "4a2", false),
            new SaoData(8, "Th�i �m", 2, "28", "34567", "abc", "91", "", true),
            new SaoData(9, "Tham lang", 2, "39", "6c174a", "28", "5b", "", true),
            new SaoData(10, "C? m�n", 2, "9c", "5b286", "4a", "173", "", true),
            new SaoData(11, "Thi�n t??ng", 2, "286c", "4a", "39", "5b17", "", false),
            new SaoData(12, "Thi�n l??ng", 3, "28", "a6c", "75b", "1439", "", false),
            new SaoData(13, "Th?t s�t", 1, "28", "4a5b", "3917", "6c", "", false),
            new SaoData(14, "Ph� qu�n", 2, "5b", "4a396c", "17", "28", "", true),
            new SaoData(15, false, "Th�i tu?", 4),
            new SaoData(16, true, "Thi?u d??ng", 4, "34567", "1289abc"),
            new SaoData(17, false, "Tang m�n", 3, "394a", "125678bc"),
            new SaoData(18, true, "Thi?u �m", 2, "9abc1", "2345678"),
            new SaoData(19, false, "Quan ph�", 4),
            new SaoData(20, false, "T? ph�", 1),
            new SaoData(21, false, "Tu? ph�", 4),
            new SaoData(22, true, "Long ??c", 2),
            new SaoData(23, false, "B?ch h?", 1, "394a", "125678bc"),
            new SaoData(24, true, "Ph�c ??c", 5),
            new SaoData(25, false, "?i?u kh�ch", 4),
            new SaoData(26, true, "Tr?c ph�", 1),
            new SaoData(27, true, "L?c t?n", 5),
            new SaoData(28, true, "L?c s?", 4),
            new SaoData(29, true, "Thanh long", 2, "5b28c1", "34679ab"),
            new SaoData(30, false, "Ti?u hao", 4, "34a9", ""),
            new SaoData(31, true, "T??ng qu�n", 3),
            new SaoData(32, true, "T?u th?", 1),
            new SaoData(33, false, "Phi li�m", 4),
            new SaoData(34, true, "H? th?n", 4),
            new SaoData(35, false, "B?nh ph�", 5),
            new SaoData(36, false, "??i hao", 4, "34a9", ""),
            new SaoData(37, false, "Ph?c binh", 4),
            new SaoData(38, false, "Quan ph?", 4),
            new SaoData(39, true, "Tr�ng sinh", 2),
            new SaoData(40, false, "M?c d?c", 2),
            new SaoData(41, false, "Quan ??i", 1),
            new SaoData(42, true, "L�m quan", 1),
            new SaoData(43, true, "?? v??ng", 1),
            new SaoData(44, false, "Suy", 2),
            new SaoData(45, false, "B?nh", 4),
            new SaoData(46, false, "T?", 4),
            new SaoData(47, false, "M?", 5),
            new SaoData(48, false, "Tuy?t", 5),
            new SaoData(49, false, "Thai", 5),
            new SaoData(50, true, "D??ng", 3),
            new SaoData(51, false, "?� la", 1, "5b286a", "134579bc"),
            new SaoData(52, false, "K�nh d??ng", 1, "5b28", "134679ac"),
            new SaoData(53, false, "??a kh�ng", 4, "6c39", "124578ab"),
            new SaoData(54, false, "??a ki?p", 4, "6c39", "124578ab"),
            new SaoData(55, false, "Linh tinh", 4, "34567", "1289abc"),
            new SaoData(56, false, "H?a tinh", 4, "34567", "1289abc"),
            new SaoData(57, true, "V?n x??ng", 1, "5b286c", ""),
            new SaoData(58, true, "V?n kh�c", 2, "5b286c", ""),
            new SaoData(59, true, "Thi�n kh�i", 4),
            new SaoData(60, true, "Thi�n vi?t", 4),
            new SaoData(61, true, "T? ph�", 5),
            new SaoData(62, true, "H?u b?t", 5),
            new SaoData(63, true, "Long tr�", 2, "4a", "_"),
            new SaoData(64, true, "Ph??ng c�c", 5, "4a", "_"),
            new SaoData(65, true, "Tam thai", 3),
            new SaoData(66, true, "B�t t?a", 2),
            new SaoData(67, true, "�n quang", 3),
            new SaoData(68, true, "Thi�n qu�", 5),
            new SaoData(69, false, "Thi�n kh?c", 2, "17", "_"),
            new SaoData(70, false, "Thi�n h?", 2, "17", "_"),
            new SaoData(71, true, "Thi�n ??c", 4),
            new SaoData(72, true, "Nguy?t ??c", 4),
            new SaoData(73, false, "Thi�n h�nh", 4, "394a", ""),
            new SaoData(74, false, "Thi�n ri�u", 2),
            new SaoData(75, true, "Thi�n y", 2),
            new SaoData(76, true, "Qu?c ?n", 5),
            new SaoData(77, true, "???ng ph�", 3),
            new SaoData(78, true, "?�o hoa", 3, "14", "_"),
            new SaoData(79, true, "H?ng loan", 2, "14579", "-"),
            new SaoData(80, true, "Thi�n h?", 2),
            new SaoData(81, true, "Thi�n gi?i", 4),
            new SaoData(82, true, "??a gi?i", 5),
            new SaoData(83, true, "Gi?i th?n", 3),
            new SaoData(84, true, "Thai ph?", 1),
            new SaoData(85, true, "Phong c�o", 5),
            new SaoData(86, true, "Thi�n t�i", 5),
            new SaoData(87, true, "Thi�n th?", 5),
            new SaoData(88, false, "Thi�n th??ng", 5),
            new SaoData(89, false, "Thi�n s?", 2),
            new SaoData(90, false, "Thi�n la", 5),
            new SaoData(91, false, "??a v�ng", 5),
            new SaoData(92, true, "H�a khoa", 2),
            new SaoData(93, true, "H�a quy?n", 2),
            new SaoData(94, true, "H�a l?c", 3),
            new SaoData(95, false, "H�a k?", 2, "5b28", "_"),
            new SaoData(96, false, "C� th?n", 5),
            new SaoData(97, false, "Qu? t�", 5),
            new SaoData(98, true, "Thi�n m�", 4),
            new SaoData(99, false, "Ph� to�i", 4),
            new SaoData(100, true, "Thi�n quan", 4),
            new SaoData(101, true, "Thi�n ph�c", 4),
            new SaoData(102, false, "L?u h�", 2),
            new SaoData(103, true, "Thi�n tr�", 5),
            new SaoData(104, false, "Ki?p s�t", 4),
            new SaoData(105, true, "Hoa c�i", 1),
            new SaoData(106, true, "V?n tinh", 4),
            new SaoData(107, true, "??u qu�n", 4),
            new SaoData(108, false, "Thi�n Kh�ng", 4),
            new SaoData(109, true, "B�c s?", 2),
            new SaoData(110, false, "Tu?n", 2),
            new SaoData(111, false, "Tri?t", 2)
        );
    }

    public function getCSData()
    {
        return $this->CSData;
    }

    public function getNapAm()
    {
        return $this->NapAm;
    }

    public function getDChi()
    {
        return $this->DChi;
    }

    public function getTCan()
    {
        return $this->TCan;
    }

    public function getLThan()
    {
        return $this->LThan;
    }

    public function FindByID($id)
    {
        for($i =0 ;$i < 141;$i++)
        {
            if($this->getCSData()[$i]->ID == $id)
            {
                return $this->getCSData()[$i];
            }
        }

        return new SaoData(0, false, "", 0);
    }
}