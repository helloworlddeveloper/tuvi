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
            "Phúc ??c",
            "?i?n tr?ch",
            "Quan l?c",
            "Nô b?c",
            "Di",
            "T?t ách",
            "Tài b?ch",
            "T? t?c",
            "Phu thê",
            "Huynh ??"
        );
        $this->TCan = array(
            "Giáp",
            "?t",
            "Bính",
            "?inh",
            "M?u",
            "K?",
            "Canh",
            "Tân",
            "Nhâm",
            "Quí"
        );
        $this->DChi = array(
            "Tí",
            "S?u",
            "D?n",
            "Mão",
            "Thìn",
            "T?",
            "Ng?",
            "Mùi",
            "Thân",
            "D?u",
            "Tu?t",
            "H?i"
        );
        $this->NapAm = array(
            "H?I TRUNG KIM",
            "GIÁNG H? TH?Y",
            "TÍCH L?CH H?A",
            "BÍCH TH??NG TH?",
            "TANG Ð? M?C",
            "Ð?I KHÊ TH?Y",
            "L? TRUNG H?A",
            "THÀNH Ð?U TH?",
            "TÒNG BÁ M?C",
            "KIM B?CH KIM",
            "PHÚ Ð?NG H?A",
            "SA TRUNG TH?",
            "Ð?I LÂM M?C",
            "B?CH L?P KIM",
            "TR??NG L?U TH?Y",
            "SA TRUNG KIM",
            "THIÊN HÀ TH?Y",
            "THIÊN TH??NG H?A",
            "L? BÀN TH?",
            "D??NG LI?U M?C",
            "TRUY?N TRUNG TH?Y",
            "S?N H? H?A",
            "Ð?I TR?CH TH?",
            "TH?CH L?U M?C",
            "KI?M PHONG KIM",
            "S?N Ð?U H?A",
            "?C TH??NG TH?",
            "BÌNH Ð?A M?C",
            "XOA XUY?N KIM",
            "Ð?I H?I TH?Y"
        );
        $this->CSData = array(
            new SaoData(1, "T? vi", 5, "28", "-", "6739", "5b", "c14a", true),
            new SaoData(2, "Liêm trinh", 4, "28", "6c4a", "5b", "1739", "", true),
            new SaoData(3, "Thiên ??ng", 2, "46c", "5a287b", "39", "1", "", false),
            new SaoData(4, "V? khúc", 1, "4a", "6c", "5b28", "3917", "", true),
            new SaoData(5, "Thái d??ng", 4, "28", "9abc1", "67", "345", "", false),
            new SaoData(6, "Thiên c?", 3, "1728", "3c", "5b4a", "69", "", false),
            new SaoData(7, "Thiên ph?", 5, "6c8", "-", "3917", "5b", "4a2", false),
            new SaoData(8, "Thái âm", 2, "28", "34567", "abc", "91", "", true),
            new SaoData(9, "Tham lang", 2, "39", "6c174a", "28", "5b", "", true),
            new SaoData(10, "C? môn", 2, "9c", "5b286", "4a", "173", "", true),
            new SaoData(11, "Thiên t??ng", 2, "286c", "4a", "39", "5b17", "", false),
            new SaoData(12, "Thiên l??ng", 3, "28", "a6c", "75b", "1439", "", false),
            new SaoData(13, "Th?t sát", 1, "28", "4a5b", "3917", "6c", "", false),
            new SaoData(14, "Phá quân", 2, "5b", "4a396c", "17", "28", "", true),
            new SaoData(15, false, "Thái tu?", 4),
            new SaoData(16, true, "Thi?u d??ng", 4, "34567", "1289abc"),
            new SaoData(17, false, "Tang môn", 3, "394a", "125678bc"),
            new SaoData(18, true, "Thi?u âm", 2, "9abc1", "2345678"),
            new SaoData(19, false, "Quan phù", 4),
            new SaoData(20, false, "T? phù", 1),
            new SaoData(21, false, "Tu? phá", 4),
            new SaoData(22, true, "Long ??c", 2),
            new SaoData(23, false, "B?ch h?", 1, "394a", "125678bc"),
            new SaoData(24, true, "Phúc ??c", 5),
            new SaoData(25, false, "?i?u khách", 4),
            new SaoData(26, true, "Tr?c phù", 1),
            new SaoData(27, true, "L?c t?n", 5),
            new SaoData(28, true, "L?c s?", 4),
            new SaoData(29, true, "Thanh long", 2, "5b28c1", "34679ab"),
            new SaoData(30, false, "Ti?u hao", 4, "34a9", ""),
            new SaoData(31, true, "T??ng quân", 3),
            new SaoData(32, true, "T?u th?", 1),
            new SaoData(33, false, "Phi liêm", 4),
            new SaoData(34, true, "H? th?n", 4),
            new SaoData(35, false, "B?nh phù", 5),
            new SaoData(36, false, "??i hao", 4, "34a9", ""),
            new SaoData(37, false, "Ph?c binh", 4),
            new SaoData(38, false, "Quan ph?", 4),
            new SaoData(39, true, "Tràng sinh", 2),
            new SaoData(40, false, "M?c d?c", 2),
            new SaoData(41, false, "Quan ??i", 1),
            new SaoData(42, true, "Lâm quan", 1),
            new SaoData(43, true, "?? v??ng", 1),
            new SaoData(44, false, "Suy", 2),
            new SaoData(45, false, "B?nh", 4),
            new SaoData(46, false, "T?", 4),
            new SaoData(47, false, "M?", 5),
            new SaoData(48, false, "Tuy?t", 5),
            new SaoData(49, false, "Thai", 5),
            new SaoData(50, true, "D??ng", 3),
            new SaoData(51, false, "?à la", 1, "5b286a", "134579bc"),
            new SaoData(52, false, "Kình d??ng", 1, "5b28", "134679ac"),
            new SaoData(53, false, "??a không", 4, "6c39", "124578ab"),
            new SaoData(54, false, "??a ki?p", 4, "6c39", "124578ab"),
            new SaoData(55, false, "Linh tinh", 4, "34567", "1289abc"),
            new SaoData(56, false, "H?a tinh", 4, "34567", "1289abc"),
            new SaoData(57, true, "V?n x??ng", 1, "5b286c", ""),
            new SaoData(58, true, "V?n khúc", 2, "5b286c", ""),
            new SaoData(59, true, "Thiên khôi", 4),
            new SaoData(60, true, "Thiên vi?t", 4),
            new SaoData(61, true, "T? phù", 5),
            new SaoData(62, true, "H?u b?t", 5),
            new SaoData(63, true, "Long trì", 2, "4a", "_"),
            new SaoData(64, true, "Ph??ng các", 5, "4a", "_"),
            new SaoData(65, true, "Tam thai", 3),
            new SaoData(66, true, "Bát t?a", 2),
            new SaoData(67, true, "Ân quang", 3),
            new SaoData(68, true, "Thiên quý", 5),
            new SaoData(69, false, "Thiên kh?c", 2, "17", "_"),
            new SaoData(70, false, "Thiên h?", 2, "17", "_"),
            new SaoData(71, true, "Thiên ??c", 4),
            new SaoData(72, true, "Nguy?t ??c", 4),
            new SaoData(73, false, "Thiên hình", 4, "394a", ""),
            new SaoData(74, false, "Thiên riêu", 2),
            new SaoData(75, true, "Thiên y", 2),
            new SaoData(76, true, "Qu?c ?n", 5),
            new SaoData(77, true, "???ng phù", 3),
            new SaoData(78, true, "?ào hoa", 3, "14", "_"),
            new SaoData(79, true, "H?ng loan", 2, "14579", "-"),
            new SaoData(80, true, "Thiên h?", 2),
            new SaoData(81, true, "Thiên gi?i", 4),
            new SaoData(82, true, "??a gi?i", 5),
            new SaoData(83, true, "Gi?i th?n", 3),
            new SaoData(84, true, "Thai ph?", 1),
            new SaoData(85, true, "Phong cáo", 5),
            new SaoData(86, true, "Thiên tài", 5),
            new SaoData(87, true, "Thiên th?", 5),
            new SaoData(88, false, "Thiên th??ng", 5),
            new SaoData(89, false, "Thiên s?", 2),
            new SaoData(90, false, "Thiên la", 5),
            new SaoData(91, false, "??a võng", 5),
            new SaoData(92, true, "Hóa khoa", 2),
            new SaoData(93, true, "Hóa quy?n", 2),
            new SaoData(94, true, "Hóa l?c", 3),
            new SaoData(95, false, "Hóa k?", 2, "5b28", "_"),
            new SaoData(96, false, "Cô th?n", 5),
            new SaoData(97, false, "Qu? tú", 5),
            new SaoData(98, true, "Thiên mã", 4),
            new SaoData(99, false, "Phá toái", 4),
            new SaoData(100, true, "Thiên quan", 4),
            new SaoData(101, true, "Thiên phúc", 4),
            new SaoData(102, false, "L?u hà", 2),
            new SaoData(103, true, "Thiên trù", 5),
            new SaoData(104, false, "Ki?p sát", 4),
            new SaoData(105, true, "Hoa cái", 1),
            new SaoData(106, true, "V?n tinh", 4),
            new SaoData(107, true, "??u quân", 4),
            new SaoData(108, false, "Thiên Không", 4),
            new SaoData(109, true, "Bác s?", 2),
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