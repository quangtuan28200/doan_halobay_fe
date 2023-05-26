<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CallApiSeverService;
use Illuminate\Http\Request;
use App\Helpers\CommonFunctions;

class HotelController extends Controller
{
    protected const perPage = 10;
    protected const listLimit = 5;

    public function __construct()
    {
        $list_place_hotel = CallApiSeverService::methodGet('api/hotel-places/guest/getAll', []);
        \View::share('list_place_hotel', $list_place_hotel);
    }

    public static function __checkUser()
    {
        $token = \Session::get('token');
        $email = \Session::get('email');
        $user = null;
        if ($email && $token) $user = CallApiSeverService::methodGet('api/app-users/get-profile-by-login', ['login' => $email], $token);
        return $user;
    }

    public function searchHotel(Request $request)
    {
        $info = $request->all();
        session()->put('info-hotel', $info);

        $placeId = $request->placeId_hotel ? (int) $request->placeId_hotel : 1;
        $checkInDate = $request->start_date_hotel ?: null;
        $checkOutDate = $request->end_date_hotel ?: null;
        $hotelName = $request->hotelName ?: null;
        $orderBy = $request->orderBy ?: null;
        $star = $request->star ?: null;
        $priceFrom = $request->priceFrom ?: null;
        $priceTo = $request->priceTo ?: null;
        $rateFrom = $request->rateFrom ?: null;
        $rateTo = $request->rateTo ?: null;
        $type = $request->type ?: null;
        $page = 0;
        $data = [
            'placeId' => $placeId,
            'checkInDate' => $checkInDate,
            'checkOutDate' => $checkOutDate,
            'hotelName' => $hotelName,
            'orderBy' => $orderBy,
            'star' => $star,
            'priceFrom' => $priceFrom,
            'priceTo' => $priceTo,
            'rateFrom' => $rateFrom,
            'rateTo' => $rateTo,
            'type' => $type,
            'page' => $page,
            'itemPerPage' => self::perPage,
        ];
        // dd($data);
        $list_hotel = CallApiSeverService::methodGet('api/hotels/guest/customer-search', $data);
        $list_place = CallApiSeverService::methodGet('api/hotel-places/guest/getAll', []);
        $place = null;
        if ($list_place != 404 || $list_place != 500 || $list_place != 405 || $list_place != 400) {
            foreach ($list_place as $list) {
                if ($placeId === $list->id) {
                    $place = $list;
                }
            }
        }
        $user = $this->__checkUser();
        $totalPage = ceil($list_hotel->total / self::perPage);
        //dd($data, $info );
        return view('frontend.hotel.list_hotel', compact('place', 'list_hotel', 'info', 'user', 'page', 'totalPage'));
    }

    public function ajax_hotel(Request $request)
    {
        // dd($request->all());
        $apiFormat = [];
        $price_arr = explode('-', $request->orderByPrice);
        $rate_arr = explode('-', $request->orderByRate);
        $priceFrom = null;
        $priceTo = null;
        if ($request->orderByPrice != null) {
            $priceFrom = (int) $price_arr[0];
            if ($price_arr[1] != 0)  $priceTo = (int) $price_arr[1];
        }
        $rateFrom = null;
        $rateTo = null;
        if ($request->orderByRate != null) {
            $rateFrom = (float) $rate_arr[0];
            $rateTo = (float) $rate_arr[1];
        }
        $placeId = (int) $request->placeId ?: 1;
        $checkInDate = $request->checkInDate ?: null;
        $checkOutDate = $request->checkOutDate ?: null;
        $hotelName = $request->hotelName ?: null;
        $orderBy = (int) $request->orderBy ?: null;
        $star = (int) $request->star ?: null;
        $type = (int) $request->type_hotel ?: null;
        $page = (int) $request->page ?: 0;

        $data = [
            'placeId' => $placeId,
            'checkInDate' => $checkInDate,
            'checkOutDate' => $checkOutDate,
            'hotelName' => $hotelName,
            'orderBy' => $orderBy,
            'star' => $star,
            'priceFrom' => $priceFrom,
            'priceTo' => $priceTo,
            'rateFrom' => $rateFrom,
            'rateTo' => $rateTo,
            'type' => $type,
            'page' => $page,
            'itemPerPage' => self::perPage,
        ];
        // dd($data);
        $list_hotel = CallApiSeverService::methodGet('api/hotels/guest/customer-search', $data);

        $totalPage = (int) ceil($list_hotel->total / self::perPage);
        $apiFormat['data'] = view('frontend.block.hotel.ajax_hotel', compact('list_hotel'))->render();
        $apiFormat['pagination'] = view('frontend.block.common.pagination', compact('page', 'totalPage'))->render();
        // dd(response()->json($apiFormat));
        return response()->json($apiFormat);
    }

