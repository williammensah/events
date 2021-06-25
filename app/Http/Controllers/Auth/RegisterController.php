<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Google2FA;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers {
    // change the name of the name of the trait's method in this class
    // so it does not clash with my own register method
    register as registration;
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'mobile' => $data['mobileNumber'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => 'active',
            'two_factor_auth' =>'enabled',
            'two_factor_auth_secret' => $data['google2fa_secret'],
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        //Initialise the 2FA class
       // $google2fa = app('pragmarx.google3fa');
        $registrationData = $request->all();
        // Add the secret key to the registration data
        $registrationData['google2fa_secret'] = Google2FA::generateSecretKey();
        // Save the registration data to the user session for just the next request
        $request->session()->flash('registration_data', $registrationData);
        // Generate the QR image. This is the image the user will scan with their app
        // to set up two factor authentication
        $QrImage = Google2FA::getQRCodeInline(
            config('app.name'),
            $registrationData['email'],
            $registrationData['google2fa_secret']
        );
        // Pass the QR barcode image to our view
        return view('google2fa.register', ['QR_Image' => $QrImage, 'secret' => $registrationData['google2fa_secret']]);
    }

    public function completeRegistration(Request $request)
    {
        // add the session data back to the request input
        $request->merge(session('registration_data'));
        // Call the default laravel authentication
        return $this->registration($request);
    }
}
