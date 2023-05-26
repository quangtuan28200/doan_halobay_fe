<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/abc', function (Request $request) {
    dd($request->all());
    $lists = $request->all();
    usort($lists[0]['list_flight'], function($a, $b) {
        $start_time = Carbon\Carbon::parse($a['listFlight'][0]['startDate'])->format('h:i:s');
        $end_time = Carbon\Carbon::parse($a['listFlight'][0]['endDate'])->format('h:i:s');
        $firstDateTime = Carbon\Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 ' . $start_time);
        $lastDateTime = Carbon\Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 ' . $end_time);
        $firstDateTime_check = Carbon\Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 05:00:00');
        $lastDateTime_check = Carbon\Carbon::createFromFormat('d/m/Y H:i:s',  '01/01/1970 11:59:59');
        if ($firstDateTime->gte($firstDateTime_check) && $firstDateTime->lte($lastDateTime_check)) {
            dd($start_time, $lastDateTime_check->format('h:i'), '0');                 
        } else {
            dd($firstDateTime->format('H:i'), $lastDateTime_check->format('h:i'), '1');
        }
        if ($a['listFlight']['startDate'] == $b['listFlight']['endDate']) {
            return 0;
        } else {
            return ($a['fareAdt'] > $b['fareAdt']) ? -1 : 1;
        }
    });
 
    return ($lists[0]['list_flight']);
});