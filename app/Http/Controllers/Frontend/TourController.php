<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CallApiSeverService;
use Illuminate\Http\Request;

class TourController extends Controller
{
    protected const perPage = 10;

    public function __construct()
    {
        $list_place_tour = null;
        $list_place_tour = CallApiSeverService::methodGet('api/guest/places', []);
        // if ($place_tour) {
        //     foreach ($place_tour->regionDtos as $row) {
        //         foreach ($row->placesDto as $value) {
        //             $list_place_tour[] = $value;
        //         }
        //     }
        // }
        \View::share('list_place_tour', $list_place_tour);
    }

    public static function __checkUser()
    {
        $token = \Session::get('token');
        $email = \Session::get('email');
        $user = null;
        if ($email && $token) $user = CallApiSeverService::methodGet('api/app-users/get-profile-by-login', ['login' => $email], $token);
        return $user;
    }

    public function post_search_tour(Request $request)
    {
        $info = $request->all();
        // dd($info);
        session()->put('info-tour', $info);
        $page = 0;
        $data = [
            'departurePlaceId' => $info['tour_place_start'],
            'placeId' => $info['tour_place_end'],
            'page' => $page,
            'itemPerPage' => self::perPage,
        ];
        // dd($data);
        $list_tour = CallApiSeverService::methodGet('api/tours/guest/searchTour', $data);
        $list_filter = CallApiSeverService::methodGet('api/tours/guest/filter', []);
        // dd($list_tour);

        $user = $this->__checkUser();
        $totalPage = ceil($list_tour->total / self::perPage);

        return view('frontend.tour.list_tour', compact('list_tour', 'list_filter', 'info', 'user', 'page', 'totalPage'));
    }

    public function ajax_tour(Request $request)
    {
        $filter = $request->all();
        $info = session()->all()['info-tour'];

        $placeId = $filter['placeId'];
        if ($placeId == null) {
            $placeId = $info['tour_place_end'];
        }

        $page = (int) $request->page ?: 0;

        $data = [
            'departurePlaceId' => $info['tour_place_start'],
            'placeId' => $placeId,
            'dayNum' => $filter['dayNum'],
            'orderBy' => $filter['orderBy'],
            'continentId' => $filter['continentId'],
            'tourCategoryId' => $filter['tourCategory'],
            'tourTypeId' => $filter['tourType'],
            'tourActionId' => $filter['actionType'],
            'tourName' => $filter['tourName'],
            'page' => $page,
            'itemPerPage' => self::perPage,
        ];

        // dd($data);

        $list_tour = CallApiSeverService::methodGet('api/tours/guest/searchTour', $data);
        // dd($list_tour);
        $totalPage = (int) ceil($list_tour->total / self::perPage);

        $apiFormat = [];
        $apiFormat['data'] = view('frontend.block.tour.ajax_tour', compact('list_tour'))->render();
        $apiFormat['pagination'] = view('frontend.block.common.pagination', compact('page', 'totalPage'))->render();
        // dd(response()->json($apiFormat));
        return response()->json($apiFormat);
    }

    public function detail_tour($slug)
    {
        $info = session()->all()['info-tour'];
        //dd($slug);
        $data = [
            //'url' => $slug
        ];
        $tour = CallApiSeverService::methodGet('api/tours/detail/' . $slug, $data);
        $user = $this->__checkUser();
        //dd($tour);
        if ($tour) {
            return view('frontend.tour.detail', compact('tour', 'user', 'info'));
        } else {
            return abort(404);
        }
    }

    public function tour_booking($slug)
    {
        $user = $this->__checkUser();
        $data = [
            //'url' => $slug
        ];
        $is_background = 1;
        $tour = CallApiSeverService::methodGet('api/tours/detail/' . $slug, $data);
        return view('frontend.tour.book_tour', compact('is_background', 'tour', 'user'));
    }

