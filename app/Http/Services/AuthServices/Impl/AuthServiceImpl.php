<?php

namespace App\Http\Services\AuthServices\Impl;

use App\Http\Services\AuthServices\AuthServices;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthServiceImpl
{

    public function processRegisterOauth(string $accessToken)
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

        $email = $data['email'];
        $name = $data['name'];

        $data = [
            'name' => $name,
            'email' => $email
        ];

        $validator = Validator::make($data, [
            'email' => ['unique:users'],
        ]);

        if (!$validator->fails()) {

            User::create([
                'name' => $name,
                'email' => $email,
                'register_type' => 'register with google'
            ]);

            return redirect('/');
        } else {

            $userFind = User::where('email', $email)->first();

            if ($userFind->exists()) {

                // jika validator error karena sudah terdaftar google
                if ($userFind->register_type == 'register with google') {
                    return redirect()
                        ->back()
                        ->withErrors('email already registered with google')
                        ->withInput();
                }

                // jika validator error karena sudah terdaftar email
                return redirect()
                    ->back()
                    ->withErrors('email already registered')
                    ->withInput();
            }
        }
    }

    public function processRegisterEmail(Request $request)
    {

        try {
            $validator = $this->validator($request);

            if (!$validator->fails()) {
                $newUser = $this->create($request);

                return redirect()->back()->with('success', 'Register successfuly');
            } else {
                // jika validator error
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        } catch (QueryException $e) {

            dd($e);
        }
    }

    public function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    public function create(Request $request)
    {
        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'register_type' => 'register with email',
            'password' => Hash::make($request->input('password')),
        ]);
    }
}
