<?php
/**
 * Created by PhpStorm.
 * User: hoavt
 * Date: 2/1/2016
 * Time: 2:30 PM
 */

namespace Mongo\TuviBundle\CoreTuVi;


class Cung
{
    /* @var : integer
     * */
    public $diaChi;

    /* @var : //Class Objec array Sao
     * */
    public $BoSao = array();

    /* @var : class object array BinhChu
     * */
    public $binhChus = array();

    /* @var : class object array Sao
     * */
    public $BoSaoCungs;

    public $lucThan = array(
        "Mệnh",
        "Phụ",
        "Phúc",
        "Điền",
        "Quan",
        "Nô",
        "Di",
        "Ách",
        "Tài",
        "Tử",
        "Phối",
        "Huynh"
    );

    public function __construct()
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct' . $number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

    function __construct3($diachi, $bosaoCungs = array(), $binhchus = array())
    {

        $this->diaChi = $diachi;
        $this->BoSaoCungs = $bosaoCungs;
        $this->binhChus = $binhchus;

    }

    public function intSao()
    {
        $cTinhCount = 0;
        $catTinhCount = 0;
        $amTinhCount = 0;
        foreach($this->BoSao as $sao)
        {
            $type = $sao->Type;
            switch ($type)
            {
                case 'B':
                {
                    if ($sao->CatTinh)
                        $catTinhCount++;
                    else
                        $amTinhCount++;
                }
            }
        }
    }
}