    public function post_book_tour(Request $request)
    {
        //dd($request->all());
        $full_name = $request->full_name;
        $tourPriceId = (int) $request->comboPrice;
        $is_invoice = "0";
        if ($request->has('is_vat')) $is_invoice = "1";
        $tour = CallApiSeverService::methodGet('api/tours/detail/' . $request->tour_url, []);
        $adultNum = (int) $request->number_adultNum;
        $number_childNum = (int) $request->number_childNum;
        $number_childNum2 = (int) $request->number_childNum2;
        $total = 0;
        $startDate = '';
        foreach ($tour->tourPrices as $tourPrices) {
            if ($tourPriceId == $tourPrices->id) {
                if ($tourPrices->percentDiscount != 0 || $tourPrices->percentDiscount != null) {
                    $price_adultNum = $tourPrices->price * (1 - $tourPrices->percentDiscount / 100) * $adultNum;
                    $price_childNum = $tourPrices->priceChild * (1 - $tourPrices->percentDiscount / 100) * $number_childNum;
                    $price_childNum2 = $tourPrices->priceChild2 * (1 - $tourPrices->percentDiscount / 100) * $number_childNum2;
                } else {
                    $price_adultNum = $tourPrices->price * $adultNum;
                    $price_childNum = $tourPrices->priceChild * $number_childNum;
                    $price_childNum2 = $tourPrices->priceChild2 * $number_childNum2;
                }
                $total = $price_adultNum + $price_childNum + $price_childNum2;
                $startDate = $tourPrices->startDate;
            }
        }
        $proclaimedTitle = $request->gender;
        if ($proclaimedTitle == "1" || $proclaimedTitle == "3") {
            $gender = 1;
        } else {
            $gender = 2;
        }
        $tourCustomerLists = [];
        if ($request->has('is_list_customer')) {
            for ($i = 0; $i < ($adultNum + $number_childNum + $number_childNum2); $i++) {
                $proclaimed_title = $request->customer_gender[$i];
                $fullName = $request->customer_name[$i];
                $email = $request->customer_mail[$i];
                if ($proclaimed_title == "1" || $proclaimed_title == "3") {
                    $gender = 1;
                } else {
                    $gender = 2;
                }
                $tourCustomerLists[] = (object) [
                    "proclaimedTitle" => $proclaimed_title,
                    "sex" => $gender,
                    "fullName" => $fullName,
                    "birthday" => "",
                    "address" => "",
                ];
            }
        }
        $data = [
            "tourId" => $tour->id,
            "tourPriceId" => $tourPriceId,
            "tourName" => $tour->title,
            "tourCode" => $tour->code,
            "fullName" => $full_name,
            //"cityId" => (int) $request->city_id,
            "address" => $request->address,
            "phoneNumber" => $request->phone_number,
            "email" => $request->email,
            "message" => $request->content,
            "isInvoice" => $is_invoice, // 1: có lấy hóa đơn đỏ
            "taxCode" => $is_invoice == "1" ? $request->tax_code : null,
            "companyName" => $is_invoice == "1" ? $request->company_name : null,
            "companyAddress" => $is_invoice == "1" ? $request->company_address : null,
            "emailInvoice" => null,
            "paymentMethod" => (int) $request->payment_method,
            "userId" => "",
            "proclaimedTitle" => $proclaimedTitle,
            "sex" => $gender,
            "startDate" => $startDate,
            "total" => $total,
            "adultNum" => (int) $adultNum,
            "childrenNum" => (int) $number_childNum,
            "childrenNum2" => (int) $number_childNum2,
            "emailLogin" => null,
            'birthday' => null,
            'tourCustomerLists' => $tourCustomerLists,
            'countryId' => "",
            'userIdShare' => null
        ];
        // dd($data);
        $result = CallApiSeverService::methodPostJson('api/tour-customers/guest', $data);
        // $result = (object) [
        //     'status' => 201
        // ];
        // dd($result);
        $user = $this->__checkUser();
        if ($result->status === 201 || $result->status === 200) {
            session()->flush();
            return view('frontend.success', compact('full_name', 'user'));
        } else {
            return view('frontend.fail', compact('full_name', 'user'));
        }
    }
}
