<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CallApiSeverService;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7;

class AccountController extends Controller
{
    public static function __checkUser()
    {
        $token = \Session::get('token');
        $email = \Session::get('email');
        $user = null;
        if ($email && $token) $user = CallApiSeverService::methodGet('api/app-users/get-profile-by-login', ['login' => $email], $token);
        return $user;
    }

    public function login()
    {
        $contact = "";
        $is_background = 1;
        $user = $this->__checkUser();
        return view('frontend.account.login', compact('contact', 'is_background', 'user'));
    }
    public function signup()
    {
        $contact = "";
        $is_background = 1;
        $user = $this->__checkUser();
        return view('frontend.account.signup', compact('contact', 'is_background', 'user'));
    }
    public function signup_agency()
    {
        $contact = "";
        $is_background = 1;
        $user = $this->__checkUser();
        return view('frontend.account.signup_agency', compact('contact', 'is_background', 'user'));
    }
    public function signup_collaborators()
    {
        $contact = "";
        $is_background = 1;
        $user = $this->__checkUser();
        return view('frontend.account.signup_collaborators', compact('contact', 'is_background', 'user'));
    }
    public function signup_user_normal()
    {
        $contact = "";
        $is_background = 1;
        $user = $this->__checkUser();
        return view('frontend.account.signup_user_normal', compact('contact', 'is_background', 'user'));
    }

