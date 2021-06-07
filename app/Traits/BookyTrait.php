<?php

namespace App\Traits;

trait BookyTrait
{
    protected function addPaymentBooky($payment_type, $amonut, $bill_number, $payment_hash_mac)
    //protected function addPaymentBooky()
    {
        $payment_method = 'knet';
        if($payment_type == 3){$payment_method = 'credit';}
        $url = 'https://apps.bookeey.com/pgapi/api/payment/requestLink';
        $jsonData = array(
            "DBRqst" => "PY_ECom",
            "Do_Appinfo" => array(
                 "APIVer" => "",
                "APPID" => "",
                "APPTyp" => "",
                "AppVer" => "",
                "Country" => "",
                "DevcType" => "5",
                "HsCode" => "",
                "IPAddrs" => "",
                "MdlID" => "",
                "OS" => "Android",
                "UsrSessID" => ""
            ),
            "Do_MerchDtl" => array(
                "BKY_PRDENUM" => "ECom",
                "FURL" => config('app.url').'/api/reservations/paymentFailure',
                "MerchUID" => "mer2000032",
                "SURL" => config('app.url').'/api/reservations/paymentSuccess'
            ),
            "Do_MoreDtl" => array(
                "Cust_Data1" => "",
                "Cust_Data2" => "",
                "Cust_Data3" => ""
            ),
            "Do_PyrDtl" => array(
                "Pyr_MPhone" => "",
                "Pyr_Name" => ""
            ),
            "Do_TxnDtl" => array(
                [
                    "SubMerchUID" => "subm20000160",
                    "Txn_AMT" => $amonut
                ]
                ),
            "Do_TxnHdr" => array(
                "BKY_Txn_UID" => "",
                "Merch_Txn_UID" => $payment_hash_mac, //bill number
                "PayFor" => "ECom",
                "PayMethod" => $payment_method,
                "Txn_HDR" => "14566978599112346",
                "hashMac" => $bill_number
            )
        );
        $json = json_encode($jsonData);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result_payment = json_decode($result, true);
    }

    //get payment details
    protected function getPaymentBooky($bill_number, $payment_hash_mac)
    {
        $url = 'https://apps.bookeey.com/pgapi/api/payment/paymentstatus';
        $jsonData = array(
            "Mid" => "mer2000032",
            "MerchantTxnRefNo" => [
                $bill_number //bill number
            ],
            "HashMac" => $payment_hash_mac
        );
        $json = json_encode($jsonData);

        $result = file_get_contents($url, null, stream_context_create(array(
            'http' => array(
            'method' => 'GET',
            'header' => 'Content-Type: application/json',
            'content' => $json,
            ),
        )));
        return json_decode($result, true);
    }





}
