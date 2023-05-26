<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>VNPAY RESPONSE</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <script type="text/javascript" src="{{ asset('frontend/js/jquery-3.5.1.min.js') }}"></script>
</head>

<body>
    <?php
    $vnp_HashSecret = "FGRNTAQLIQEBIBYLWHYDZMDZOKPGZHQA"; //Secret key
    $vnp_SecureHash = $_GET['vnp_SecureHash'];
    $inputData = array();
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == "vnp_") {
            $inputData[$key] = $value;
        }
    }

    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
    }

    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
    $epoch = $_GET['vnp_PayDate'];
    $dt = new DateTime($epoch);  // convert UNIX timestamp to PHP DateTime
    $formattedAmount = number_format($_GET['vnp_Amount'] / 100, 0, ',', '.') . ' VND';
    ?>
    <!--Begin display -->
    <div class="container">
        <div class="header clearfix">
            <h3 class="text-muted" style="margin: 30px 0; text-align: center;">VNPAY RESPONSE</h3>
        </div>
        <div class="table-responsive">
            <div class="form-group">
                <label style="font-weight: 500">Mã đơn hàng:</label>
                <label><?php echo $_GET['vnp_TxnRef'] ?></label>
            </div>
            <div class="form-group">
                <label style="font-weight: 500">Số tiền:</label>
                <label><?php echo $formattedAmount ?></label>
            </div>
            <div class="form-group">
                <label style="font-weight: 500">Nội dung thanh toán:</label>
                <label><?php echo $_GET['vnp_OrderInfo'] ?></label>
            </div>
            <div class="form-group">
                <label style="font-weight: 500">Mã phản hồi (vnp_ResponseCode):</label>
                <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
            </div>
            <div class="form-group">
                <label style="font-weight: 500">Mã GD Tại VNPAY:</label>
                <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
            </div>
            <div class="form-group">
                <label style="font-weight: 500">Mã Ngân hàng:</label>
                <label><?php echo $_GET['vnp_BankCode'] ?></label>
            </div>
            <div class="form-group">
                <label style="font-weight: 500">Thời gian thanh toán:</label>
                <label><?php echo $dt->format('Y-m-d H:i:s') ?></label>
            </div>
            <div class="form-group">
                <label style="font-weight: 500">Kết quả:</label>
                <label>
                    <?php
                    if ($secureHash == $vnp_SecureHash) {
                        if ($_GET['vnp_ResponseCode'] == '00') {
                            session()->put('online_payment_success', true);
                            echo "<span style='color:green'>GIAO DỊCH THÀNH CÔNG</span><span>, nhấn tiếp tục để hoàn thành đặt dịch vụ</span>";
                        } else {
                            echo "<span style='color:red'>GIAO DỊCH KHÔNG THÀNH CÔNG</span><span>, vui lòng thử lại hoặc chọn phương thức thanh toán khác</span>";
                        }
                    } else {
                        echo "<span style='color:red'>Chữ ký không hợp lệ</span>";
                    }
                    ?>
                </label>
            </div>
            <div class="form-group">
                <?php
                if ($secureHash == $vnp_SecureHash) {
                    if ($_GET['vnp_ResponseCode'] == '00') {
                        echo "<a href='" . route('book_room_in_hotel_online_payment') . "'><button type='button' class='btn btn-success'>Tiếp tục</button></a>";
                    } else {
                        echo "<a href='" . route('get_book_room') . "'><button type='button' class='btn btn-success'>Quay lại</button></a>";
                    }
                }
                ?>
            </div>

        </div>
        <p>
            &nbsp;
        </p>
        <footer class="footer">
            <p style="text-align: center;">&copy; VNPAY <?php echo date('Y') ?></p>
        </footer>
    </div>
</body>

</html>