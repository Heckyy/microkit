<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        return view("home");
    }

    public function profileSetting()
    {
        return response()->view('profile-setting');
    }

    public function download() {
        return response()->view('download');
    }

    public function update(Request $request)
    {

        try {

            if ($request->registerType == 'register_with_google') {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email'],
                    'newPassword' => ['required', 'same:confPassword', 'string', 'min:8'],
                    'confPassword' => ['required', 'same:newPassword', 'string', 'min:8'],
                ], [
                    'newPassword.same' => 'The new password field must match confirmation password.',
                    'confPassword.same' => 'The confirmation password field must match new password.'
                ]);
            } else {

                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                ]);
            }




            $user = User::where('id', $request->idUser)->where('register_type', $request->registerType)->first();

            // jika user tidak ditemukan
            if (is_null($user)) {
                return redirect()->back()->withErrors('something went wrong');
            }


            if ($user != null) {

                if ($user->register_type == 'register with google') {
                    $this->saveUserGoogleOauth($user, $request);
                } else {
                    $this->saveUserEmail($user, $request);
                }

                return redirect()->back()->with('success', 'Your profile has been updated successfully.');
            }

            // return redirect()->back()->with('success', 'Register successfuly');
        } catch (QueryException $e) {

            dd($e);
        }
    }

    private function saveUserEmail(User $user, Request $request)
    {
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = Hash::make($request->newPassword);

        $user->save();
    }


    private function saveUserGoogleOauth(User $user, Request $request)
    {
        $user->name = $request->name;
        $user->save();
    }
}
