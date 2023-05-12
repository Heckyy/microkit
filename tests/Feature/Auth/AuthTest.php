<?php

namespace Tests\Feature\Auth;

use App\Http\Controllers\AuthenticationController;
use Tests\TestCase;

class AuthTest extends TestCase
{

    public function testDoRegister(): void
    {
        $requestData = ['email' => 'feriwsnssssarta26s2@gmailasd.com', 'passwssorasdd' => 'teasssasssdst', 'nasdssame' => 'feriasssdsaatetetaa'];

        $result = $this->post('/register/do-register', $requestData);

        $this->assertNotNull($result);

        // var_dump($result);

        $this->assertTrue(true);
    }
}
