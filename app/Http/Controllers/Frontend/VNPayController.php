<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

date_default_timezone_set('Asia/Ho_Chi_Minh');
class VNPayController extends Controller
{
    public function init_vnpay_payment(Request $request)
    {
        $vnp_TxnRef = 'halobay_order_' . time(); //Mã giao dịch thanh toán tham chiếu của merchant
        $request['vnp_TxnRef'] = $vnp_TxnRef;
        // dd($request->all());
        session()->put('online_payment_info', $request->all());
        return redirect()->route('vnpay_payment');
    }
    public function vnpay_payment()
    {
        // dd(session()->all());
        $request = session()->all()['online_payment_info'];
        // dd($request);
        //config
        $vnp_TmnCode = "G9A3Z4G8"; //Mã định danh merchant kết nối (Terminal Id)
        $vnp_HashSecret = "FGRNTAQLIQEBIBYLWHYDZMDZOKPGZHQA"; //Secret key
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay_return');
        //Expire
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));
        // payment_info
        $vnp_TxnRef = $request['vnp_TxnRef']; //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount = $request['payment_money']; // Số tiền thanh toán
        $vnp_Locale = 'vn'; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = 'NCB'; //Mã phương thức thanh toán
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $expire
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        header('Location: ' . $vnp_Url);
        die();
    }

    public function vnpay_return()
    {
        // dd(session()->all());
        $payment_for = session()->all()['online_payment_info']['payment_for'];
        // dd($payment_for);
        return view('components.VnPayReturn.VnPayReturn', compact('payment_for'));
    }
}
