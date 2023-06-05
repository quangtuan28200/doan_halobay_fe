<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Amlich;
use App\Helpers\CommonFunctions;
use App\Http\Controllers\Controller;
use App\Services\CallApiSeverService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class FlightController extends Controller
{
    public function __construct()
    {
        $list_place_flight = CallApiSeverService::methodGet('tk/client/search-place', [])->cate;
        // dd($list_place_flight);
        View::share('list_place_flight', $list_place_flight);
    }

    public static function __checkUser()
    {
        $token = Session::get('token');
        $email = Session::get('email');
        $user = null;
        if ($email && $token) $user = CallApiSeverService::methodGet('api/app-users/get-profile-by-login', ['login' => $email], $token);
        return $user;
    }

    public function post_search_2_way_flight(Request $request)
    {
        //dd($request->all());
        $info = $request->all();
        $Adt = $request->two_way_adt ? (int) $request->two_way_adt : 1;
        $Chd = $request->two_way_chd ? (int) $request->two_way_chd : 0;
        $Inf = $request->two_way_inf ? (int) $request->two_way_inf : 0;
        $startPoint = $request->begin_place_2_way;
        $endPoint = $request->end_place_2_way;
        $start_date = Carbon::createFromFormat('d/m/Y', $request->two_way_start_date);
        $end_date = Carbon::createFromFormat('d/m/Y', $request->two_way_end_date);
        $Airline = '';
        $ListFlight = [
            [
                "startPoint" => $startPoint,
                "endPoint" => $endPoint,
                "departDate" => $start_date->format('dmY'),
                "airline" => $Airline
            ],
            [
                "startPoint" => $startPoint,
                "endPoint" => $endPoint,
                "departDate" => $start_date->format('dmY'),
                "airline" => $Airline
            ]
        ];
        $data = [
            'adt' => $Adt,
            'chd' => $Chd,
            'inf' => $Inf,
            'viewMode' => "",
            'listFlight' => $ListFlight
        ];
        // dd($data);
        $list_flight = CallApiSeverService::methodPostJson('api/flights/guest/search', $data);
        // dd($list_flight);
        $list_place = CallApiSeverService::methodGet('tk/client/search-place', []);
        $lists = [];
        $array = [];
        //dd($list_flight->data->listFareData);
        if ($list_place->code == 1) {
            foreach ($list_place->cate as $cate) {
                foreach ($cate->sub_list as $place) {
                    if ($place->code == $startPoint) {
                        $lists[0]['info']['startPoint'] = $place->name;
                        $lists[1]['info']['endPoint'] = $place->name;
                        $lists[0]['info']['date'] = 'Ngày ' . $start_date->format('d/m/Y') . ', tức ' . Amlich::convertSolar2Lunar($start_date, 7);
                        $lists[0]['info']['list_days'] = CommonFunctions::list_day($request->two_way_start_date, $startPoint, $endPoint, '');
                    }
                    if ($place->code == $endPoint) {
                        $lists[0]['info']['endPoint'] = $place->name;
                        $lists[1]['info']['startPoint'] = $place->name;
                        $lists[1]['info']['date'] = 'Ngày ' . $end_date->format('d/m/Y') . ', tức ' . Amlich::convertSolar2Lunar($end_date, 7);
                        $lists[1]['info']['list_days'] = CommonFunctions::list_day($request->two_way_end_date, $startPoint, $endPoint, '');
                    }
                }
            }
            if ($list_flight->data->status === true) {
                // foreach (Session::get('flights') as $flight) {
                //     if ($flight->leg == 0) $lists[0]['list_flight'][] = $flight;
                //     if ($flight->leg == 1) $lists[1]['list_flight'][] = $flight;
                // }
                foreach ($list_flight->data->listFareData as $flight) {
                    if ($flight->leg == 0) $lists[0]['list_flight'][] = $flight;
                    if ($flight->leg == 1) $lists[1]['list_flight'][] = $flight;
                }
            }
        }
        Session::put('flights', $list_flight->data);
        // dd($list_flight, $list_place);
        $user = $this->__checkUser();
        // if (!$list_flight->data->status) {
        //     $lists['']
        // }
        $session = $list_flight->data->session;
        // dd($info);
        return view('frontend.flight.list_flight', compact('lists', 'session', 'info', 'user'));
    }

    public function ajax_data_flight(Request $request)
    {
        //dd($request->all());
        $apiFormat = [];
        $apiFormat['status'] = 0;
        $info = $request->all();
        $Adt = $request->two_way_adt ? (int) $request->two_way_adt : 1;
        $Chd = $request->two_way_chd ? (int) $request->two_way_chd : 0;
        $Inf = $request->two_way_inf ? (int) $request->two_way_inf : 0;
        $startPoint = $request->begin_place_2_way;
        $endPoint = $request->end_place_2_way;
        $start_date = Carbon::createFromFormat('d/m/Y', $request->two_way_start_date);
        $end_date = Carbon::createFromFormat('d/m/Y', $request->two_way_end_date);
        if ($end_date->lt($start_date)) {
            $apiFormat['data'] = "Ngày trở về không thể nhỏ hơn ngày khởi hành";
            return response()->json($apiFormat);
        }
        if ($start_date->gt($end_date)) {
            $apiFormat['data'] = "Ngày khởi hành không thể lớn hơn ngày trở về";
            return response()->json($apiFormat);
        }
        $Airline = 'VJ';
        if ($request->airline_company != '0') $Airline = $request->airline_company;
        $ListFlight = [
            [
                "StartPoint" => $startPoint,
                "EndPoint" => $endPoint,
                "DepartDate" => $start_date->format('dmY'),
                "Airline" => $Airline
            ],
            [
                "StartPoint" => $endPoint,
                "EndPoint" => $startPoint,
                "DepartDate" => $end_date->format('dmY'),
                "Airline" => $Airline
            ]
        ];
        $data = [
            'Adt' => $Adt,
            'Chd' => $Chd,
            'Inf' => $Inf,
            'ViewMode' => "",
            'ListFlight' => $ListFlight
        ];
        //if ($request->airline_company != '0') $list_flight = CallApiSeverService::methodPostJson('api/flights/guest/search', $data)->data;
        $list_place = CallApiSeverService::methodGet('tk/client/search-place', []);
        $lists = [];
        $array = [];
        if ($list_place->code == 1) {
            foreach ($list_place->cate as $cate) {
                foreach ($cate->sub_list as $place) {
                    if ($place->code == $startPoint) {
                        $lists[0]['info']['startPoint'] = $place->name;
                        $lists[1]['info']['endPoint'] = $place->name;
                        $lists[0]['info']['date'] = 'Ngày ' . $start_date->format('d/m/Y') . ', tức ' . Amlich::convertSolar2Lunar($start_date, 7);
                        $lists[0]['info']['list_days'] = CommonFunctions::list_day($request->two_way_start_date, $startPoint, $endPoint, '');
                    }
                    if ($place->code == $endPoint) {
                        $lists[0]['info']['endPoint'] = $place->name;
                        $lists[1]['info']['startPoint'] = $place->name;
                        $lists[1]['info']['date'] = 'Ngày ' . $end_date->format('d/m/Y') . ', tức ' . Amlich::convertSolar2Lunar($end_date, 7);
                        $lists[1]['info']['list_days'] = CommonFunctions::list_day($request->two_way_start_date, $startPoint, $endPoint, '');
                    }
                }
            }
            if (Session::has('flights') && $request->airline_company == '0') {
                $list_flight = Session::get('flights');
            } else {
                $list_flight = CallApiSeverService::methodPostJson('api/flights/guest/search', $data)->data;
            }
            if (isset($list_flight) && $list_flight->listFareData != null) {
                foreach ($list_flight->listFareData as $flight) {
                    $start_time = Carbon::parse($flight->listFlight[0]->startDate)->format('H:i:s');
                    $firstDateTime = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 ' . $start_time);
                    if ($flight->leg == 0) {
                        if ($request->timer == "1") {
                            $firstDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 00:00:00');
                            $lastDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 04:59:59');
                            if ($firstDateTime->gte($firstDateTime_check) && $firstDateTime->lte($lastDateTime_check)) {
                                $lists[0]['list_flight'][] = $flight;
                            }
                        } else if ($request->timer == "2") {
                            $firstDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 05:00:00');
                            $lastDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 11:59:59');
                            if ($firstDateTime->gte($firstDateTime_check) && $firstDateTime->lte($lastDateTime_check)) {
                                $lists[0]['list_flight'][] = $flight;
                            }
                        } else if ($request->timer == "3") {
                            $firstDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 12:00:00');
                            $lastDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 17:59:59');
                            if ($firstDateTime->gte($firstDateTime_check) && $firstDateTime->lte($lastDateTime_check)) {
                                $lists[0]['list_flight'][] = $flight;
                            }
                        } else if ($request->timer == "4") {
                            $firstDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 18:00:00');
                            $lastDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 23:59:59');
                            if ($firstDateTime->gte($firstDateTime_check) && $firstDateTime->lte($lastDateTime_check)) {
                                $lists[0]['list_flight'][] = $flight;
                            }
                        } else {
                            $lists[0]['list_flight'][] = $flight;
                        }
                    }
                    if ($flight->leg == 1) {
                        if ($request->timer == "1") {
                            $firstDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 00:00:00');
                            $lastDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 04:59:59');
                            if ($firstDateTime->gte($firstDateTime_check) && $firstDateTime->lte($lastDateTime_check)) {
                                $lists[1]['list_flight'][] = $flight;
                            }
                        } else if ($request->timer == "2") {
                            $firstDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 05:00:00');
                            $lastDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 11:59:59');
                            if ($firstDateTime->gte($firstDateTime_check) && $firstDateTime->lte($lastDateTime_check)) {
                                $lists[1]['list_flight'][] = $flight;
                            }
                        } else if ($request->timer == "3") {
                            $firstDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 12:00:00');
                            $lastDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 17:59:59');
                            if ($firstDateTime->gte($firstDateTime_check) && $firstDateTime->lte($lastDateTime_check)) {
                                $lists[1]['list_flight'][] = $flight;
                            }
                        } else if ($request->timer == "4") {
                            $firstDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 18:00:00');
                            $lastDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 23:59:59');
                            if ($firstDateTime->gte($firstDateTime_check) && $firstDateTime->lte($lastDateTime_check)) {
                                $lists[1]['list_flight'][] = $flight;
                            }
                        } else {
                            $lists[1]['list_flight'][] = $flight;
                        }
                    }
                }
            }
            $session = $list_flight->session;
        }
        if ($request->orderBy == '1') {
            if (isset($lists[0]['list_flight'])) {
                usort($lists[0]['list_flight'], function ($a, $b) {
                    if ($a->fareAdt == $b->fareAdt) {
                        return 0;
                    } else {
                        return ($a->fareAdt > $b->fareAdt) ? -1 : 1;
                    }
                });
            }
            if (isset($lists[1]['list_flight'])) {
                usort($lists[1]['list_flight'], function ($a, $b) {
                    if ($a->fareAdt == $b->fareAdt) {
                        return 0;
                    } else {
                        return ($a->fareAdt > $b->fareAdt) ? -1 : 1;
                    }
                });
            }
        } else if ($request->orderBy == '2') {
            if (isset($lists[0]['list_flight'])) {
                usort($lists[0]['list_flight'], function ($a, $b) {
                    if ($a->fareAdt == $b->fareAdt) {
                        return 0;
                    } else {
                        return ($a->fareAdt > $b->fareAdt) ? 1 : -1;
                    }
                });
            }
            if (isset($lists[1]['list_flight'])) {
                usort($lists[1]['list_flight'], function ($a, $b) {
                    if ($a->fareAdt == $b->fareAdt) {
                        return 0;
                    } else {
                        return ($a->fareAdt > $b->fareAdt) ? 1 : -1;
                    }
                });
            }
        } else if ($request->orderBy == '3') {
            if (isset($lists[0]['list_flight'])) {
                usort($lists[0]['list_flight'], function ($a, $b) {
                    if (Carbon::parse($a->listFlight[0]->startDate)->lte(Carbon::parse($b->listFlight[0]->startDate))) {
                        return 0;
                    } else {
                        return 1;
                    }
                });
            }
            if (isset($lists[1]['list_flight'])) {
                usort($lists[1]['list_flight'], function ($a, $b) {
                    if (Carbon::parse($a->listFlight[0]->startDate)->lte(Carbon::parse($b->listFlight[0]->startDate))) {
                        return 0;
                    } else {
                        return 1;
                    }
                });
            }
        }
        $view_mode = $request->view_mode;

        $apiFormat['status'] = 1;
        $apiFormat['data'] = view('frontend.block.ajax_data_flight', compact('lists', 'info', 'session', 'view_mode'))->render();
        return response()->json($apiFormat);
    }

    public function get_flight_two_booking(Request $request)
    {
        // dd($request->all());
        $data_one = [
            'session' => $request->form_session,
            'fareDataId' => $request->form_id
        ];
        $flight_one = CallApiSeverService::methodGet('api/flights/guest', $data_one);
        $flight_one->total_fee_service = ($flight_one->listFareData[0]->taxAdt + $flight_one->listFareData[0]->feeAdt + $flight_one->listFareData[0]->serviceFee) * $flight_one->listFareData[0]->adt + ($flight_one->listFareData[0]->taxChd + $flight_one->listFareData[0]->feeChd + $flight_one->listFareData[0]->serviceFee) * $flight_one->listFareData[0]->chd + ($flight_one->listFareData[0]->taxInf + $flight_one->listFareData[0]->feeInf + $flight_one->listFareData[0]->serviceFee) * $flight_one->listFareData[0]->inf;
        $flight_one->total = ($flight_one->listFareData[0]->fareAdt + $flight_one->listFareData[0]->taxAdt + $flight_one->listFareData[0]->feeAdt + $flight_one->listFareData[0]->serviceFee) * $flight_one->listFareData[0]->adt + ($flight_one->listFareData[0]->fareChd + $flight_one->listFareData[0]->taxChd + $flight_one->listFareData[0]->feeChd + $flight_one->listFareData[0]->serviceFee) * $flight_one->listFareData[0]->chd + ($flight_one->listFareData[0]->fareInf + $flight_one->listFareData[0]->taxInf + $flight_one->listFareData[0]->feeInf + $flight_one->listFareData[0]->serviceFee) * $flight_one->listFareData[0]->inf;
        $data_hand_bag_one[] = [
            "AutoIssue" => false,
            "FareDataId" => $request->form_id,
            "ListFlight" => [
                ["FlightValue" => $request->form_value]
            ],
            "Session" => $request->form_session
        ];
        $hand_bag_one = CallApiSeverService::methodGet('api/flights/guest/search-baggage/' . json_encode($data_hand_bag_one), []);
        $data_two = [
            'session' => $request->to_session,
            'fareDataId' => $request->to_id
        ];
        $flight_two = CallApiSeverService::methodGet('api/flights/guest', $data_two);
        $flight_two->total_fee_service = ($flight_two->listFareData[0]->taxAdt + $flight_two->listFareData[0]->feeAdt + $flight_two->listFareData[0]->serviceFee) * $flight_two->listFareData[0]->adt + ($flight_two->listFareData[0]->taxChd + $flight_two->listFareData[0]->feeChd + $flight_two->listFareData[0]->serviceFee) * $flight_two->listFareData[0]->chd + ($flight_two->listFareData[0]->taxInf + $flight_two->listFareData[0]->feeInf + $flight_two->listFareData[0]->serviceFee) * $flight_two->listFareData[0]->inf;
        $flight_two->total = ($flight_two->listFareData[0]->fareAdt + $flight_two->listFareData[0]->taxAdt + $flight_two->listFareData[0]->feeAdt + $flight_two->listFareData[0]->serviceFee) * $flight_two->listFareData[0]->adt + ($flight_two->listFareData[0]->fareChd + $flight_two->listFareData[0]->taxChd + $flight_two->listFareData[0]->feeChd + $flight_two->listFareData[0]->serviceFee) * $flight_two->listFareData[0]->chd + ($flight_two->listFareData[0]->fareInf + $flight_two->listFareData[0]->taxInf + $flight_two->listFareData[0]->feeInf + $flight_two->listFareData[0]->serviceFee) * $flight_two->listFareData[0]->inf;
        $data_hand_bag_two[] = [
            "AutoIssue" => false,
            "FareDataId" => $request->to_id,
            "ListFlight" => [
                ["FlightValue" => $request->to_value]
            ],
            "Session" => $request->to_session
        ];
        $hand_bag_two = CallApiSeverService::methodGet('api/flights/guest/search-baggage/' . json_encode($data_hand_bag_two), []);
        $user = $this->__checkUser();
        $is_background = 1;
        $list_place = CallApiSeverService::methodGet('tk/client/search-place', []);
        if ($list_place->code == 1) {
            foreach ($list_place->cate as $cate) {
                foreach ($cate->sub_list as $place) {
                    if ($place->code == $flight_one->listFareData[0]->listFlight[0]->startPoint) {
                        $lists[0]['startPoint'] = $place->name;
                        $lists[1]['endPoint'] = $place->name;
                        $lists[0]['start_date'] = $flight_one->listFareData[0]->listFlight[0]->startDate;
                        $lists[0]['flightNumber'] = $flight_one->listFareData[0]->listFlight[0]->flightNumber;
                        $lists[0]['logo'] = $flight_one->listFareData[0]->listFlight[0]->icon;
                    }
                    if ($place->code == $flight_one->listFareData[0]->listFlight[0]->endPoint) {
                        $lists[0]['endPoint'] = $place->name;
                        $lists[1]['startPoint'] = $place->name;
                        $lists[1]['start_date'] = $flight_two->listFareData[0]->listFlight[0]->startDate;
                        $lists[1]['flightNumber'] = $flight_two->listFareData[0]->listFlight[0]->flightNumber;
                        $lists[1]['logo'] = $flight_two->listFareData[0]->listFlight[0]->icon;
                    }
                }
            }
        }
        $fare_conditions = CallApiSeverService::methodGet('api/guest/condition-price', []);
        //dd($flight_one, $hand_bag_one, $hand_bag_two);
        if ($hand_bag_one->status) {
            return view('frontend.flight.flight_two_detail', compact('flight_one', 'flight_two', 'hand_bag_one', 'hand_bag_two', 'user', 'is_background', 'lists', 'fare_conditions'));
        } else {
            return redirect()->route('home');
        }
    }

    public function book_flight_two(Request $request)
    {
        $ip = $request->ip();
        $listBaggage = [];
        foreach ($request->first_name as $key => $first_name) {
            if ($request->handbags_one[$key] != "0") {
                $handbags_one = explode('-', $request->handbags_one[$key]);
                $listBaggage[] = [
                    "Airline" => $handbags_one[0],
                    "Leg" => (int) $handbags_one[1],
                    "Route" => $handbags_one[2],
                    "Code" => $handbags_one[3],
                    "Currency" => $handbags_one[4],
                    "Name" => $handbags_one[5],
                    "Price" => (int) $handbags_one[6],
                    "Value" => $handbags_one[7]
                ];
            }
            if ($request->handbags_two[$key] != "0") {
                $handbags_two = explode('-', $request->handbags_two[$key]);
                $listBaggage[] = [
                    "Airline" => $handbags_two[0],
                    "Leg" => (int) $handbags_two[1],
                    "Route" => $handbags_two[2],
                    "Code" => $handbags_two[3],
                    "Currency" => $handbags_two[4],
                    "Name" => $handbags_two[5],
                    "Price" => (int) $handbags_two[6],
                    "Value" => $handbags_two[7]
                ];
            }
            $ListPassenger[] = [
                "Birthday" => "",
                "FirstName" => $first_name,
                "Gender" => $request->gender[$key] == '1' ? true : false,
                "Index" => $key,
                "LastName" => $request->last_name[$key],
                "Type" => $request->type[$key],
                "ListBaggage" => $listBaggage
            ];
        }
        $data = [
            "BookType" => "book-normal",
            "Contact" => [
                "Gender" => $request->contact_gender == '1' ? true : false,
                "FirstName" => $request->first_name_contact,
                "LastName" => $request->last_name_contact,
                "Phone" => $request->phone_number_contact,
                "Email" => $request->email_contact,
                "Address" => $request->address_contact ?: ""
            ],
            "Ip" => $ip,
            "ListFareData" => [
                [
                    "AutoIssue" => false,
                    "FareDataId" => (int) $request->flight_id_one,
                    "ListFlight" => [
                        [
                            "FlightValue" => $request->flight_value_one,
                            "Leg" => (int) $request->flight_leg_one
                        ]
                    ],
                    "Session" => $request->session
                ],
                [
                    "AutoIssue" => false,
                    "FareDataId" => (int) $request->flight_id_two,
                    "ListFlight" => [
                        [
                            "FlightValue" => $request->flight_value_two,
                            "Leg" => (int) $request->flight_leg_two
                        ]
                    ],
                    "Session" => $request->session
                ]
            ],
            "ListPassenger" => $ListPassenger,
            "Note" => "",
            "PaymentMethod" => $request->payment_method,
            "Remark" => "",
            "UseAgentContact" => true,
            "emailLogin" => "",
            "InvoiceDto" => [
                "address" =>  $request->company_address ?: "",
                "cityName" => "",
                "companyName" => $request->company_name ?: "",
                "email" => "",
                "receiver" => "",
                "taxCode" => $request->tax_code ?: "",
                "receiverAddress" => "",
                "receiverMethod" => "",
                "receiverPhone" => ""
            ]
        ];
        //dd(json_encode($data));
        $result = CallApiSeverService::methodPostJson('api/flights/guest/book', $data);
        $full_name = $request->first_name_contact . ' ' . $request->last_name_contact;
        $user = $this->__checkUser();
        if ($result->status != 200) {
            return view('frontend.fail', compact('full_name', 'user'));
        } else {
            if ($result->data->errorValue == 'FAIL') {
                return view('frontend.fail', compact('full_name', 'user'));
            } else {
                return view('frontend.success', compact('full_name', 'user'));
            }
        }
    }

    public function post_search_flight(Request $request)
    {
        // dd($request->all());
        $info = $request->all();
        $Adt = $request->two_way_adt ? (int) $request->two_way_adt : 1;
        $Chd = $request->way_chd ? (int) $request->way_chd : 0;
        $Inf = $request->two_way_inf ? (int) $request->two_way_inf : 0;
        $startPoint = $request->begin_place_2_way;
        $endPoint = $request->end_place_2_way;
        $start_date = Carbon::createFromFormat('d/m/Y', $request->way_start_date);
        $Airline = '';
        $ListFlight = [
            [
                "startPoint" => $startPoint,
                "endPoint" => $endPoint,
                "departDate" => $start_date->format('dmY'),
                "airline" => $Airline
            ]
        ];
        $data = [
            'adt' => $Adt,
            'chd' => $Chd,
            'inf' => $Inf,
            'viewMode' => "",
            'listFlight' => $ListFlight
        ];
        // dd($data);
        // $list_flight = CallApiSeverService::methodPostJson('api/flights/guest/search', $data);
        $list_flight = CallApiSeverService::methodPostJson('api/flights/guest/search/oneway', $data);
        // dd($list_flight);

        $data = [
            "status" => 200,
            "data" => [
                "flightType" => "Domestic",
                "session" => "FAKEDATA",
                "itinerary" => 1,
                "listFareData" => [
                    [
                        "fareDataId" => 1,
                        "airline" => "VN",
                        "leg" => 0,
                        "adt" => 2,
                        "chd" => 2,
                        "inf" => 2,
                        "fareAdt" => 1500000,
                        "fareChd" => 750000,
                        "fareInf" => 100000,
                        "taxAdt" => 150000,
                        "taxChd" => 75000,
                        "taxInf" => 10000,
                        "feeAdt" => 80000,
                        "feeChd" => 50000,
                        "feeInf" => 30000,
                        "serviceFee" => 100000,
                        "listFlight" => [
                            [
                                "flightId" => 1,
                                "icon" => "https://plugin.datacom.vn//Resources/Images/Airline/VN.gif",
                                "airline" => "VN",
                                "startPoint" => "HAN",
                                "endPoint" => "SGN",
                                "airPortStart" => "Nội Bài",
                                "airPortEnd" => "Tân Sơn Nhất",
                                "startDate" => "2019-04-09T19:49:45.889Z",
                                "endDate" => "2019-04-09T20:49:45.890Z",
                                "flightNumber" => "VN123",
                                "groupClass" => "Phổ thông",
                                "flightValue" => "",
                                "listSegment" => [
                                    [
                                        "id" => 1,
                                        "airline" => "VN",
                                        "startPoint" => "HAN",
                                        "endPoint" => "SGN",
                                        "startTime" => "2019-04-09T19:49:45.889Z",
                                        "endTime" => "2019-04-09T20:49:45.890Z",
                                        "flightNumber" => "VN123",
                                        "plane" => "330",
                                    ]
                                ]
                            ],
                        ]
                    ],
                    [
                        "fareDataId" => 1,
                        "airline" => "VJ",
                        "itinerary" => 1,
                        "leg" => 0,
                        "promo" => false,
                        "currency" => "VND",
                        "system" => "LCC",
                        "adt" => 1,
                        "chd" => 1,
                        "inf" => 1,
                        "fareAdt" => 1500000,
                        "fareChd" => 750000,
                        "fareInf" => 100000,
                        "taxAdt" => 150000,
                        "taxChd" => 75000,
                        "taxInf" => 10000,
                        "feeAdt" => 80000,
                        "feeChd" => 50000,
                        "feeInf" => 30000,
                        "serviceFee" => 100000,
                        "listFlight" => [
                            [
                                "icon" => "https://plugin.datacom.vn//Resources/Images/Airline/VJ.gif",
                                "flightId" => 1,
                                "leg" => 0,
                                "airline" => "VJ",
                                "startPoint" => "HAN",
                                "endPoint" => "SGN",
                                "airPortStart" => "Nội Bài",
                                "airPortEnd" => "Tân Sơn Nhất",
                                "startDate" => "2019-04-09T19:49:45.889Z",
                                "endTime" => "2019-04-09T20:49:45.890Z",
                                "flightNumber" => "VN123",
                                "stopNum" => 0,
                                "hasDownStop" => false,
                                "duration" => 120,
                                "noRefund" => false,
                                "groupClass" => "Phổ thông",
                                "fareClass" => "M",
                                "promo" => false,
                                "flightValue" => "",
                                "listSegment" => [
                                    [
                                        "id" => 1,
                                        "airline" => "VN",
                                        "startPoint" => "HAN",
                                        "endPoint" => "SGN",
                                        "startTime" => "2019-04-09T19:49:45.889Z",
                                        "endTime" => "2019-04-09T20:49:45.890Z",
                                        "flightNumber" => "VN123",
                                        "duration" => 120,
                                        "class" => "M",
                                        "plane" => "330",
                                        "startTerminal" => "T1",
                                        "endTerminal" => "T2",
                                        "hasStop" => false,
                                        "stopPoint" => "",
                                        "stopTime" => 0,
                                        "dayChange" => false,
                                        "stopOvernight" => false,
                                        "changeStation" => false,
                                        "changeAirport" => false,
                                        "lastItem" => true,
                                        "handBaggage" => "7kg"
                                    ]
                                ]
                            ]
                        ]
                    ],
                    [
                        "fareDataId" => 1,
                        "airline" => "QH",
                        "itinerary" => 1,
                        "leg" => 0,
                        "promo" => false,
                        "currency" => "VND",
                        "system" => "LCC",
                        "adt" => 1,
                        "chd" => 1,
                        "inf" => 1,
                        "fareAdt" => 1500000,
                        "fareChd" => 750000,
                        "fareInf" => 100000,
                        "taxAdt" => 150000,
                        "taxChd" => 75000,
                        "taxInf" => 10000,
                        "feeAdt" => 80000,
                        "feeChd" => 50000,
                        "feeInf" => 30000,
                        "serviceFee" => 100000,
                        "listFlight" => [
                            [
                                "icon" => "https://plugin.datacom.vn//Resources/Images/Airline/QH.gif",
                                "flightId" => 1,
                                "leg" => 0,
                                "airline" => "QH",
                                "startPoint" => "HAN",
                                "endPoint" => "SGN",
                                "airPortStart" => "Nội Bài",
                                "airPortEnd" => "Tân Sơn Nhất",
                                "startDate" => "2019-04-09T19:49:45.889Z",
                                "endTime" => "2019-04-09T20:49:45.890Z",
                                "flightNumber" => "VN123",
                                "stopNum" => 0,
                                "hasDownStop" => false,
                                "duration" => 120,
                                "noRefund" => false,
                                "groupClass" => "Phổ thông",
                                "fareClass" => "M",
                                "promo" => false,
                                "flightValue" => "",
                                "listSegment" => [
                                    [
                                        "id" => 1,
                                        "airline" => "VN",
                                        "startPoint" => "HAN",
                                        "endPoint" => "SGN",
                                        "startTime" => "2019-04-09T19:49:45.889Z",
                                        "endTime" => "2019-04-09T20:49:45.890Z",
                                        "flightNumber" => "VN123",
                                        "duration" => 120,
                                        "class" => "M",
                                        "plane" => "330",
                                        "startTerminal" => "T1",
                                        "endTerminal" => "T2",
                                        "hasStop" => false,
                                        "stopPoint" => "",
                                        "stopTime" => 0,
                                        "dayChange" => false,
                                        "stopOvernight" => false,
                                        "changeStation" => false,
                                        "changeAirport" => false,
                                        "lastItem" => true,
                                        "handBaggage" => "7kg"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                "status" => true,
                "errorCode" => "",
                "errorValue" => "",
                "errorField" => "",
                "message" => "",
                "language" => "vi-VN",
            ]
        ];

        // $json = json_encode($data);
        // $list_flight = json_decode($json);
        // dd($list_flight);

        $list_place = CallApiSeverService::methodGet('tk/client/search-place', []);
        $lists = [];
        $array = [];
        if ($list_place->code == 1) {
            foreach ($list_place->cate as $cate) {
                foreach ($cate->sub_list as $place) {
                    if ($place->code == $startPoint) {
                        $lists[0]['info']['startPoint'] = $place->name;
                        $lists[0]['info']['date'] = 'Ngày ' . $start_date->format('d/m/Y') . ', tức ' . Amlich::convertSolar2Lunar($start_date, 7);
                        $lists[0]['info']['list_days'] = CommonFunctions::list_day($request->way_start_date, $startPoint, $endPoint, '');
                    }
                    if ($place->code == $endPoint) {
                        $lists[0]['info']['endPoint'] = $place->name;
                    }
                }
            }
            if ($list_flight->data->status === true) {
                foreach ($list_flight->data->listFareData as $flight) {
                    if ($flight->leg == 0) $lists[0]['list_flight'][] = $flight;
                }
            }
        }
        Session::put('one_flights', $list_flight->data);
        $user = $this->__checkUser();
        $session = $list_flight->data->session;
        // dd($info);
        $data = [
            "lists" => $lists,
            "list_flight" => $list_flight->data,
            "session" => $session,
            "info" => $info,
            "user" => $user
        ];
        // dd($data);
        return view('frontend.flight.list_one_flight', compact('lists', 'list_flight', 'session', 'info', 'user'));
    }

    public function ajax_data_one_way_flight(Request $request)
    {
        //dd($request->all());
        $apiFormat = [];
        $apiFormat['status'] = 0;
        $info = $request->all();
        $Adt = $request->two_way_adt ? (int) $request->two_way_adt : 1;
        $Chd = $request->way_chd ? (int) $request->way_chd : 0;
        $Inf = $request->two_way_inf ? (int) $request->two_way_inf : 0;
        $startPoint = $request->begin_place_2_way;
        $endPoint = $request->end_place_2_way;
        $start_date = Carbon::createFromFormat('d/m/Y', $request->way_start_date);
        $Airline = 'VJ';
        if ($request->airline_company != '0') $Airline = $request->airline_company;
        $ListFlight = [
            [
                "StartPoint" => $startPoint,
                "EndPoint" => $endPoint,
                "DepartDate" => $start_date->format('dmY'),
                "Airline" => $Airline
            ]
        ];
        $data = [
            'Adt' => $Adt,
            'Chd' => $Chd,
            'Inf' => $Inf,
            'ViewMode' => "",
            'ListFlight' => $ListFlight
        ];
        //if ($request->airline_company != '0') $list_flight = CallApiSeverService::methodPostJson('api/flights/guest/search', $data)->data;
        $list_place = CallApiSeverService::methodGet('tk/client/search-place', []);
        $lists = [];
        $array = [];
        if ($list_place->code == 1) {
            foreach ($list_place->cate as $cate) {
                foreach ($cate->sub_list as $place) {
                    if ($place->code == $startPoint) {
                        $lists[0]['info']['startPoint'] = $place->name;
                        $lists[0]['info']['date'] = 'Ngày ' . $start_date->format('d/m/Y') . ', tức ' . Amlich::convertSolar2Lunar($start_date, 7);
                        $lists[0]['info']['list_days'] = CommonFunctions::list_day($request->way_start_date, $startPoint, $endPoint, '');
                    }
                    if ($place->code == $endPoint) {
                        $lists[0]['info']['endPoint'] = $place->name;
                    }
                }
            }
            if (Session::has('one_flights') && $request->airline_company == '0') {
                $list_flight = Session::get('one_flights');
            } else {
                $list_flight = CallApiSeverService::methodPostJson('api/flights/guest/search', $data)->data;
            }
            if (isset($list_flight) && $list_flight->listFareData != null) {
                foreach ($list_flight->listFareData as $flight) {
                    $start_time = Carbon::parse($flight->listFlight[0]->startDate)->format('H:i:s');
                    $firstDateTime = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 ' . $start_time);
                    if ($flight->leg == 0) {
                        if ($request->timer == "1") {
                            $firstDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 00:00:00');
                            $lastDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 04:59:59');
                            if ($firstDateTime->gte($firstDateTime_check) && $firstDateTime->lte($lastDateTime_check)) {
                                $lists[0]['list_flight'][] = $flight;
                            }
                        } else if ($request->timer == "2") {
                            $firstDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 05:00:00');
                            $lastDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 11:59:59');
                            if ($firstDateTime->gte($firstDateTime_check) && $firstDateTime->lte($lastDateTime_check)) {
                                $lists[0]['list_flight'][] = $flight;
                            }
                        } else if ($request->timer == "3") {
                            $firstDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 12:00:00');
                            $lastDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 17:59:59');
                            if ($firstDateTime->gte($firstDateTime_check) && $firstDateTime->lte($lastDateTime_check)) {
                                $lists[0]['list_flight'][] = $flight;
                            }
                        } else if ($request->timer == "4") {
                            $firstDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 18:00:00');
                            $lastDateTime_check = Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 23:59:59');
                            if ($firstDateTime->gte($firstDateTime_check) && $firstDateTime->lte($lastDateTime_check)) {
                                $lists[0]['list_flight'][] = $flight;
                            }
                        } else {
                            $lists[0]['list_flight'][] = $flight;
                        }
                    }
                }
            }
        }
        if ($request->orderBy == '1') {
            if (isset($lists[0]['list_flight'])) {
                usort($lists[0]['list_flight'], function ($a, $b) {
                    if ($a->fareAdt == $b->fareAdt) {
                        return 0;
                    } else {
                        return ($a->fareAdt > $b->fareAdt) ? -1 : 1;
                    }
                });
            }
        } else if ($request->orderBy == '2') {
            if (isset($lists[0]['list_flight'])) {
                usort($lists[0]['list_flight'], function ($a, $b) {
                    if ($a->fareAdt == $b->fareAdt) {
                        return 0;
                    } else {
                        return ($a->fareAdt > $b->fareAdt) ? 1 : -1;
                    }
                });
            }
        } else if ($request->orderBy == '3') {
            if (isset($lists[0]['list_flight'])) {
                usort($lists[0]['list_flight'], function ($a, $b) {
                    if (Carbon::parse($a->listFlight[0]->startDate)->lte(Carbon::parse($b->listFlight[0]->startDate))) {
                        return 0;
                    } else {
                        return 1;
                    }
                });
            }
        }
        $session = $list_flight->session;
        $view_mode = $request->view_mode;
        $apiFormat['status'] = 1;
        $apiFormat['data'] = view('frontend.block.ajax_data_one_way_flight', compact('lists', 'session', 'view_mode', 'info'))->render();
        return response()->json($apiFormat);
    }

    public function get_flight_one_booking(Request $request)
    {
        // dd($request->all());
        // dd(session()->all());
        $flightId = $request->form_id;
        $one_flights = $request->session()->all()['one_flights'];
        $listFlight = $one_flights->listFareData;

        $filteredFlights = array_filter($listFlight, function ($flight) use ($flightId) {
            return $flight->fareDataId == $flightId;
        });
        // dd($listFlight, $flightId, $filteredFlights);
        $listFareData = array_values($filteredFlights);
        session()->put('listFareData', $listFareData);
        $one_flights->listFareData = $listFareData;
        // dd($one_flights);
        $data_one = [
            'session' => $request->form_session,
            'fareDataId' => $request->form_id
        ];
        // $flight_one = CallApiSeverService::methodGet('api/flights/guest', $data_one);
        $flight_one = $one_flights;
        $data = [
            "flightType" => "Domestic",
            "session" => "FAKEDATA",
            "itinerary" => 1,
            "listFareData" => [
                [
                    "fareDataId" => 1,
                    "airline" => "VN",
                    "itinerary" => 1,
                    "leg" => 0,
                    "promo" => false,
                    "currency" => "VND",
                    "system" => "LCC",
                    "adt" => 1,
                    "chd" => 1,
                    "inf" => 0,
                    "fareAdt" => 1500000,
                    "fareChd" => 750000,
                    "fareInf" => 100000,
                    "taxAdt" => 150000,
                    "taxChd" => 75000,
                    "taxInf" => 10000,
                    "feeAdt" => 80000,
                    "feeChd" => 50000,
                    "feeInf" => 30000,
                    "serviceFee" => 100000,
                    "serviceFeeAdt" => 100000,
                    "serviceFeeChd" => 100000,
                    "serviceFeeInf" => 100000,
                    "totalNetPrice" => 1850000,
                    "totalServiceFee" => 300000,
                    "totalPrice" => 2150000,
                    "listFlight" => [
                        [
                            "icon" => "https://plugin.datacom.vn//Resources/Images/Airline/VN.gif",
                            "flightId" => 1,
                            "leg" => 0,
                            "airline" => "VN",
                            "startPoint" => "HAN",
                            "endPoint" => "SGN",
                            "startDate" => "2019-04-09T19:49:45.889Z",
                            "endDate" => "2019-04-09T20:49:45.890Z",
                            "startDt" => "2019-04-09T19:49:45.889Z",
                            "endDt" => "2019-04-09T20:49:45.890Z",
                            "flightNumber" => "VN123",
                            "stopNum" => 0,
                            "hasDownStop" => false,
                            "duration" => 120,
                            "noRefund" => false,
                            "groupClass" => "Phổ thông",
                            "fareClass" => "M",
                            "promo" => false,
                            "flightValue" => "",
                            "listSegment" => [
                                [
                                    "id" => 1,
                                    "airline" => "VN",
                                    "startPoint" => "HAN",
                                    "endPoint" => "SGN",
                                    "startTime" => "2019-04-09T19:49:45.889Z",
                                    "endTime" => "2019-04-09T20:49:45.890Z",
                                    "startTm" => "2019-04-09T19:49:45.889Z",
                                    "endTm" => "2019-04-09T20:49:45.890Z",
                                    "flightNumber" => "VN123",
                                    "duration" => 120,
                                    "class" => "M",
                                    "plane" => "330",
                                    "startTerminal" => "T1",
                                    "endTerminal" => "T2",
                                    "hasStop" => false,
                                    "stopPoint" => "",
                                    "stopTime" => 0,
                                    "dayChange" => false,
                                    "stopOvernight" => false,
                                    "changeStation" => false,
                                    "changeAirport" => false,
                                    "lastItem" => true,
                                    "handBaggage" => "7kg"
                                ]
                            ]
                        ]
                    ]
                ],
            ],
            "status" => true,
            "errorCode" => "",
            "errorValue" => "",
            "errorField" => "",
            "message" => "",
            "language" => "vi",
        ];

        // $json = json_encode($data);
        // $flight_one = json_decode($json);

        // dd($flight_one);
        $flight_one->total_fee_service = ($flight_one->listFareData[0]->taxAdt + $flight_one->listFareData[0]->feeAdt + $flight_one->listFareData[0]->serviceFee) * $flight_one->listFareData[0]->adt + ($flight_one->listFareData[0]->taxChd + $flight_one->listFareData[0]->feeChd + $flight_one->listFareData[0]->serviceFee) * $flight_one->listFareData[0]->chd + ($flight_one->listFareData[0]->taxInf + $flight_one->listFareData[0]->feeInf + $flight_one->listFareData[0]->serviceFee) * $flight_one->listFareData[0]->inf;
        $flight_one->total = ($flight_one->listFareData[0]->fareAdt + $flight_one->listFareData[0]->taxAdt + $flight_one->listFareData[0]->feeAdt + $flight_one->listFareData[0]->serviceFee) * $flight_one->listFareData[0]->adt + ($flight_one->listFareData[0]->fareChd + $flight_one->listFareData[0]->taxChd + $flight_one->listFareData[0]->feeChd + $flight_one->listFareData[0]->serviceFee) * $flight_one->listFareData[0]->chd + ($flight_one->listFareData[0]->fareInf + $flight_one->listFareData[0]->taxInf + $flight_one->listFareData[0]->feeInf + $flight_one->listFareData[0]->serviceFee) * $flight_one->listFareData[0]->inf;
        $flight_one->listFareData[0]->listFlight[0]->listSegment[0]->handBaggage = "7kg";
        $data_hand_bag_one[] = [
            "AutoIssue" => false,
            "FareDataId" => $request->form_id,
            "ListFlight" => [
                ["FlightValue" => $request->form_value]
            ],
            "Session" => $request->form_session
        ];
        // $hand_bag_one = CallApiSeverService::methodGet('api/flights/guest/search-baggage/' . json_encode($data_hand_bag_one), []);

        $data = [
            "status" => 200,
            "message" => "",
            "listBaggage" => [
                [
                    "airline" => "VN",
                    "leg" => 0,
                    "route" => "HANSGN",
                    "code" => "HANSGN10",
                    "currency" => "VND",
                    "name" => "Gói 10kg",
                    "price" => 200000,
                    "value" => "10kg",
                ],
                [
                    "airline" => "VN",
                    "leg" => 0,
                    "route" => "HANSGN",
                    "code" => "HANSGN20",
                    "currency" => "VND",
                    "name" => "Gói 20kg",
                    "price" => 400000,
                    "value" => "20kg",
                ]
            ]
        ];

        $json = json_encode($data);
        $hand_bag_one = json_decode($json);

        $user = $this->__checkUser();
        $is_background = 1;
        $list_place = CallApiSeverService::methodGet('tk/client/search-place', []);
        if ($list_place->code == 1) {
            foreach ($list_place->cate as $cate) {
                foreach ($cate->sub_list as $place) {
                    if ($place->code == $flight_one->listFareData[0]->listFlight[0]->startPoint) {
                        $lists[0]['startPoint'] = $place->name;
                        $lists[0]['start_date'] = $flight_one->listFareData[0]->listFlight[0]->startDate;
                        $lists[0]['flightNumber'] = $flight_one->listFareData[0]->listFlight[0]->flightNumber;
                        $lists[0]['logo'] = $flight_one->listFareData[0]->listFlight[0]->icon;
                    }
                    if ($place->code == $flight_one->listFareData[0]->listFlight[0]->endPoint) {
                        $lists[0]['endPoint'] = $place->name;
                    }
                }
            }
        }
        // $fare_conditions = CallApiSeverService::methodGet('api/guest/condition-price', []);
        $data = [
            [
                "id" => 1,
                "code" => "M1",
                "conditions" => "<p>dieu kien ve 1</p>",
                "nameAirline" => "Vietnam Airlines",
            ],
            [
                "id" => 2,
                "code" => "M2",
                "conditions" => "<p>dieu kien ve 2</p>",
                "nameAirline" => "Vietnam Airlines",
            ]
        ];

        $json = json_encode($data);
        $fare_conditions = json_decode($json);
        //dd($flight_one, $hand_bag_one);
        $data = [
            'flight_one' => $flight_one,
            'hand_bag_one' => $hand_bag_one,
            'user' => $user,
            'is_background' => $is_background,
            'lists' => $lists,
            'fare_conditions' => $fare_conditions
        ];
        // dd($data);
        if (true) {
            return view('frontend.flight.flight_one_detail', compact('info', 'flight_one', 'hand_bag_one', 'user', 'is_background', 'lists', 'fare_conditions'));
        } else {
            return abort(404);
        }
    }

    public function book_flight_one(Request $request)
    {
        // dd($request->all());
        $fareData = session()->all()['listFareData'][0];
        $ip = $request->ip();
        $listBaggage = [];
        foreach ($request->first_name as $key => $first_name) {
            if ($request->handbags_one[$key] != "0") {
                $handbags_one = explode('-', $request->handbags_one[$key]);
                $listBaggage[] = [
                    "Airline" => $handbags_one[0],
                    "Leg" => (int) $handbags_one[1],
                    "Route" => $handbags_one[2],
                    "Code" => $handbags_one[3],
                    "Currency" => $handbags_one[4],
                    "Name" => $handbags_one[5],
                    "Price" => (int) $handbags_one[6],
                    "Value" => $handbags_one[7]
                ];
            }
            $ListPassenger[] = [
                "Birthday" => "",
                "FirstName" => $first_name,
                "Gender" => $request->gender[$key] == '1' ? true : false,
                "Index" => $key,
                "LastName" => $request->last_name[$key],
                "Type" => $request->type[$key],
                "ListBaggage" => $listBaggage
            ];
        }
        $data = [
            "BookType" => "book-normal",
            "Contact" => [
                "Gender" => $request->contact_gender == '1' ? true : false,
                "FirstName" => $request->first_name_contact,
                "LastName" => $request->last_name_contact,
                "Phone" => $request->phone_number_contact,
                "Email" => $request->email_contact,
                "Address" => $request->address_contact ?: ""
            ],
            "Ip" => $ip,
            "ListFareData" => [
                [
                    "AutoIssue" => false,
                    "FareDataId" => (int) $request->flight_id_one,
                    "ListFlight" => [
                        [
                            "FlightValue" => $request->flight_value_one,
                            "Leg" => (int) $request->flight_leg_one
                        ]
                    ],
                    "Session" => $request->session
                ]
            ],
            "ListPassenger" => $ListPassenger,
            "Note" => "",
            "PaymentMethod" => $request->payment_method,
            "Remark" => "",
            "UseAgentContact" => true,
            "emailLogin" => "",
            "Flight" => $fareData
            // "InvoiceDto" => [
            //     "address" =>  $request->company_address ?: "",
            //     "cityName" => "",
            //     "companyName" => $request->company_name ?: "",
            //     "email" => "",
            //     "receiver" => "",
            //     "taxCode" => $request->tax_code ?: "",
            //     "receiverAddress" => "",
            //     "receiverMethod" => "",
            //     "receiverPhone" => ""
            // ]
        ];
        // dd($data);
        $result = CallApiSeverService::methodPostJson('api/flights/guest/book', $data);
        // dd($result);
        $full_name = $request->first_name_contact . ' ' . $request->last_name_contact;
        $user = $this->__checkUser();
        if ($result->status != 200) {
            return view('frontend.fail', compact('full_name', 'user'));
        } else {
            if ($result->data->errorValue == 'FAIL') {
                return view('frontend.fail', compact('full_name', 'user'));
            } else {
                return view('frontend.success', compact('full_name', 'user'));
            }
        }
    }
}