    public function post_signup_user_normal(Request $request)
    {
        // dd($request->all());
        $apiFormat = [];
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password'
        ], [
            'email.email' => 'Email chưa đúng định dạng',
            'password.min' => 'Mật khẩu phải từ 4 ký tự trở lên',
            'confirm_password.same' => 'Nhập lại mật khẩu chưa khớp'
        ]);
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            $apiFormat['data']['status'] = 0;
            $apiFormat['data']['message'] = $message;
            return response()->json($apiFormat);
        }
        $obj = (object) [
            "fullName" => $request->full_name,
            "email" => "$request->email",
            "login" => $request->email,
            "phone" => $request->phone_number,
            "userName" => $request->email,
            "passwordHash" => $request->password,
            "password" => $request->confirm_password,
            'userType' => 4
        ];
        $data = [
            'obj' => json_encode($obj),
            "fileDocument" => $request->file
        ];
        // dd($data);
        $apiFormat['data'] = CallApiSeverService::methodPostParam('api/guest/register', $data);
        return response()->json($apiFormat);
    }

    public function post_signup_collaborators(Request $request)
    {
        // dd($request->all());
        $apiFormat = [];
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password'
        ], [
            'email.email' => 'Email chưa đúng định dạng',
            'password.min' => 'Mật khẩu phải từ 4 ký tự trở lên',
            'confirm_password.same' => 'Nhập lại mật khẩu chưa khớp'
        ]);
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            $apiFormat['data']['status'] = 0;
            $apiFormat['data']['message'] = $message;
            return response()->json($apiFormat);
        }
        $obj = (object) [
            "fullName" => $request->full_name,
            "email" => "$request->email",
            "login" => $request->email,
            "phone" => $request->phone_number,
            "userName" => $request->email,
            "passwordHash" => $request->password,
            "password" => $request->confirm_password,
            'userType' => 1
        ];
        $data = [
            'obj' => json_encode($obj),
            "fileDocument" => $request->file
        ];
        // dd($data);
        $apiFormat['data'] = CallApiSeverService::methodPostParam('api/guest/register', $data);
        return response()->json($apiFormat);
    }

    public function post_signup_agency(Request $request)
    {
        //dd($request->all());
        $apiFormat = [];
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password'
        ], [
            'email.email' => 'Email chưa đúng định dạng',
            'password.min' => 'Mật khẩu phải từ 4 ký tự trở lên',
            'confirm_password.same' => 'Nhập lại mật khẩu chưa khớp'
        ]);
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            $apiFormat['data']['status'] = 0;
            $apiFormat['data']['message'] = $message;
            return response()->json($apiFormat);
        }
        $obj = (object) [
            "fullName" => $request->full_name,
            "email" => "$request->email",
            "login" => $request->email,
            "phone" => $request->phone_number,
            "userName" => $request->email,
            "passwordHash" => $request->password,
            "password" => $request->confirm_password,
            'companyName' => $request->company_name,
            'position' => $request->position,
            'taxCode' => $request->tax_code,
            'userType' => 2
        ];
        $data = [
            'obj' => json_encode($obj),
            "fileDocument" => null
        ];
        $apiFormat['data'] = CallApiSeverService::methodPostParam('api/guest/register', $data);
        return response()->json($apiFormat);
    }

    public function post_login(Request $request)
    {
        // dd($request->all());
        $apiFormat = [];
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
        ], [
            'email.email' => 'Email chưa đúng định dạng',
        ]);
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            $apiFormat['status'] = 0;
            $apiFormat['message'] = $message;
            return response()->json($apiFormat);
        }
        $data = [
            "username" => $request->email,
            "password" => $request->password,
            "rememberMe" => $request->rememberMe
        ];
        // dd($data);
        $apiFormat = CallApiSeverService::methodPostJson('api/authenticate', $data);
        // dd($apiFormat);
        if ($apiFormat->status === 200) {
            $token = $apiFormat->data->id_token;
            \Session::put('token', $token);
            $email = $request->email;
            \Session::put('email', $email);
        };
        return response()->json($apiFormat);
    }

    public function account_detail()
    {
        $user = $this->__checkUser();
        //dd($user);
        if ($user === 401) {
            return redirect()->route('login');
        } else if ($user->userType === 1) {
            return view('frontend.account.account_collaborators', compact('user'));
        } else if ($user->userType === 2) {
            return view('frontend.account.account_agency', compact('user'));
        } else if ($user->userType === 4) {
            return view('frontend.account.account_normal', compact('user'));
        }
    }

    public function updateInfoUser(Request $request)
    {
        // dd($request->all());
        $link_image = null;
        $apiFormat = [];
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'full_name' => 'required',
            'phone_number' => 'required|max:10',
        ], [
            'email.email' => 'Email chưa đúng định dạng',
            'phone_number.max' => 'Số điện thoại phải là 10 số',
        ]);
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            $apiFormat['status'] = 0;
            $apiFormat['message'] = $message;
            return response()->json($apiFormat);
        }
        $token = \Session::get('token') ?: null;
        $email = \Session::get('email');
        $user = CallApiSeverService::methodGet('api/app-users/get-profile-by-login', ['login' => $email], $token);
        $obj = [
            "id" => $user->id,
            "login" => $request->email,
            "firstName" => null,
            "lastName" => null,
            "fullName" => $request->full_name,
            "email" => $request->email,
            "phone" => $request->phone_number,
            "passpostId" => null,
            "companyName" => $request->company_name,
            "position" => $request->position,
            "taxCode" => $request->tax_code,
            "userType" => $user->userType,
            "address" => null,
            "sex" => null,
            "imageUrl" => null,
            "activated" => 1,
            "appUserContract" => null,
            "appUserDocument" => $user->appUserDocument,
            "birthday" => null,
            "resetDate" => null
        ];
        $data = [
            [
                'name'     => 'obj',
                'contents' => json_encode($obj),
            ]
        ];
        if ($request->hasFile('file_avatar')) {
            $imageDir = 'images\\avatar\\';
            $imagesAvatar = $request->file('file_avatar');
            $extensionAvatar = $imagesAvatar->getClientOriginalExtension();
            $imageNameAvatar = rand(100000, 999999) . '.' . $extensionAvatar;
            $imagesAvatar->move(public_path($imageDir), $imageNameAvatar);
            $link_image = public_path($imageDir) . $imageNameAvatar;
            $data[] =  [
                'name'     => 'file',
                'contents' => Psr7\Utils::tryFopen($link_image, 'r')
            ];
        } else {
            $data[] =  [
                'name'     => 'file',
                'contents' => null
            ];
        }
        if ($request->hasFile('file_cmnd_list')) {
            $imageDir = '/images/cmnd/';
            foreach ($request->file('file_cmnd_list') as $file) {
                $extensionAvatar = $file->getClientOriginalExtension();
                $imageNameAvatar = rand(100000, 999999) . '.' . $extensionAvatar;
                $file->move(public_path($imageDir), $imageNameAvatar);
                $link_image = public_path($imageDir) . $imageNameAvatar;
            }
            $data[] =  [
                'name'     => 'fileDocument',
                'contents' => Psr7\Utils::tryFopen($link_image, 'r')
            ];
        } else {
            $data[] =  [
                'name'     => 'fileDocument',
                'contents' => null
            ];
        }
        // dd($data);
        $apiFormat = CallApiSeverService::methodPut('api/app-users', $data, $token);
        if ($apiFormat->status === 200) {
            if (file_exists($link_image)) {
                \File::delete($link_image);
            }
            \Session::put('email',  $request->email);
        }
        return response()->json($apiFormat);
    }

    public function updatePassUser(Request $request)
    {
        //dd($request->all());
        $apiFormat = [];
        $validator = \Validator::make($request->all(), [
            'password_old' => 'required',
            'password_new' => 'required|min:4|different:password_old',
            'confirm_password_new' => 'required|same:password_new',
        ], [
            'password_old.required' => 'Bạn chưa nhập mật khẩu hiện tại',
            'password_new.required' => 'Bạn chưa nhập mật khẩu mới',
            'password_new.min' => 'Mật khẩu phải có 4 ký tự trở lên',
            'confirm_password_new.required' => 'Bạn chưa nhập lại mật khẩu mới',
            'password_new.different' => 'Mật khẩu mới không được trùng với mật khẩu hiện tại',
            'confirm_password_new.same' => 'Nhập lại mật khẩu mới chưa đúng với mật khẩu mới',
        ]);
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            $apiFormat['status'] = 0;
            $apiFormat['message'] = $message;
            return response()->json($apiFormat);
        }
        $token = \Session::get('token') ?: null;
        $email = \Session::get('email');
        $data = [
            'login'     => $email,
            'currentPassword' => $request->password_old,
            'newPassword' => $request->password_new,
            'confirmPassword' => $request->confirm_password_new,
        ];
        //dd($data);
        $apiFormat = CallApiSeverService::methodPutJson('api/account/change-password-client', $data, $token);
        if ($apiFormat->status === 200) {
            \Session::forget('token');
            \Session::forget('email');
        }
        return response()->json($apiFormat);
    }

    public function forgot_password()
    {
        $user = $this->__checkUser();
        return view('frontend.account.forgot_password', compact('user'));
    }

    public function post_forgot_pass(Request $request)
    {
        //dd($request->all());
        $apiFormat = [];
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
        ], [
            'email.email' => 'Email chưa đúng định dạng',
        ]);
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            $apiFormat['status'] = 0;
            $apiFormat['message'] = $message;
            return response()->json($apiFormat);
        }
        $data = [
            'mail'     => $request->email,
        ];
        //dd($data);
        $apiFormat = CallApiSeverService::methodPostParam('api/account/reset-password/init', $data);
        //dd($apiFormat);
        return response()->json($apiFormat);
    }

    public function logout()
    {
        $apiFormat = (object) [
            'status' => 200,
            'messagge' => 'Thành công'
        ];
        \Session::forget('token');
        \Session::forget('email');
        return response()->json($apiFormat);
    }
}
