<?php

namespace App\Http\Controllers\Frontend;

use App\Components\FlashMessages;
use App\Http\Controllers\BaseController;
use App\Models\PasswordReset;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\ViewedProduct\ViewedProductRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use function redirect;

class LoginController extends BaseController
{
    protected $customerRepository;
    protected $viewedProductRepository;
    use FlashMessages;

    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        ViewedProductRepositoryInterface $viewedProductRepository
    )
    {
        $this->customerRepository = $customerRepository;
        $this->viewedProductRepository = $viewedProductRepository;
    }

    public function register()
    {
        if(auth()->guard('customer')->check()){
            return redirect()->route('home');
        }
        return view('frontend.login.register');
    }

    public function registerPost(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                    'fullname' => 'required',
                    'email' => 'nullable|email|unique:customers',
                    'phone_number' => 'required|unique:customers,phone',
                    'password' => 'required|min:6|max:20',
                    'password_confirm' => 'required|same:password'
                ],
                [
                    '*.required' => 'Vui lòng nhập đủ trường bắt buộc.',
                    'email.unique' => 'Mail bạn nhập đã tồn tại.',
                    'phone.unique' => 'Số điện thoại bạn nhập đã tồn tại.',
                    'password.min' => 'Mật khẩu tối thiểu 6 ký tự.',
                    'password.max' => 'Mật khẩu tối đa 20 ký tự.',
                    'password_confirm.same' => 'Mật khẩu xác nhận không đúng.',
                ]
            );
            if ($validator->fails()) {
                self::message('danger', $validator->errors()->first());
                return redirect()->back()->withInput();
            }
            $data = [
                'full_name' => $request->fullname,
                'user_name' => $request->phone_number,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone_number,
                'birthdate' => $request->birthdate,
                'sex' => $request->sex,
                'is_active' => 1
            ];