    public function detailHotel($slug)
    {
        $info = session()->all()['info-hotel'];

        $data = [
            'url' => $slug
        ];
        $hotel = CallApiSeverService::methodGet('api/hotels/guest/customer-getbyurl', $data);
        $user = $this->__checkUser();
        //dd($hotel);
        if ($hotel) {
            $rateListLimit = $hotel->rateCount >= self::listLimit ? array_slice($hotel->lstHotelRate, 0, 5) : $hotel->lstHotelRate;
            $qaListLimit = count($hotel->lstqa) >= self::listLimit ? array_slice($hotel->lstqa, 0, 5) : $hotel->lstqa;

            $rateData = [
                'detailId' => $hotel->id,
                'rateAverage' => $hotel->rateAverage,
                'rateLabel' => CommonFunctions::rateAvgToText($hotel->rateAverage),
                'rateCount' => $hotel->rateCount,
                'rateList' => $hotel->lstHotelRate,
                'rateListLimit' => $rateListLimit,
                'rateQualityCount' => CommonFunctions::countRateQuality($hotel->lstHotelRate),
                'rateQualityProgress' => CommonFunctions::rateQualityProgress($hotel->lstHotelRate),
            ];

            // dd($rateData);

            $qaData = [
                'detailId' => $hotel->id,
                'qaList' => $hotel->lstqa,
                'qaListLimit' => $qaListLimit,
            ];

            // dd($qaData);

            return view('frontend.hotel.detail', compact('hotel', 'user', 'info', 'rateData', 'qaData'));
        } else {
            return abort(404);
        }
    }

    public function ajax_hotel_room($id_room)
    {
        $data = [
            'roomId' => (int) $id_room
        ];
        $room = CallApiSeverService::methodGet('api/hotel-rooms/guest/customer-getbyid', $data);

        if ($room == "404" || $room == "500" || $room == "405" || $room == "400") {
            $apiFormat['success'] = false;
            $apiFormat['message'] = 'Có lỗi xảy ra, vui lòng thử lại sau';
            return response()->json($apiFormat);
        } else {
            if ($room->utiliti) {
                $utiliti = explode('|', $room->utiliti);
            } else {
                $utiliti = [];
            }
            $room->utiliti = $utiliti;
            $apiFormat['success'] = true;
            $apiFormat['data'] = view('frontend.block.hotel.ajax_hotel_room', compact('room'))->render();
            return response()->json($apiFormat);
        }
    }

    public function post_book_room(Request $request)
    {
        $info = $request->all();
        session()->put('info-book-room', $info);
    }

    public function get_book_room()
    {
        $info = session()->all()['info-book-room'];
        // dd($info);

        $is_background = 1;
        $url_hotel = $info['url'];
        $room_id_list = $info['room_id_list'];
        $room_num_list = $info['room_num_list'];
        $start_date_hotel = $info['start_date_hotel'];
        $end_date_hotel = $info['end_date_hotel'];

        if (!$url_hotel || !$room_id_list || !$room_num_list) return redirect()->route('home');

        $data = [
            'url' => $url_hotel
        ];

        $hotel = CallApiSeverService::methodGet('api/hotels/guest/customer-getbyurl', $data);
        // dd($hotel);

        $room_hotel = [];
        $info_payment = [];
        $total = 0;

        foreach ($room_id_list as $key => $room_id) {
            foreach ($hotel->lstRoom as $lstRoom) {
                if ($lstRoom->id == $room_id) {
                    for ($i = 0; $i < $room_num_list[$key]; $i++) {
                        $room_hotel[] = $lstRoom;
                    }
                    $info_payment[] = [
                        'number_room' => $room_num_list[$key],
                        'price' => $lstRoom->priceDefaultDiscount,
                        'name_room' => $lstRoom->name,
                    ];
                    $total = $total + $room_num_list[$key] * $lstRoom->priceDefaultDiscount;
                }
            }
        }

        $user = $this->__checkUser();

        // dd($room_hotel);
        // dd($info_payment);
        // dd($total);
        // dd($user);

        if ($hotel) {
            return view('frontend.hotel.book_room_hotel', compact('hotel', 'is_background', 'room_hotel', 'info_payment', 'total', 'user', 'start_date_hotel', 'end_date_hotel'));
        } else {
            return abort(404);
        }
    }

