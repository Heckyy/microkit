<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function login()
    {

        return response()->view('authentication.login');
    }

    public function register()
    {
        return response()->view('authentication.register');
    }

    public function signOut()
    {

        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();



        return redirect('/');
    }

    public function processRegisterOauth(string $accessToken, Request $request)
    {
        // dapatkan user info google
        $data = $this->getGoogleUserInfo($accessToken);

        // jika login google gagal
        if (empty($data)) {
            return redirect()
                ->back()
                ->withErrors('Oops! Something went wrong while trying to sign in with Google. Please try again later.')
                ->withInput();
        }

        // oauth data
        $email = $data['email'];
        $name = $data['name'];
        $picture = $data['picture'];

        $data = [
            'name' => $name,
            'email' => $email
        ];

        $validator = Validator::make($data, [
            'email' => ['unique:users'],
        ]);

        $userFind = User::where('email', $email)->first();

        if ($userFind != null) {

            // jika validator error karena sudah terdaftar google
            if ($userFind->register_type == 'register with google') {
                return redirect()
                    ->back()
                    ->withErrors('email already registered with google')
                    ->withInput();
            }

            // jika validator error karena sudah terdaftar google
            return redirect()
                ->back()
                ->withErrors('email already registered')
                ->withInput();
        }

        if (!$validator->fails()) {

            // pengecekan jika email google oauth belum terdaftar maka daftarkan dan langsung login
            $userExist = User::where('email', $email)
                ->count();

            // daftar akun google oauth
            if ($userExist > 0) {
                // reject login dan suruh create akun di register page
                return redirect()->back()->withErrors('email already registered');
            }

            // save to database
            User::create([
                'name' => $name,
                'email' => $email,
                'picture' => $picture,
                'register_type' => 'register with google'
            ]);

            // pengecekan email jika login menggunakan google
            $user = User::where('email', $email)
                ->where('register_type', 'register with google')
                ->first();

            // jika user berhasil login
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
    }

    public function processRegisterEmail(Request $request)
    {

        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ]);

            $this->create($request);

            return redirect()->back()->with('success', 'Register successfuly');
        } catch (QueryException $e) {

            dd($e);
        }
        // jika tidak berhasil login

    }

    private function create(Request $request)
    {
        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'register_type' => 'register with email',
            'password' => Hash::make($request->input('password')),
        ]);
    }

    private function validatorLoginEmail(Request $request)
    {
        return $validate  = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);
    }

    public function processLoginEmail(Request $request)
    {
        // validator input
        $validate = $this->validatorLoginEmail($request);

        // jika validator berhasil maka akan login
        if (Auth::attempt($validate)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        $email = $request->email;

        // pengecekan untuk user yang login dengan email yang belum terdaftar
        $user = User::where('email', $email)
            ->first();

        // pesan error jika email belum terdaftar
        if (is_null($user)) {
            return redirect()->back()->withErrors('Sorry, we could not find an account with that email. Please make sure you have entered the correct email address or create a new account to proceed.');
        }

        // pengecekan email yang diinput harus register with email
        $user = User::where('email', $email)
            ->where('register_type', 'register with email')
            ->first();

        // pesan error jika email sudah terdaftar menggunakan google
        if (is_null($user)) {
            return redirect()->back()->withErrors('Your email is already associated with a Google account. Please use your Google credentials to sign in or try signing up with a different email.');
        }

        return back()->withErrors([
            'message' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function processLoginOauth(string $accessToken, Request $request)
    {
        // dapatkan user info dari google
        $data = $this->getGoogleUserInfo($accessToken);

        // jika login google gagal, yang disebakan data null dari user info google
        if (empty($data)) {
            return redirect()
                ->back()
                ->withErrors('Oops! Something went wrong while trying to sign in with Google. Please try again later.')
                ->withInput();
        }



        $email = $data['email'];
        $name = $data['name'];

        $data = [
            'name' => $name,
            'email' => $email
        ];

        // pengecekan jika email google oauth belum terdaftar maka daftarkan dan langsung login
        $userExist = User::where('email', $email)
            ->count();

        // daftar akun google oauth
        if ($userExist == 0) {
            // reject login dan suruh create akun di register page
            return redirect()->back()->withErrors('Account not registered. Please register an account first through the registration page before attempting to log in using Google OAuth.');
        }

        // pengecekan email jika login menggunakan google
        $user = User::where('email', $email)
            ->where('register_type', 'register with google')
            ->first();

        // jika login menggunakan google oauth dan email sudah terdaftar secara manual
        if (is_null($user)) {
            return redirect()->back()->withErrors('It looks like your Google email is already linked to another account. Please log in using your original email and password.');
        }

        // jika user berhasil login
        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    private function createUserFromLoginGOauth(array $data)
    {

        $validator = Validator::make($data, [
            'email' => ['unique:users'],
        ]);

        try {
            if (!$validator->fails()) {
                User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'register_type' => 'register with google'
                ]);
                return redirect()->back()->with('success', 'Successful registration using google');
            } else {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        } catch (QueryException $e) {
            dd($e);
        }
    }

    private function getGoogleUserInfo(string $accessToken): array
    {
        $headers = array(
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/oauth2/v2/userinfo');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        if (is_null($data)) {
            return [];
        }

        return $data;
    }
}
