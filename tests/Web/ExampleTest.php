<?php

namespace Tests\Web;

use Tests\TestCaseWeb;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCaseWeb
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
//        $response = $this->get('http://aaaabbb/');

$curl = curl_init();

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, 'http://dev-amy.ogatism.com');

$response = curl_exec($curl);
$error = curl_error($curl);

curl_close($curl);

        $this->assertEquals(false, $response);
    }
}
