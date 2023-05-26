<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CallApiSeverService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SeaPlaneController extends Controller
{
    public function __construct()
    {
        $list_place_seaplane = CallApiSeverService::methodGet('api/seaplane-places/guest', []);
        \View::share('list_place_seaplane', $list_place_seaplane);
        $policies = CallApiSeverService::methodGet('api/seaplanes/guest/policy', []);
        \View::share('policies', $policies);
    }

    public static function __checkUser()
    {
        $token = \Session::get('token');
        $email = \Session::get('email');
        $user = null;
        if ($email && $token) $user = CallApiSeverService::methodGet('api/app-users/get-profile-by-login', ['login' => $email], $token);
        return $user;
    }

    public static function list_day($day)
    {
        $list_days[] = [
            'full_day' => Carbon::createFromFormat('d/m/Y', $day)->subDays(2)->format('d/m/Y'),
            'day' => Carbon::createFromFormat('d/m/Y', $day)->subDays(2)->format('d/m'),
            'stuff' => self::stuff(Carbon::createFromFormat('d/m/Y', $day)->subDays(2)->format('l')),
            'status' => 0
        ];
        $list_days[] = [
            'full_day' => Carbon::createFromFormat('d/m/Y', $day)->subDays(1)->format('d/m/Y'),
            'day' => Carbon::createFromFormat('d/m/Y', $day)->subDays(1)->format('d/m'),
            'stuff' => self::stuff(Carbon::createFromFormat('d/m/Y', $day)->subDays(1)->format('l')),
            'status' => 0
        ];
        $list_days[] = [
            'full_day' => Carbon::createFromFormat('d/m/Y', $day)->subDays(0)->format('d/m/Y'),
            'day' => Carbon::createFromFormat('d/m/Y', $day)->subDays(0)->format('d/m'),
            'stuff' => self::stuff(Carbon::createFromFormat('d/m/Y', $day)->subDays(0)->format('l')),
            'status' => 1
        ];
        $list_days[] = [
            'full_day' => Carbon::createFromFormat('d/m/Y', $day)->addDays(1)->format('d/m/Y'),
            'day' => Carbon::createFromFormat('d/m/Y', $day)->addDays(1)->format('d/m'),
            'stuff' => self::stuff(Carbon::createFromFormat('d/m/Y', $day)->addDays(1)->format('l')),
            'status' => 0
        ];
        $list_days[] = [
            'full_day' => Carbon::createFromFormat('d/m/Y', $day)->addDays(2)->format('d/m/Y'),
            'day' => Carbon::createFromFormat('d/m/Y', $day)->addDays(2)->format('d/m'),
            'stuff' => self::stuff(Carbon::createFromFormat('d/m/Y', $day)->addDays(2)->format('l')),
            'status' => 0
        ];
        return $list_days;
    }

    public static function stuff($stuff)
    {
        switch ($stuff) {
            case ('Monday'):
                return 'Thứ hai';
                break;
            case ('Tuesday'):
                return 'Thứ ba';
                break;
            case ('Wednesday'):
                return 'Thứ tư';
                break;
            case ('Thursday'):
                return 'Thứ năm';
                break;
            case ('Friday'):
                return 'Thứ sáu';
                break;
            case ('Saturday'):
                return 'Thứ bảy';
                break;
            default:
                return 'Chủ nhật';
        }
    }
    public function post_search_seaplane(Request $request)
    {
        // dd($request->all());
        $info = $request->all();
        session()->put('info-seaPlane', $info);

        $adt = (int) $request->seaplane_adultNum;
        $chd = (int) $request->seaplane_childNum;
        $inf = (int) $request->seaplane_childNum2;
        $startPlace = (int) $request->startPlace;
        $startDate = $request->startDate;
        $endPlace = (int) $request->endPlace;
        $data = [
            'endPlace' => $endPlace,
            'startDate' => $startDate,
            'startPlace' => $startPlace,
            'adt' => $adt,
            'chd' => $chd,
            'inf' => $inf,
        ];
        // dd($data);
        $list_seaplane = CallApiSeverService::methodGet('api/seaplanes/guest', $data);
        $list_place_seaplane = CallApiSeverService::methodGet('api/seaplane-places/guest', []);
        //dd($list_place_seaplane);
        $place = null;
        if ($list_place_seaplane != 400 || $list_place_seaplane != 500) {
            foreach ($list_place_seaplane as $list) {
                if ($startPlace === $list->id) {
                    $place[] = $list;
                }
                if ($endPlace === $list->id) {
                    $place[] = $list;
                }
            }
        }
        $list_days = $this->list_day($request->startDate);
        $user = $this->__checkUser();
        //dd($endPlace, $data, $place);
        return view('frontend.seaplane.list_seaplane', compact('place', 'list_seaplane', 'info', 'user', 'list_days'));
    }

    public function ajax_seaPlane(Request $request)
    {
        //dd($request->all());
        session()->put('info-seaPlane', $request->all());

        $data = [
            'endPlace' => (int) $request->endPlace,
            'startDate' => $request->startDate,
            'startPlace' => (int) $request->startPlace,
            'inf' => (int) $request->seaplane_childNum2,
            'chd' => (int) $request->seaplane_childNum,
            'adt' => (int) $request->seaplane_adultNum,
        ];
        // dd($data);
        $list_seaplane = CallApiSeverService::methodGet('api/seaplanes/guest', $data);
        //dd($data, $list_seaplane);
        $apiFormat = [];
        $apiFormat['data'] = view('frontend.block.ajax_seaplane', compact('list_seaplane'))->render();
        return response()->json($apiFormat);
    }

    public function book_seaplane($slug)
    {
        //dd($slug);
        $info = session()->all()['info-seaPlane'];
        // dd($info);

        $data = [
            'fareDataId' => $slug
        ];
        $seaplane = CallApiSeverService::methodGet('api/seaplanes/guest/detail', $data);
        //dd($seaplane);
        $user = $this->__checkUser();
        $is_background = 1;
        if ($seaplane) {
            return view('frontend.seaplane.book_seaplane', compact('seaplane', 'user', 'is_background', 'info'));
        } else {
            return abort(404);
        }
    }

    public function post_book_seaplane(Request $request)
    {
        //dd($request->all());
        $number_adt = (int) $request->number_adt;
        $number_chd =  (int) $request->number_chd;
        $isInvoice = '0';
        $taxCode = null;
        $companyName = null;
        $companyAddress = null;
        $emailInvoice = null;
        $passengers = [];
        if ($request->has('is_vat')) {
            $isInvoice = '1';
            $taxCode = $request->tax_code;
            $companyName = $request->company_name;
            $companyAddress = $request->company_address;
        }
        if ($request->has('is_list_customer')) {
            for ($i = 0; $i < ($number_chd + $number_adt); $i++) {
                $proclaimedTitle = $request->customer_gender[$i];
                $fullName = $request->customer_name[$i];
                $phoneNumber = $request->customer_phone[$i];
                $email = $request->customer_mail[$i];
                if ($proclaimedTitle == "1" || $proclaimedTitle == "3") {
                    $gender = 1;
                } else {
                    $gender = 0;
                }
                $passengers[] = (object) [
                    "proclaimedTitle" => $proclaimedTitle,
                    "gender" => $gender,
                    "fullName" => $fullName,
                    "birthday" => "",
                    "address" => "",
                    "phoneNumber" => $phoneNumber,
                    "email" => $email
                ];
            }
        }
        $full_name = $request->full_name;
        $data = [
            'adt' => $number_adt,
            'chd' => $number_chd,
            'seaplaneId' => (int) $request->seaplane_id,
            //"gender" =>  (int) $request->gender,
            "fullName" => $full_name,
            "address" => $request->address,
            "phone" => $request->phone_number,
            "email" => $request->email,
            //"description" => $request->content,
            "isInvoice" => $isInvoice, // 1: có lấy hóa đơn đỏ
            "taxCode" => $taxCode,
            "companyName" => $companyName,
            "companyAddress" => $companyAddress,
            "emailInvoice" => $emailInvoice,
            //"paymentMethod" => (int) $request->payment_method,
            //"userId" => "",
            'passengers' => $passengers
        ];
        // dd($data);
        $result = CallApiSeverService::methodPostJson('api/seaplanes/guest/book', $data);
        // dd($result);
        // $result = (object) [
        //     'status' => 201
        // ];
        $user = $this->__checkUser();
        if ($result->status === 201 || $result->status === 200) {
            session()->flush();
            return view('frontend.success', compact('full_name', 'user'));
        } else {
            return view('frontend.fail', compact('full_name', 'user'));
        }
    }
}
