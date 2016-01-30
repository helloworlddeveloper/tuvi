<?php
/**
 * Created by PhpStorm.
 * User: hoavt
 * Date: 1/26/2016
 * Time: 5:06 PM
 */

namespace Mongo\TuviBundle\CoreTuVi;


use Symfony\Component\Config\Definition\Exception\Exception;

class BinhChu
{
    public $SaoId = array();
    public $CungId = array();
    public $LucThanId = array();
    public $LoiBinh = "";


    public function __construct()
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct' . $number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

    function __construct4($listSaoData = array(), $cungId = array(), $lucThanId = array(), $loiBinh = "")
    {

        foreach ($listSaoData as $sao) {
            array_push($this->SaoId, $sao->ID);
        }
        $this->CungId = $cungId;
        $this->LucThanId = $lucThanId;
        $this->LoiBinh = $loiBinh;
    }

    /* @Description : Load file db xml BinhChu
     * @Param
     * $pathFile : string
     * */
    public static function LoadFromFile($pathFile)
    {

        $saoData = new SaoDatabase();
        $listBinhChu = array();
        $xmlData = simpleXML_load_file($pathFile);
        foreach ($xmlData->children() as $binhChu) {
            try {
                $saosNode = $binhChu->Saos;
                $cungsNode = $binhChu->Cungs;
                $lthansNode = $binhChu->LucThans;
                $lbinh = $binhChu->LoiBinh;
                $saos = array();
                $cungs = array();
                $lthans = array();
                $CSData = $saoData->getCSData();
                if(isset($saosNode->Sao))
                    foreach ($saosNode->Sao as $sao) {
                        $ID = intval(BinhChu::xml_attribute($sao, 'ID'));
                        array_push($saos, $CSData[$ID - 1]);
                    }
                if(isset($saosNode->Cung))
                    foreach ($cungsNode->Cung as $cung) {
                        $ID = intval(BinhChu::xml_attribute($cung, 'ID'));
                        array_push($cungs, $ID);
                    }
                if(isset($saosNode->LucThan))
                    foreach ($lthansNode->LucThan as $lucthan) {
                        $ID = intval(BinhChu::xml_attribute($lucthan, 'ID'));
                        array_push($lthans, $ID);
                    }
                array_push($listBinhChu, new BinhChu($saos, $cungs, $lthans, $lbinh));
            } catch (Exception $e) {

            }
        }
        return $listBinhChu;
    }

    public static function xml_attribute($object, $attribute)
    {
        if (isset($object[$attribute]))
            return (string)$object[$attribute];
    }

    /* @Description: lay loi binh chu
     * @param
     * +$binhchu : array BinhChu
     * +$boSaoByCung : array Cung
     * +$dcCung : integer
     * +$SaoId : integer
     */
    public static function getLoiBinh($binhChus, $boSaoByCung, $dcCung, $saoId)
    {
        $ret = "";
        $listBChus = array();
        if ($saoId < 0) {
            $listBChus = BinhChu::SelectByLThan($binhChus, -$saoId);
        } else {
            $listBChus = BinhChu::SelectBySao($binhChus, $saoId);
        }
        foreach ($listBChus as $bc) {
            if ($bc->IsMatch($boSaoByCung, $dcCung)) {
                $ret = $ret + $bc->LoiBinh + "\n";
            }
        }
        return $ret;
    }

    /* @Description : query get LThan
     * @param : $binhChus: array
     *          $lThan : int
     * */
    private static function SelectByLThan($binhChus, $lThan)
    {
        $ret = array();
        foreach ($binhChus as $bc) {
            foreach ($bc->LucThanId as $lt) {
                if ($lt == $lThan) {
                    array_push($ret, $bc);
                    break;
                }
            }
        }
        return $ret;
    }

    /* @Description : query get Sao
     * @param : $binhChus: array
     *          $saoId : int
     * */
    private static function SelectBySao($bchus, $saoId)
    {
        $ret = array();
        foreach ($bchus as $bc) {
            if ($bc->HasSao($saoId)) {
                array_push($ret, $bc);
            }
        }
        return $ret;
    }


    /* @Description : Check
     * @param : $saoByCung: array
     *          $dcCung : int
     * */
    public function IsMatch($saoByCung, $dcCung)
    {
        return $this->StrickMatch($saoByCung, $dcCung);
    }

    private function StrickMatch($saoByCung, $dcCung)
    {
        if (!$this->isMatchLThanCung($saoByCung, $dcCung)) {
            return false;
        }
        $cungLQ = $this->CungLQuan($dcCung);
        $bosao = array();
        $temp = $cungLQ;
        for ($i = 0; $i < count($temp); $i++) {
            $cung = $temp[$i];
            array_push($bosao, $saoByCung[$cung - 1]);
        }
        foreach ($this->SaoId as $sao) {
            if ($this->FindSao($sao, $bosao) < 0) {
                return false;
            }
        }
        return true;
    }

    private function CungLQuan($dccung)
    {
        return array(
            $dccung,
            $this->XetSo($dccung - 4),
            $this->XetSo($dccung + 4),
            $this->XetSo($dccung + 6)
        );
    }

    private function XetSo($so)
    {
        $ret = $so % 12;
        if ($ret > 0) {
            return $ret;
        }
        return $ret + 12;
    }

    private function isMatchLThanCung($saoByCung, $dcCung)
    {
        $matchCung = false;
        if (count($this->CungId) > 0) {
            foreach ($this->CungId as $cung) {
                if ($cung == $dcCung) {
                    $matchCung = true;
                    break;
                }
            }
            goto IL_4A;
        }

        $matchCung = true;
        IL_4A:
        $matchLThan = false;
        if (count($this->LucThanId) > 0) {
            $saoInCung = $saoByCung[$dcCung - 1];
            foreach ($saoInCung as $sao) {
                foreach ($this->LucThanId as $id) {
                    if ($id == 1 & $sao->Type == 'H') {
                        $matchLThan = true;
                    }
                    if ($sao->Type == 'L' & $sao->ID == $id) {
                        $matchLThan = true;
                    }
                }
                if ($matchLThan) {
                    break;
                }
            }
            goto IL_F5;
        }

        $matchLThan = true;
        IL_F5:
        return $matchCung & $matchLThan;
    }

    public function HasSao($saoId)
    {
        foreach ($this->SaoId as $bcSaoId) {
            if ($bcSaoId == $saoId) {
                return true;
            }
        }
        return false;
    }

    private function FindSao($id, $bosao)
    {
        for ($i = 0; $i < count($bosao); $i++) {
            if ($bosao[$i]->ID == $id & $bosao[$i]->IsRealSao) {
                return $i;
            }
        }
        return -1;
    }


}