<?php

namespace App\Providers;

use App\Services\CallApiSeverService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
        $menu_header = CallApiSeverService::methodGet('api/app-menus', []);
        $menu_footer = CallApiSeverService::methodGet('api/app-menus-footer', []);
        $list_place_hotel = CallApiSeverService::methodGet('api/hotel-places/guest/getAll', []);
        $list_place_yacht = CallApiSeverService::methodGet('api/yacht-places/guest/getAll', []);
        $list_place_city = CallApiSeverService::methodGet('api/tour/guest/places', []);
        // dd($list_place_city);

       
        View::share('menu_header', $menu_header);
        View::share('menu_footer', $menu_footer);
        View::share('list_place_hotel', $list_place_hotel);
        View::share('list_place_yacht', $list_place_yacht);
        View::share('list_place_city', $list_place_city);
        $list_place_tour = null;
        $list_place_tour = CallApiSeverService::methodGet('api/guest/places', []);
        // $list_place_tour = json_decode('[]');
        // if ($place_tour != 400) {
        //     foreach ($place_tour->regionDtos as $row) {
        //         foreach ($row->placesDto as $value) {
        //             $list_place_tour[] = $value;
        //         }
        //     }
        // }
        \View::share('list_place_tour', $list_place_tour);
        $list_place_seaplane = CallApiSeverService::methodGet('api/seaplane-places/guest', []);
        //dd($list_place_seaplane);
        \View::share('list_place_seaplane', $list_place_seaplane);
        $list_place_flight = CallApiSeverService::methodGet('tk/client/search-place', []);
        if (!is_int($list_place_flight)) \View::share('list_place_flight', $list_place_flight->cate);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
