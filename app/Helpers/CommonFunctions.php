<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Services\CallApiSeverService;

class CommonFunctions
{
    public static function convertTime($time)
    {
        return Carbon::createFromFormat('Y-m-d', $time)->format('d/m/Y');
    }

    public static function list_day($day, $start_place, $end_place, $airline)
    {
        // dd([
        //     "StartPoint" => $start_place,
        //     "EndPoint" => $end_place,
        //     "DepartDate" => Carbon::createFromFormat('d/m/Y', $day)->subDays(0)->format('dmY'),
        //     "Airline" => $airline
        // ]);
        // dd(CallApiSeverService::methodGet('api/flights/guest/search-min', [
        //     "startPoint" => $start_place,
        //     "endPoint" => $end_place,
        //     "departDate" => Carbon::createFromFormat('d/m/Y', $day)->format('dmY'),
        //     "airline" => $airline
        // ]));

        // $list_days[] = [
        //     'full_day' => Carbon::createFromFormat('d/m/Y', $day)->subDays(2)->format('d/m/Y'),
        //     'day' => Carbon::createFromFormat('d/m/Y', $day)->subDays(2)->format('d/m'),
        //     'stuff' => self::stuff(Carbon::createFromFormat('d/m/Y', $day)->subDays(2)->format('l')),
        //     'status' => 0,
        //     'min_price' => CallApiSeverService::methodGet('api/flights/guest/search-min', [
        //         "StartPoint" => $start_place,
        //         "EndPoint" => $end_place,
        //         "DepartDate" => Carbon::createFromFormat('d/m/Y', $day)->subDays(2)->format('dmY'),
        //         "Airline" => $airline
        //     ])->data->status ? CallApiSeverService::methodGet('api/flights/guest/search-min', [
        //         "StartPoint" => $start_place,
        //         "EndPoint" => $end_place,
        //         "DepartDate" => Carbon::createFromFormat('d/m/Y', $day)->subDays(2)->format('dmY'),
        //         "Airline" => $airline
        //     ])->MinFlight->FeeAdt : ''
        // ];
        // $list_days[] = [
        //     'full_day' => Carbon::createFromFormat('d/m/Y', $day)->subDays(1)->format('d/m/Y'),
        //     'day' => Carbon::createFromFormat('d/m/Y', $day)->subDays(1)->format('d/m'),
        //     'stuff' => self::stuff(Carbon::createFromFormat('d/m/Y', $day)->subDays(1)->format('l')),
        //     'status' => 0,
        //     'min_price' => CallApiSeverService::methodPostJson('api/flights/guest/search-min', [
        //         "StartPoint" => $start_place,
        //         "EndPoint" => $end_place,
        //         "DepartDate" => Carbon::createFromFormat('d/m/Y', $day)->subDays(1)->format('dmY'),
        //         "Airline" => $airline
        //     ])->data->status ? CallApiSeverService::methodPostJson('api/flights/guest/search-min', [
        //         "StartPoint" => $start_place,
        //         "EndPoint" => $end_place,
        //         "DepartDate" => Carbon::createFromFormat('d/m/Y', $day)->subDays(1)->format('dmY'),
        //         "Airline" => $airline
        //     ])->MinFlight->FeeAdt : ''
        // ];
        // $list_days[] = [
        //     'full_day' => Carbon::createFromFormat('d/m/Y', $day)->subDays(0)->format('d/m/Y'),
        //     'day' => Carbon::createFromFormat('d/m/Y', $day)->subDays(0)->format('d/m'),
        //     'stuff' => self::stuff(Carbon::createFromFormat('d/m/Y', $day)->subDays(0)->format('l')),
        //     'status' => 1,
        //     'min_price' => CallApiSeverService::methodPostJson('api/flights/guest/search-min', [
        //         "StartPoint" => $start_place,
        //         "EndPoint" => $end_place,
        //         "DepartDate" => Carbon::createFromFormat('d/m/Y', $day)->subDays(0)->format('dmY'),
        //         "Airline" => $airline
        //     ])->data->status ? CallApiSeverService::methodPostJson('api/flights/guest/search-min', [
        //         "StartPoint" => $start_place,
        //         "EndPoint" => $end_place,
        //         "DepartDate" => Carbon::createFromFormat('d/m/Y', $day)->subDays(0)->format('dmY'),
        //         "Airline" => $airline
        //     ])->MinFlight->FeeAdt : ''
        // ];
        // $list_days[] = [
        //     'full_day' => Carbon::createFromFormat('d/m/Y', $day)->addDays(1)->format('d/m/Y'),
        //     'day' => Carbon::createFromFormat('d/m/Y', $day)->addDays(1)->format('d/m'),
        //     'stuff' => self::stuff(Carbon::createFromFormat('d/m/Y', $day)->addDays(1)->format('l')),
        //     'status' => 0,
        //     'min_price' => CallApiSeverService::methodPostJson('api/flights/guest/search-min', [
        //         "StartPoint" => $start_place,
        //         "EndPoint" => $end_place,
        //         "DepartDate" => Carbon::createFromFormat('d/m/Y', $day)->addDays(1)->format('dmY'),
        //         "Airline" => $airline
        //     ])->data->status ? CallApiSeverService::methodPostJson('api/flights/guest/search-min', [
        //         "StartPoint" => $start_place,
        //         "EndPoint" => $end_place,
        //         "DepartDate" => Carbon::createFromFormat('d/m/Y', $day)->addDays(1)->format('dmY'),
        //         "Airline" => $airline
        //     ])->MinFlight->FeeAdt : ''
        // ];
        $list_days[] = [
            'full_day' => Carbon::createFromFormat('d/m/Y', $day)->format('d/m/Y'),
            'day' => Carbon::createFromFormat('d/m/Y', $day)->format('d/m'),
            'stuff' => self::stuff(Carbon::createFromFormat('d/m/Y', $day)->format('l')),
            'status' => 0,
            'min_price' => CallApiSeverService::methodGet('api/flights/guest/search-min', [
                "startPoint" => $start_place,
                "endPoint" => $end_place,
                "departDate" => Carbon::createFromFormat('d/m/Y', $day)->format('dmY'),
                "airline" => $airline
            ])->status ? CallApiSeverService::methodGet('api/flights/guest/search-min', [
                "startPoint" => $start_place,
                "endPoint" => $end_place,
                "departDate" => Carbon::createFromFormat('d/m/Y', $day)->format('dmY'),
                "airline" => $airline
            ])->MinFlight->feeAdt : ''
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

    public static function convertTimeToMinutes($startTime, $endTime)
    {
        $minutes = Carbon::parse($startTime)->diffInMinutes($endTime);
        if ($minutes % 60 == 0) {
            return $minutes / 60 . 'giờ';
        } else {
            return round($minutes / 60) . ' giờ ' . $minutes % 60 . ' phút';
        }
    }

    public static function rateNumberToText($rateNum)
    {
        switch ($rateNum) {
            case 1:
                return 'Không thích';
                break;
            case 2:
                return 'Tạm được';
                break;
            case 3:
                return 'Bình thường';
                break;
            case 4:
                return 'Rất tốt';
                break;
            case 5:
                return 'Tuyệt vời';
                break;
            default:
                return 'Rất tốt';
        }
    }

    public static function rateAvgToText($rateAvg)
    {
        switch ($rateAvg) {
            case ($rateAvg >= 1 && $rateAvg < 2):
                return 'Không thích';
                break;
            case ($rateAvg >= 2 && $rateAvg < 3):
                return 'Tạm được';
                break;
            case ($rateAvg >= 3 && $rateAvg < 4):
                return 'Bình thường';
                break;
            case ($rateAvg >= 4 && $rateAvg < 5):
                return 'Rất tốt';
                break;
            case ($rateAvg == 5):
                return 'Tuyệt vời';
                break;
            default:
                return 'Rất tốt';
        }
    }

    public static function countRateQuality($rates)
    {
        $count = [
            'great' => 0,
            'good' => 0,
            'normal' => 0,
            'ok' => 0,
            'bad' => 0,
        ];

        foreach ($rates as $rate) {
            switch ($rate->rate) {
                case 5:
                    $count['great']++;
                    break;
                case 4:
                    $count['good']++;
                    break;
                case 3:
                    $count['normal']++;
                    break;
                case 2:
                    $count['ok']++;
                    break;
                case 1:
                    $count['bad']++;
                    break;
            }
        }

        return $count;
    }

    public static function rateQualityProgress($rates)
    {
        $rateCount = count($rates) == 0 ? 1 : count($rates);
        $countRateQuality = self::countRateQuality($rates);
        $countRateQuality['great'] = intval($countRateQuality['great'] / $rateCount * 100);
        $countRateQuality['good'] = intval($countRateQuality['good'] / $rateCount * 100);
        $countRateQuality['normal'] = intval($countRateQuality['normal'] / $rateCount * 100);
        $countRateQuality['ok'] = intval($countRateQuality['ok'] / $rateCount * 100);
        $countRateQuality['bad'] = intval($countRateQuality['bad'] / $rateCount * 100);

        return $countRateQuality;
    }
}
