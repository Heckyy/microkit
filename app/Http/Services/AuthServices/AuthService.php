<?php
namespace App\Http\Services\AuthServices;

use Illuminate\Http\Client\Request;

interface AuthServices
{

    public function processRegisterOauth(string $accessToken);

    public function processRegisterEmail(Request $request);

    public function validator(Request $request);

    public function create(Request $request);
}
