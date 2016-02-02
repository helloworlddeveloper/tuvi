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

    public $CSData = array();
    public $NapAm = array();
    public $DChi = array();
    public $TCan = array();
    public $LThan = array();

    public function __construct()
    {
        $this->LThan = array(
            "Mệnh",
            "Phụ mẫu",
            "Phúc đức",
            "Điền trạch",
            "Quan lộc",
            "Nô bộc",
            "Di",
            "Tật ách",
            "Tài bạch",
            "Tử tức",
            "Phu thê",
            "Huynh đệ"
        );
        $this->TCan = array(
            "Giáp",
            "Ất",
            "Bính",
            "Đinh",
            "Mậu",
            "Kỹ",
            "Canh",
            "Tân",
            "Nhâm",
            "Quí"
        );
        $this->DChi = array(
            "Tí",
            "Sữu",
            "Dần",
            "Mão",
            "Thìn",
            "Tị",
            "Ngọ",
            "Mùi",
            "Thân",
            "Dậu",
            "Tuất",
            "Hợi"
        );
        $this->NapAm = array(
            "HẢI TRUNG KIM",
            "GIÁNG HẠ THỦY",
            "TÍCH LỊCH HỎA",
            "BÍCH THƯỢNG THỔ",
            "TANG ÐỐ MỘC",
            "ÐẠI KHÊ THỦY",
            "LƯ TRUNG HỎA",
            "THÀNH ÐẦU THỔ",
            "TÒNG BÁ MỘC",
            "KIM BẠCH KIM",
            "PHÚ ÐĂNG HỎA",
            "SA TRUNG THỔ",
            "ÐẠI LÂM MỘC",
            "BẠCH LẠP KIM",
            "TRƯỜNG LƯU THỦY",
            "SA TRUNG KIM",
            "THIÊN HÀ THỦY",
            "THIÊN THƯỢNG HỎA",
            "LỘ BÀN THỔ",
            "DƯƠNG LIỄU MỘC",
            "TRUYỀN TRUNG THỦY",
            "SƠN HẠ HỎA",
            "ÐẠI TRẠCH THỔ",
            "THẠCH LỰU MỘC",
            "KIẾM PHONG KIM",
            "SƠN ÐẦU HỎA",
            "ỐC THƯỢNG THỔ",
            "BÌNH ÐỊA MỘC",
            "XOA XUYẾN KIM",
            "ÐẠI HẢI THỦY"
        );
        $this->CSData = array(
            new SaoData(1, "Tử vi", 5, "28", "-", "6739", "5b", "c14a", true),
            new SaoData(2, "Liêm trinh", 4, "28", "6c4a", "5b", "1739", "", true),
            new SaoData(3, "Thiên đồng", 2, "46c", "5a287b", "39", "1", "", false),
            new SaoData(4, "Vũ khúc", 1, "4a", "6c", "5b28", "3917", "", true),
            new SaoData(5, "Thái dương", 4, "28", "9abc1", "67", "345", "", false),
            new SaoData(6, "Thiên cơ", 3, "1728", "3c", "5b4a", "69", "", false),
            new SaoData(7, "Thiên phủ", 5, "6c8", "-", "3917", "5b", "4a2", false),
            new SaoData(8, "Thái âm", 2, "28", "34567", "abc", "91", "", true),
            new SaoData(9, "Tham lang", 2, "39", "6c174a", "28", "5b", "", true),
            new SaoData(10, "Cự môn", 2, "9c", "5b286", "4a", "173", "", true),
            new SaoData(11, "Thiên tướng", 2, "286c", "4a", "39", "5b17", "", false),
            new SaoData(12, "Thiên lương", 3, "28", "a6c", "75b", "1439", "", false),
            new SaoData(13, "Thất sát", 1, "28", "4a5b", "3917", "6c", "", false),
            new SaoData(14, "Phá quân", 2, "5b", "4a396c", "17", "28", "", true),
            new SaoData(15, false, "Thái tuế", 4),
            new SaoData(16, true, "Thiếu dương", 4, "34567", "1289abc"),
            new SaoData(17, false, "Tang môn", 3, "394a", "125678bc"),
            new SaoData(18, true, "Thiếu âm", 2, "9abc1", "2345678"),
            new SaoData(19, false, "Quan phù", 4),
            new SaoData(20, false, "Tử phù", 1),
            new SaoData(21, false, "Tuế phá", 4),
            new SaoData(22, true, "Long đức", 2),
            new SaoData(23, false, "Bạch hổ", 1, "394a", "125678bc"),
            new SaoData(24, true, "Phúc đức", 5),
            new SaoData(25, false, "Điếu khách", 4),
            new SaoData(26, true, "Trực phù", 1),
            new SaoData(27, true, "Lộc tồn", 5),
            new SaoData(28, true, "Lực sĩ", 4),
            new SaoData(29, true, "Thanh long", 2, "5b28c1", "34679ab"),
            new SaoData(30, false, "Tiểu hao", 4, "34a9", ""),
            new SaoData(31, true, "Tướng quân", 3),
            new SaoData(32, true, "Tấu thư", 1),
            new SaoData(33, false, "Phi liêm", 4),
            new SaoData(34, true, "Hỉ thần", 4),
            new SaoData(35, false, "Bệnh phù", 5),
            new SaoData(36, false, "Đại hao", 4, "34a9", ""),
            new SaoData(37, false, "Phục binh", 4),
            new SaoData(38, false, "Quan phủ", 4),
            new SaoData(39, true, "Tràng sinh", 2),
            new SaoData(40, false, "Mộc dục", 2),
            new SaoData(41, false, "Quan đới", 1),
            new SaoData(42, true, "Lâm quan", 1),
            new SaoData(43, true, "Đế vượng", 1),
            new SaoData(44, false, "Suy", 2),
            new SaoData(45, false, "Bệnh", 4),
            new SaoData(46, false, "Tử", 4),
            new SaoData(47, false, "Mộ", 5),
            new SaoData(48, false, "Tuyệt", 5),
            new SaoData(49, false, "Thai", 5),
            new SaoData(50, true, "Dưỡng", 3),
            new SaoData(51, false, "Đà la", 1, "5b286a", "134579bc"),
            new SaoData(52, false, "Kình dương", 1, "5b28", "134679ac"),
            new SaoData(53, false, "Địa không", 4, "6c39", "124578ab"),
            new SaoData(54, false, "Địa kiếp", 4, "6c39", "124578ab"),
            new SaoData(55, false, "Linh tinh", 4, "34567", "1289abc"),
            new SaoData(56, false, "Hỏa tinh", 4, "34567", "1289abc"),
            new SaoData(57, true, "Văn xương", 1, "5b286c", ""),
            new SaoData(58, true, "Văn khúc", 2, "5b286c", ""),
            new SaoData(59, true, "Thiên khôi", 4),
            new SaoData(60, true, "Thiên việt", 4),
            new SaoData(61, true, "Tả phù", 5),
            new SaoData(62, true, "Hữu bật", 5),
            new SaoData(63, true, "Long trì", 2, "4a", "_"),
            new SaoData(64, true, "Phượng các", 5, "4a", "_"),
            new SaoData(65, true, "Tam thai", 3),
            new SaoData(66, true, "Bát tọa", 2),
            new SaoData(67, true, "Ân quang", 3),
            new SaoData(68, true, "Thiên quý", 5),
            new SaoData(69, false, "Thiên khốc", 2, "17", "_"),
            new SaoData(70, false, "Thiên hư", 2, "17", "_"),
            new SaoData(71, true, "Thiên đức", 4),
            new SaoData(72, true, "Nguyệt đức", 4),
            new SaoData(73, false, "Thiên hình", 4, "394a", ""),
            new SaoData(74, false, "Thiên riêu", 2),
            new SaoData(75, true, "Thiên y", 2),
            new SaoData(76, true, "Quốc ấn", 5),
            new SaoData(77, true, "Đường phù", 3),
            new SaoData(78, true, "Đào hoa", 3, "14", "_"),
            new SaoData(79, true, "Hồng loan", 2, "14579", "-"),
            new SaoData(80, true, "Thiên hỉ", 2),
            new SaoData(81, true, "Thiên giải", 4),
            new SaoData(82, true, "Địa giải", 5),
            new SaoData(83, true, "Giải thần", 3),
            new SaoData(84, true, "Thai phụ", 1),
            new SaoData(85, true, "Phong cáo", 5),
            new SaoData(86, true, "Thiên tài", 5),
            new SaoData(87, true, "Thiên thọ", 5),
            new SaoData(88, false, "Thiên thương", 5),
            new SaoData(89, false, "Thiên sứ", 2),
            new SaoData(90, false, "Thiên la", 5),
            new SaoData(91, false, "Địa võng", 5),
            new SaoData(92, true, "Hóa khoa", 2),
            new SaoData(93, true, "Hóa quyền", 2),
            new SaoData(94, true, "Hóa lộc", 3),
            new SaoData(95, false, "Hóa kỵ", 2, "5b28", "_"),
            new SaoData(96, false, "Cô thần", 5),
            new SaoData(97, false, "Quả tú", 5),
            new SaoData(98, true, "Thiên mã", 4),
            new SaoData(99, false, "Phá toái", 4),
            new SaoData(100, true, "Thiên quan", 4),
            new SaoData(101, true, "Thiên phúc", 4),
            new SaoData(102, false, "Lưu hà", 2),
            new SaoData(103, true, "Thiên trù", 5),
            new SaoData(104, false, "Kiếp sát", 4),
            new SaoData(105, true, "Hoa cái", 1),
            new SaoData(106, true, "Văn tinh", 4),
            new SaoData(107, true, "Đẩu quân", 4),
            new SaoData(108, false, "Thiên Không", 4),
            new SaoData(109, true, "Bác sĩ", 2),
            new SaoData(110, false, "Tuần", 2),
            new SaoData(111, false, "Triệt", 2)
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
        for ($i = 0; $i < 141; $i++) {
            if ($this->getCSData()[$i]->ID == $id) {
                return $this->getCSData()[$i];
            }
        }

        return new SaoData(0, false, "", 0);
    }
}