    public function book_room_in_hotel(Request $request)
    {
        // dd(session()->all());
        $info = session()->all()['info-book-room'];
        $payment_info = $request->all();
        $online_payment_success = session()->all()['online_payment_success'] ?? false;
        // dd($online_payment_success);
        if (empty($payment_info)) {
            $payment_info = session()->all()['online_payment_info'];
        }
        $user = $this->__checkUser();
        // dd($info);
        // dd($online_payment_success);
        // dd($payment_info);

        $extraBed = $payment_info['extraBed'] ?? ['0' => 0];
        $url_hotel = $info['url'];
        $array_room_hotel_id = $info['room_id_list'];
        $array_room_number = $info['room_num_list'];
        $start_date_hotel = $info['start_date_hotel'];
        $end_date_hotel = $info['end_date_hotel'];
        $number_hotel_adultNum = $info['hotel_adultNum'];
        $hotel_childNum = $info['hotel_childNum'];
        $hotel_childNum2 = $info['hotel_childNum2'];
        if (!$url_hotel || !$array_room_hotel_id || !$array_room_number || !$start_date_hotel || !$end_date_hotel) return redirect()->route('home');
        $data = [
            'url' => $url_hotel
        ];
        $hotel = CallApiSeverService::methodGet('api/hotels/guest/customer-getbyurl', $data);
        $room_hotel = [];
        foreach ($array_room_hotel_id as $key => $room_id) {
            foreach ($hotel->lstRoom as $lstRoom) {
                if ($lstRoom->id == $room_id) {
                    for ($i = 0; $i < $array_room_number[$key]; $i++) {
                        $room_hotel[] = (object) [
                            "id" => null,
                            "hotelId" => $hotel->id,
                            "customerId" =>  null,
                            "roomId" =>  $lstRoom->id,
                            "extraBed" => (int) $extraBed[$i],
                            "price" => $lstRoom->priceDefaultDiscount
                        ];
                    }
                }
            }
        }
        $is_invoice = "0";
        if (isset($payment_info['is_vat'])) $is_invoice = "1";
        $full_name = $payment_info['full_name'];
        $payment_money = 0;
        foreach ($room_hotel as $room) {
            $payment_money += $room->price;
        }
        $data = [
            "id" => null,
            "hotelId" => $hotel->id,
            "gender" =>  (int) $payment_info['gender'],
            "fullName" => $full_name,
            "cityId" => (int) $payment_info['city_id'],
            "address" => $payment_info['address'],
            "phone" => $payment_info['phone_number'],
            "phoneOther" => null,
            "email" => $payment_info['email'],
            "description" => $payment_info['content'],
            "isInvoice" => $is_invoice, // 1: có lấy hóa đơn đỏ
            "taxCode" => $is_invoice == "1" ? $payment_info['tax_code'] : null,
            "companyName" => $is_invoice == "1" ? $payment_info['company_name'] : null,
            "companyAddress" => $is_invoice == "1" ? $payment_info['company_address'] : null,
            "emailInvoice" => null,
            "paymentMethod" => (int) $payment_info['payment_method'],
            "paymentMoney" => $payment_money,
            "userId" => $user ? $user->id : null,
            "checkInStr" => $start_date_hotel,
            "checkOutStr" => $end_date_hotel,
            "adultNum" => (int) $number_hotel_adultNum,
            "childNum" => (int) $hotel_childNum,
            "childNum2" => (int) $hotel_childNum2,
            "lstRoom" => $room_hotel,
            "status" => $online_payment_success ? 6 : 1,
            "onlinePaymentOrderId" => $payment_info['vnp_TxnRef'] ?? null
        ];
        // dd($data);
        $result = CallApiSeverService::methodPostJson('api/hotel-customers/guest/order', $data);
        // $result = (object) [
        //     'status' => 201
        // ];
        if ($result->status === 201) {
            session()->flush();
            return view('frontend.success', compact('full_name', 'user'));
        } else {
            return view('frontend.fail', compact('full_name', 'user'));
        }
    }

