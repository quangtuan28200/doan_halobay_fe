<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CallApiSeverService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected const perPage = 4;

    public static function __checkUser()
    {
        $token = \Session::get('token');
        $email = \Session::get('email');
        $user = null;
        if ($email && $token) $user = CallApiSeverService::methodGet('api/app-users/get-profile-by-login', ['login' => $email], $token);
        return $user;
    }

    public function index()
    {
        $user = $this->__checkUser();
        $cate_home = CallApiSeverService::methodGet('api/home/cate', [])->category;
        \Session::forget('url_hotel');
        \Session::forget('array_room_hotel');
        \Session::forget('start_date_hotel');
        \Session::forget('end_date_hotel');
        \Session::forget('array_room_number');
        //session yacht
        \Session::forget('url_yacht');
        \Session::forget('array_room_yacht');
        \Session::forget('yacht_book_date');
        \Session::forget('array_room_yacht_number');
        $tabs = CallApiSeverService::methodGet('api/home/guest/tab', [])->tab;
        \Session::forget('yacht_adultNum');
        \Session::forget('yacht_childNum');
        \Session::forget('yacht_childNum2');
        //dd($list_hotel, $cate_home);
        //dd($user);
        return view('frontend.index', compact('cate_home', 'user', 'tabs'));
    }
    public function contact()
    {
        $user = $this->__checkUser();
        $contact = CallApiSeverService::methodGet('api/home/cate', [])->category;
        return view('frontend.contact', compact('contact', 'user'));
    }

    public function about_us()
    {
        $user = $this->__checkUser();
        $about_us = CallApiSeverService::methodGet('api/web-contents/searchbycode', ['code' => 'TACHUDU_GIOI_THIEU']);
        return view('frontend.about_us', compact('about_us', 'user'));
    }

    public function web_content(Request $request)
    {
        $url = $request->getRequestUri();
        $user = $this->__checkUser();
        $list_cate_news = CallApiSeverService::methodGet('api/client/new-categories', []);
        $cate_news = null;
        if ($url === '/huong-dan-thanh-toan') {
            $data = CallApiSeverService::methodGet('api/web-contents/searchbycode', ['code' => 'HUONG_DAN_THANH_TOAN']);
        } else if ($url === '/thong-tin-chuyen-khoan') {
            $data = CallApiSeverService::methodGet('api/web-contents/searchbycode', ['code' => 'THONG_TIN_CHUYEN_KHOAN']);
        } else if ($url === '/huong-dan-su-dung') {
            $data = CallApiSeverService::methodGet('api/web-contents/searchbycode', ['code' => 'HUONG-DAN-SU-DUNG']);
        } else if ($url === '/chinh-sach-bao-mat') {
            $data = CallApiSeverService::methodGet('api/web-contents/searchbycode', ['code' => 'CHINH-SACH-BAO-MAT']);
        } else if ($url === '/dieu-khoan-su-dung') {
            $data = CallApiSeverService::methodGet('api/web-contents/searchbycode', ['code' => 'DIEU-KHOAN-SU-DUNG']);
        } else if ($url === '/hinh-thuc-thanh-toan') {
            $data = CallApiSeverService::methodGet('api/web-contents/searchbycode', ['code' => 'HINH-THUC-THANH-TOAN']);
        } else if ($url === '/dia-chi-cong-ty') {
            $data = CallApiSeverService::methodGet('api/web-contents/searchbycode', ['code' => 'DIA-CHI-CONG-TY']);
        } else if ($url === '/cau-hoi-thuong-gap') {
            $data = CallApiSeverService::methodGet('api/web-contents/searchbycode', ['code' => 'CAU_HOI_THUONG_GAP']);
        }
        // dd($data);
        if (isset($data) && $data !== 404) {
            return view('frontend.web_content', compact('data', 'cate_news', 'list_cate_news', 'user'));
        } else {
            return abort(404);
        }
    }

    public function news($cate_id = '')
    {
        $user = $this->__checkUser();
        $page = 0;
        $perPage = self::perPage;
        $result = self::get_news($cate_id, $page, $perPage);
        $news = $result['news'];
        $cate_news = $result['cate_news'];
        $list_cate_news = $result['list_cate_news'];
        if (isset($news) && $news !== 400) {
            return view('frontend.news', compact('news', 'cate_news', 'page', 'perPage', 'list_cate_news', 'user'));
        } else {
            return abort(404);
        }
    }

    public function ajax_news(Request $request)
    {
        $apiFormat = [];
        $perPage = self::perPage;
        $apiFormat['page'] = (int) $request->page;
        $page =  (int) $request->page;
        $cate_id = $request->cate_id != 0 ? $request->cate_id : null;
        $result = self::get_news($cate_id, $page, $perPage);
        $news = $result['news'];
        $cate_news = $result['cate_news'];
        $apiFormat['data'] = view('frontend.block.ajax_news', compact('news'))->render();
        $apiFormat['paginate'] = view('frontend.block.paginate', compact('news', 'cate_news', 'page', 'perPage'))->render();
        return response()->json($apiFormat);
    }

    public static function get_news($cate_id, $page, $perPage)
    {
        $list_cate_news = CallApiSeverService::methodGet('api/client/new-categories', []);
        $news = CallApiSeverService::methodGet('api/client/news/categories', [
            'categoryId' => $cate_id,
            'page' => $page,
            'itemPerPage' => $perPage
        ]);
        $cate_news = null;
        if ($list_cate_news) {
            foreach ($list_cate_news as $cate) {
                if ($cate_id && $cate_id == $cate->id) {
                    $cate_news = $cate;
                }
            }
        }
        return ['news' => $news, 'cate_news' => $cate_news, 'list_cate_news' => $list_cate_news];
    }

    public function detail_news($slug)
    {
        $user = $this->__checkUser();
        $news = CallApiSeverService::methodGet('api/client/news/' . $slug, []);
        $list_cate_news = CallApiSeverService::methodGet('api/client/new-categories', []);
        $cate_news = null;
        if (isset($news) && $news !== 400) {
            return view('frontend.news_detail', compact('news', 'cate_news', 'list_cate_news', 'user'));
        } else {
            return abort(404);
        }
    }

    public function sign_up_notify(Request $request)
    {
        $data = [
            "customerName" => $request->full_name,
            "customerEmail" => $request->email,
        ];
        $apiFormat['data'] = CallApiSeverService::methodPostJson('api/register-for-news/guest/create', $data);
        return response()->json($apiFormat);
    }
}