//            if ($request->birthdate && Carbon::createFromFormat('d/m/Y', $request->birthdate)->format('d/m/Y')){
//                $data['birthdate'] = Carbon::createFromFormat('d/m/Y', $request->birthdate)->format('Y-m-d');
//            }
            if ($request->email){
                $data['email'] = $request->email;
            }

            $customer = $this->customerRepository->create($data);
            Auth::guard('customer')->login($customer);
            $this->handleViewedProductsAfterLogin($customer->id);

            DB::commit();
            return redirect()->route('customer.info');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::notice("Create customer failed because " . $e);
            self::message('danger', 'Tạo tài khoản thất bại! Vui lòng liên hệ CSKH để được hỗ trợ');
            return redirect()->back()->withInput();
        }
    }

    public function login()
    {
        if(auth()->guard('customer')->check()){
            return redirect()->route('home');
        }
        return view('frontend.login.login');
    }

    public function loginPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required|min:6|max:20'
            ],[
                '*.required' => 'Vui lòng nhập đủ thông tin bắt buộc!',
                'password.min' => 'Mật khẩu tối thiểu 6 ký tự.',
                'password.max' => 'Mật khẩu tối đa 20 ký tự.'
            ]
        );
        if ($validator->fails()) {
            self::message('danger', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        try {
            $dataLogin1 = [
                'user_name' => $request->email,
                'password' => $request->password,
                'is_active' => 1
            ];
            $dataLogin2 = [
                'email' => $request->email,
                'password' => $request->password,
                'is_active' => 1
            ];

            if (Auth::guard('customer')->attempt($dataLogin1) || Auth::guard('customer')->attempt($dataLogin2)) {
                $customer = $request->user('customer');
                Auth::guard('customer')->login($customer);
                $this->handleViewedProductsAfterLogin($customer->id);
                return redirect()->route('customer.info');
            } else {
                self::message('danger', 'Tài khoản hoặc mật khẩu không đúng!');
                return redirect()->back()->withInput();
            }
        } catch (\Exception $e) {
            Log::notice("Login failed " . $e->getMessage() .' ' . Carbon::now());
            self::message('danger', 'Đăng nhập thất bại, vui lòng liên hệ với chúng tôi để được hỗ trợ!');
            return redirect()->route('login');
        }
    }

    public function logout(Request $request)
    {
        if(auth()->guard('customer')->check()){
            Auth::guard('customer')->logout();
        }

        return redirect()->route('home');
    }

    public function handleViewedProductsAfterLogin($customer_id)
    {
        if (Session::has('viewed_products')) {
            $viewedProductsInSession = Session::pull('viewed_products');
            //update database
            foreach ($viewedProductsInSession as $item) {
                $viewedProduct = $this->viewedProductRepository->findWhereFirst(['customer_id'=>$customer_id,'product_id'=>$item],['id']);
                if ($viewedProduct) {
                    $this->viewedProductRepository->update(['updated_at'=>Carbon::now()], $viewedProduct->id);
                } else {
                    $this->viewedProductRepository->create([ 'customer_id' => $customer_id,'product_id' => $item]);
                }
            }
        }
        //get 4 latest viewed product
        $viewedProductsInDatabase = $this->viewedProductRepository->findWhereOrderByLimit(
            ['customer_id'=>$customer_id],['product_id'],'updated_at','DESC', 10
        );
        $viewedProducts = array();
        if ($viewedProductsInDatabase) {
            foreach ($viewedProductsInDatabase as $val) {
                array_push($viewedProducts, $val->product_id);
            }
        }
        Session::put('viewed_products', $viewedProducts);
    }

    public function forgotPass()
    {
        if(auth()->guard('customer')->check()){
            return redirect()->route('home');
        }
        return view('frontend.login.forget_password');
    }

    public function sendMailUpdatePass(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:customers'
            ],[
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Không đúng định dạng email.',
                'email.exists' => 'Email không khả dụng, vui lòng thử lại.'
            ]
        );

        if ($validator->fails()) {
            self::message('danger', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        try {
            DB::beginTransaction();
            $token = Str::random(64);
            PasswordReset::create([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            $customer = $this->customerRepository->findWhereFirst(['email'=> $request->email, 'is_active'=>1], ['id', 'full_name','email', 'is_active']);
            if ($customer) {
                Mail::send('frontend.login.mailForgotPass', ['token' => $token, 'full_name' => $customer->full_name], function ($message) use ($request) {
                    $message->to($request->email);
                    $message->subject('Quên mật khẩu');
                });

                self::message('success', 'Một đường link xác nhận đã được gửi đến email của bạn. Vui lòng kích hoạt và làm theo hướng dẫn!');
                return redirect()->route('forget_password');
            }

            DB::commit();
            self::message('danger', 'Tài khoản hoặc mật khẩu không đúng!');
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::notice("Send mail forget fail " . $e .' ' . Carbon::now());
            self::message('danger', 'Gửi mail lỗi, vui lòng liên hệ với chúng tôi để được hỗ trợ!');
            return redirect()->route('forget_password');
        }

    }

    public function showResetPasswordForm($token)
    {
        return view('frontend.login.formResetPassword', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {

        $request->validate(
            [
                'password' => 'required|confirmed',
                'password_confirmation' => 'required'
            ],
            [
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.confirmed' => 'Mật khẩu không chính xác',
                'password_confirmation.required' => 'Vui lòng nhập lại mật khẩu',
            ]
        );

        $updatePassword = PasswordReset::where(['token' => $request->token])->first();
        if ($updatePassword) {
            return back()->withInput()->withErrors(['err_noti' => ['Sai token!']]);
        }
        $user_email = PasswordReset::where('token', $request->token)->first();
        // update password new
        $this->customerRepository->updateWhere(['email' => $user_email->email],['password' => Hash::make($request->password)]);
        dd($request);
        // delete PasswordReset
        PasswordReset::where(['email' => $user_email->email])->delete();
        return redirect()->route('login')->withErrors(['err_success' => ['Đổi mật khẩu thành công, bạn có thể đăng nhập']]);
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}
