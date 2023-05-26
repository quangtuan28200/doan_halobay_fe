<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CallApiSeverService;
use Illuminate\Http\Request;

class YachtController extends Controller
{
    public function __construct()
    {
        $list_place_yacht = CallApiSeverService::methodGet('api/yacht-places/guest/getAll', []);
        \View::share('list_place_yacht', $list_place_yacht);
    }

    public static function __checkUser()
    {
        $token = \Session::get('token');
        $email = \Session::get('email');
        $user = null;
        if ($email && $token) $user = CallApiSeverService::methodGet('api/app-users/get-profile-by-login', ['login' => $email], $token);
        return $user;
    }

    public function post_search_Yacht(Request $request)
    {
        //dd($request->all());
        $info = $request->all();
        session()->put('info', $info);

        $placeId = $request->yacht_place ? (int) $request->yacht_place : 1;
        $checkInDate = $request->yacht_book_date ?: null;
        $yachtName = $request->yacht_name ?: null;
        $orderBy = $request->orderBy ?: 0;
        $star = $request->yacht_number_star ? (int) $request->yacht_number_star : null;
        $tourDay = $request->yacht_number_day ?: null;
        $page = $request->page ?: 0;
        $data = [
            'placeId' => $placeId,
            'checkInDateStr' => $checkInDate,
            'yachtName' => $yachtName,
            'orderBy' => $orderBy,
            'star' => 0,
            'tourDay' => 0,
            'page' => $page,
            'itemPerPage' => 10,
        ];
        $list_yacht = CallApiSeverService::methodGet('api/yachts/guest/customer-search', $data);
        $list_place = CallApiSeverService::methodGet('api/yacht-places/guest/getAll', []);
        $place = null;
        if ($list_place != 404 || $list_place != 500 || $list_place != 405 || $list_place != 400) {
            foreach ($list_place as $list) {
                if ($placeId === $list->id) {
                    $place = $list;
                }
            }
        }
        $user = $this->__checkUser();
        //dd($list_yacht, $data );
        return view('frontend.yacht.list_yacht', compact('place', 'list_yacht', 'info', 'user'));
    }

    public function ajax_yacht(Request $request)
    {
        //dd($request->all());
        $placeId = $request->yacht_place ? (int) $request->yacht_place : 1;
        $checkInDate = $request->yacht_book_date ?: null;
        $yachtName = $request->yacht_name ?: null;
        $orderBy = $request->orderBy ?: 0;
        $star = $request->yacht_number_star ? (int) $request->yacht_number_star : null;
        $tourDay = $request->yacht_number_day ?: null;
        $page = $request->page ?: 0;
        $data = [
            'placeId' => $placeId,
            'checkInDateStr' => $checkInDate,
            'yachtName' => $yachtName,
            'orderBy' => $orderBy,
            'star' => 0,
            'tourDay' => 0,
            'page' => $page,
            'itemPerPage' => 10,
        ];
        $list_yacht = CallApiSeverService::methodGet('api/yachts/guest/customer-search', $data);
        $apiFormat = [];
        $apiFormat['page'] = (int) $page;
        $apiFormat['data'] = view('frontend.block.ajax_yacht', compact('list_yacht'))->render();
        return response()->json($apiFormat);
    }

    public function detaiYacht($slug)
    {
        //dd($slug);
        $data = [
            'url' => $slug
        ];
        $hotel = CallApiSeverService::methodGet('api/yachts/guest/customer-getbyurl', $data);
        $user = $this->__checkUser();
        //dd($hotel);
        if ($hotel) {
            return view('frontend.yacht.detail', compact('hotel', 'user'));
        } else {
            return abort(404);
        }
    }

    public function ajax_yacht_room($id_room)
    {
        $data = [
            'roomId' => $id_room
        ];
        $room = CallApiSeverService::methodGet('api/yacht-rooms/guest/customer-getbyid', $data);
        $apiFormat = [];
        if ($room->utiliti) {
            $utiliti = explode('|', $room->utiliti);
        } else {
            $utiliti = [];
        }
        $room->utiliti = $utiliti;
        $apiFormat['data'] = view('frontend.block.ajax_hotel_room', compact('room'))->render();
        return response()->json($apiFormat);
    }

    public function post_book_room_in_yacht(Request $request)
    {
        //dd($request->all());
        session()->put('book_room_in_yacht', $request->all());
        \Session::put('url_yacht', $request->url);
        \Session::put('array_room_yacht', $request->array_room);
        \Session::put('array_room_yacht_number', $request->array_number);
        \Session::put('yacht_book_date', $request->yacht_book_date);
        \Session::put('yacht_adultNum', $request->yacht_adultNum);
        \Session::put('yacht_childNum', $request->yacht_childNum);
        \Session::put('yacht_childNum2', $request->yacht_childNum2);
    }

