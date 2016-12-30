<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );

        $response = $this->call('GET', '/');

        $this->assertResponseOk();
    }

    public function testloginSuccess()
    {
        $params = [
            'email' => 'user1@example.com',
            'password' => '1234',
        ];

        $response = $this->call('POST', '/auth/login', $params);

        $json = json_decode($response->getContent());


        $this->assertResponseOk();
    }

    public function testloginandcreateuserSuccess()
    {
        $params = [
            'email' => 'user1@example.com',
            'password' => '1234',
        ];

        $response = $this->call('POST', '/auth/login', $params);

        $json = json_decode($response->getContent());

        $this->assertResponseOk();

        $params = [
            'email' => 'test123@test.com',
            'password' => 'testing',
            'firstname' => 'testing',
            'lastname' => 'testing',
            'token' => $json->token,
        ];


        $response = $this->call('POST', '/users', $params);
        $json = json_decode($response->getContent());
        $this->assertResponseOk();

        /*
     * check and test json response
     */
        $this->assertTrue(isset($json->email));
        $this->assertTrue(isset($json->firstname));
        $this->assertTrue(isset($json->lastname));
        $this->assertTrue(isset($json->id));


        /*
    * check and test database data
    */
        $user = \App\User::where('email', 'test123@test.com')->first();
        $this->assertTrue(!empty($user));
        $this->assertTrue(isset($user->email));
        $this->assertEquals('test123@test.com', $user->email);
    }

}