    public function create_rate_hotel(Request $request)
    {
        // dd($request->all());
        $user = $this->__checkUser();
        // dd($user);
        $data = [
            "hotelId" => (int) $request->detailId,
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "content" => $request->content,
            "rate" => (int) $request->rate,
            "userId" => $user ? $user->id : null,
        ];

        // dd($data);
        $token = \Session::get('token');
        if (!$token) {
            $apiFormat['success'] = false;
            $apiFormat['message'] = 'Bạn cần đăng nhập để đánh giá khách sạn';
            return response()->json($apiFormat);
        }
        $result = CallApiSeverService::methodPostJson('api/hotel-rates', $data, $token);

        // dd($result);

        if ($result->status == 201 || $result->status == 200) {
            $apiFormat['success'] = true;
            $apiFormat['message'] = 'Cảm ơn bạn đã đánh giá khách sạn';
            return response()->json($apiFormat);
        } else {
            $apiFormat['success'] = false;
            $apiFormat['message'] = $result ? $result->message : 'Có lỗi xảy ra, vui lòng thử lại sau';
            return response()->json($apiFormat);
        }
    }

    public function update_rate_hotel(Request $request)
    {
        // dd($request->all());
        $user = $this->__checkUser();
        // dd($user);
        $data = [
            "id" => (int) $request->rateId,
            "hotelId" => (int) $request->detailId,
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "content" => $request->content,
            "rate" => (int) $request->rate,
            "userId" => $user ? $user->id : null,
        ];

        // dd($data);
        $token = \Session::get('token');
        if (!$token) {
            $apiFormat['success'] = false;
            $apiFormat['message'] = 'Bạn cần đăng nhập để cập nhật đánh giá khách sạn';
            return response()->json($apiFormat);
        }
        $result = CallApiSeverService::methodPutJson('api/hotel-rates', $data, $token);

        if ($result->status == 201 || $result->status == 200) {
            $apiFormat['success'] = true;
            $apiFormat['message'] = 'Cập nhật đánh giá khách sạn thành công';
            return response()->json($apiFormat);
        } else {
            $apiFormat['success'] = false;
            $apiFormat['message'] = $result->message ?: 'Có lỗi xảy ra, vui lòng thử lại sau';
            return response()->json($apiFormat);
        }
    }

    public function create_question_hotel(Request $request)
    {
        $user = $this->__checkUser();
        // dd($request->all());
        $data = [
            "hotelId" => (int) $request->detailId,
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "question" => $request->question,
            "userId" => $user ? $user->id : null,
        ];

        // dd($data);
        $token = \Session::get('token');
        if (!$token) {
            $apiFormat['success'] = false;
            $apiFormat['message'] = 'Bạn cần đăng nhập để gửi câu hỏi';
            return response()->json($apiFormat);
        }
        $result = CallApiSeverService::methodPostJson('api/hotel-question-answers', $data, $token);
        // dd($result);

        if ($result->status == 201 || $result->status == 200) {
            $apiFormat['success'] = true;
            $apiFormat['message'] = 'Cảm ơn bạn đã gửi câu hỏi';
            return response()->json($apiFormat);
        } else {
            $apiFormat['success'] = false;
            $apiFormat['message'] = $result ? $result->message : 'Có lỗi xảy ra, vui lòng thử lại sau';
            return response()->json($apiFormat);
        }
    }

    public function update_question_hotel(Request $request)
    {
        $user = $this->__checkUser();
        // dd($request->all());
        $data = [
            "id" => (int) $request->questionId,
            "hotelId" => (int) $request->detailId,
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "question" => $request->question,
            "userId" => $user ? $user->id : null,
        ];

        // dd($data);
        $token = \Session::get('token');
        if (!$token) {
            $apiFormat['success'] = false;
            $apiFormat['message'] = 'Bạn cần đăng nhập để gửi câu hỏi';
            return response()->json($apiFormat);
        }
        $result = CallApiSeverService::methodPutJson('api/hotel-question-answers', $data, $token);
        // dd($result);

        if ($result->status == 201 || $result->status == 200) {
            $apiFormat['success'] = true;
            $apiFormat['message'] = 'Cập nhật câu hỏi thành công';
            return response()->json($apiFormat);
        } else {
            $apiFormat['success'] = false;
            $apiFormat['message'] = $result ? $result->message : 'Có lỗi xảy ra, vui lòng thử lại sau';
            return response()->json($apiFormat);
        }
    }
}