    public function get_book_room_yacht()
    {
        $url_yacht = \Session::get('url_yacht');
        $array_room_yacht_id = \Session::get('array_room_yacht');
        $array_room_yacht_number = \Session::get('array_room_yacht_number');
        if (!$url_yacht || !$array_room_yacht_id || !$array_room_yacht_number) return redirect()->route('home');
        $data = [
            'url' => $url_yacht
        ];
        $is_background = 1;
        $hotel = CallApiSeverService::methodGet('api/yachts/guest/customer-getbyurl', $data);
        $room_yacht = [];
        $info_payment = [];
        $total = 0;
        foreach ($array_room_yacht_id as $key => $room_id) {
            foreach ($hotel->lstRoom as $lstRoom) {
                if ($lstRoom->id == $room_id) {
                    for ($i = 0; $i < $array_room_yacht_number[$key]; $i++) {
                        $room_yacht[] = $lstRoom;
                    }
                    $info_payment[] = [
                        'number_room' => $array_room_yacht_number[$key],
                        'price' => $lstRoom->priceDefaultDiscount,
                        'name_room' => $lstRoom->name,
                    ];
                    $total = $total + $array_room_yacht_number[$key] * $lstRoom->priceDefaultDiscount;
                }
            }
        }
        $user = $this->__checkUser();
        if ($hotel) {
            return view('frontend.yacht.book_room_yacht', compact('hotel', 'is_background', 'room_yacht', 'info_payment', 'total', 'user'));
        } else {
            return abort(404);
        }
    }

    public function book_room_in_yacht(Request $request)
    {
        // dd($request->all());
        $book_room_in_yacht = session()->all()['book_room_in_yacht'];
        // dd($book_room_in_yacht);
        $extraBed = $request->extraBed;
        $url_yacht = $book_room_in_yacht['url'];
        $array_room_hotel_id = $book_room_in_yacht['array_room'];
        $array_room_number = $book_room_in_yacht['array_number'];
        $start_date_hotel = $book_room_in_yacht['yacht_book_date'];
        $yacht_adultNum = $book_room_in_yacht['yacht_adultNum'];
        $yacht_childNum =   $book_room_in_yacht['yacht_childNum'];
        $yacht_childNum2 = $book_room_in_yacht['yacht_childNum2'];
        if (!$url_yacht || !$array_room_hotel_id || !$array_room_number || !$start_date_hotel) return redirect()->route('home');
        $data = [
            'url' => $url_yacht
        ];
        $hotel = CallApiSeverService::methodGet('api/yachts/guest/customer-getbyurl', $data);
        $room_hotel = [];
        foreach ($array_room_hotel_id as $key => $room_id) {
            foreach ($hotel->lstRoom as $lstRoom) {
                if ($lstRoom->id == $room_id) {
                    for ($i = 0; $i < $array_room_number[$key]; $i++) {
                        $room_hotel[] = (object) [
                            "id" => null,
                            "yachtId" => $hotel->id,
                            "customerId" =>  null,
                            "roomId" =>  $lstRoom->id,
                            "extraBed" => (int) $extraBed[$i],
                            "price" => $lstRoom->priceDefaultDiscount
                        ];
                    }
                }
            }
        }
        $full_name = $request->full_name;
        $data = [
            "id" => null,
            "yachtId" => $hotel->id,
            "gender" =>  (int) $request->gender,
            "fullName" => $full_name,
            "cityId" => (int) $request->city_id,
            "address" => $request->address,
            "phone" => $request->phone_number,
            "phoneOther" => null,
            "email" => $request->email,
            "description" => $request->content,
            "isInvoice" => "0", // 1: có lấy hóa đơn đỏ
            "taxCode" => null,
            "companyName" => null,
            "companyAddress" => null,
            "emailInvoice" => null,
            "paymentMethod" => (int) $request->payment_method,
            "userId" => "",
            "checkInStr" => $start_date_hotel,
            "adultNum" => (int) $yacht_adultNum,
            "childNum" => (int) $yacht_childNum,
            "childNum2" => (int) $yacht_childNum2,
            "lstRoom" => $room_hotel
        ];
        $result = CallApiSeverService::methodPostJson('api/yacht-customers/guest/order', $data);
        // dd($result);
        $result = (object) [
            'status' => 201
        ];
        $user = $this->__checkUser();
        if ($result->status === 201) {
            session()->flush();
            return view('frontend.success', compact('full_name', 'user'));
        } else {
            return view('frontend.fail', compact('full_name', 'user'));
        }
    }
}
