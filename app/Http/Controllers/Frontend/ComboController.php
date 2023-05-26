<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\CommonFunctions;
use App\Http\Controllers\Controller;
use App\Services\CallApiSeverService;
use Illuminate\Http\Request;

class ComboController extends Controller
{
    // public function __construct()
    // {
    //     $list_place_tour = CallApiSeverService::methodGet('api/guest/places', []);
    //     \View::share('list_place_tour', $list_place_tour);
    // }
    protected const perPage = 10;

    public static function __checkUser()
    {
        $token = \Session::get('token');
        $email = \Session::get('email');
        $user = null;
        if ($email && $token) $user = CallApiSeverService::methodGet('api/app-users/get-profile-by-login', ['login' => $email], $token);
        return $user;
    }

    public function post_search_combo(Request $request)
    {
        //dd($request->all());
        $info = $request->all();
        session()->put('info-combo', $info);

        $combo_place_end = (int) $request->combo_place_end;
        $combo_place_start = (int) $request->combo_place_start;
        $page = $request->page ?: 0;
        $data = [
            'placeId' => $combo_place_start,
            'departurePlaceId' => $combo_place_end,
            'page' => $page,
            'itemPerPage' => self::perPage,
        ];
        $list_combo = CallApiSeverService::methodGet('api/combo/guest/search', $data);
        $list_place_combo = CallApiSeverService::methodGet('api/guest/places', []);
        $list_filter = CallApiSeverService::methodGet('api/tours/guest/filter', []);
        //dd($list_combo);
        $user = $this->__checkUser();
        $totalPage = ceil($list_combo->total / self::perPage);
        // dd($list_combo, $data );
        // dd($info);
        return view('frontend.combo.list_combo', compact('list_combo', 'info', 'user', 'list_filter', 'page', 'totalPage'));
    }

    public function ajax_combo(Request $request)
    {
        $filter = $request->all();
        $info = session()->all()['info-combo'];

        //   "_token" => "sLJztkXALHtqvYdrG7ybSm3QzLVyKKSjEKTxOygo"
        //   "combo_adultNum" => "1"
        //   "combo_childNum" => "0"
        //   "combo_childNum2" => "0"
        //   "combo_place_end" => "1"
        //   "combo_date" => "04/04/2023"
        //   "combo_place_start" => "1"

        $placeId = $filter['placeId'];
        if ($placeId == null) {
            $placeId = $info['combo_place_end'];
        }

        $page = (int) $request->page ?: 0;

        $data = [
            'placeId' => $placeId,
            'continentId' => $filter['continentId'],
            'dayNum' => $filter['dayNum'],
            'departurePlaceId' => $info['combo_place_start'],
            'comboName' => $filter['comboName'],
            'type' => $filter['type'],
            'orderBy' => $filter['orderBy'],
            'page' => $page,
            'itemPerPage' => self::perPage,
        ];

        // dd($data);

        $list_combo = CallApiSeverService::methodGet('api/combo/guest/search', $data);
        // dd($list_combo);
        $totalPage = (int) ceil($list_combo->total / self::perPage);

        $apiFormat = [];
        $apiFormat['data'] = view('frontend.block.combo.ajax_combo', compact('list_combo'))->render();
        $apiFormat['pagination'] = view('frontend.block.common.pagination', compact('page', 'totalPage'))->render();
        // dd(response()->json($apiFormat));
        return response()->json($apiFormat);
    }

    public function detailCombo($slug)
    {
        $info = session()->all()['info-combo'];
        // dd($info);
        $combo = CallApiSeverService::methodGet('api/combo/guest/detail/' . $slug);
        $user = $this->__checkUser();
        //dd($combo);
        if ($combo) {
            return view('frontend.combo.detail', compact('combo', 'user', 'info'));
        } else {
            return abort(404);
        }
    }

    public function book_combo($slug)
    {
        $is_background = 1;
        $data = [
            //'url' => $slug
        ];
        $combo = CallApiSeverService::methodGet('api/combo/guest/detail/' . $slug, $data);
        $user = $this->__checkUser();
        //dd($combo);
        if ($combo) {
            return view('frontend.combo.book_combo', compact('combo', 'user', 'is_background'));
        } else {
            return abort(404);
        }
    }

    public function post_book_combo(Request $request)
    {
        //dd($request->all());
        $full_name = $request->full_name;
        $combo_priceId = (int) $request->comboPrice;
        $is_invoice = "0";
        if ($request->has('is_vat')) $is_invoice = "1";
        $combo = CallApiSeverService::methodGet('api/combo/guest/detail/' . $request->combo_url, []);
        $adultNum = (int) $request->number_adultNum;
        $number_childNum = (int) $request->number_childNum;
        $number_childNum2 = (int) $request->number_childNum2;
        $total = 0;
        $startDate = '';
        foreach ($combo->comboPrice as $comboPrice) {
            if ($combo_priceId == $comboPrice->id) {
                if ($comboPrice->priceDisplay != 0 || $comboPrice->priceDisplay != null) {
                    $total = $comboPrice->priceDisplay * $adultNum + $number_childNum * $comboPrice->priceYoung + $comboPrice->priceChildren * $number_childNum2;
                } else {
                    $total = $comboPrice->price * $adultNum + $number_childNum * $comboPrice->priceYoung + $comboPrice->priceChildren * $number_childNum2;
                }
                $startDate = CommonFunctions::convertTime($comboPrice->startDate);
            }
        }
        $data = [
            "id" => null,
            "comboId" => $combo->id,
            "comboPriceId" => $combo_priceId,
            "comboName" => $combo->title,
            "fullName" => $full_name,
            "address" => $request->address,
            "phoneNumber" => $request->phone_number,
            "email" => $request->email,
            "description" => $request->content,
            "isInvoice" => $is_invoice, // 1: có lấy hóa đơn đỏ
            "taxCode" => $is_invoice == "1" ? $request->tax_code : null,
            "companyName" => $is_invoice == "1" ? $request->company_name : null,
            "companyAddress" => $is_invoice == "1" ? $request->company_address : null,
            "emailInvoice" => null,
            "paymentMethod" => (int) $request->payment_method,
            "userId" => "",
            "proclaimedTitle" => (int) $request->gender,
            "startDate" => $startDate,
            "total" => $total,
            "adultNum" => (int) $adultNum,
            "childNum" => (int) $number_childNum,
            "childNum2" => (int) $number_childNum2,
            "emailLogin" => null
        ];
        //dd($data);
        $result = CallApiSeverService::methodPostJson('api/combo-customer/guest/order', $data);
        //dd($result);
        // $result = (object) [
        //     'status' => 201
        // ];
        $user = $this->__checkUser();
        if ($result->status === 201 || $result->status == 200) {
            return view('frontend.success', compact('full_name', 'user'));
        } else {
            return view('frontend.fail', compact('full_name', 'user'));
        }
    }
}
