<?php

namespace Tests\Web;

use Tests\TestCaseWeb;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

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
        $response = $this->get(route('amy.home'));
        $this->assertEquals(302, $response->status());
        $user = User::where('id', 1)->first();
        $this->be($user);
        $response = $this->get(route('amy.home'));
        $this->assertEquals(200, $response->status());
//        $this->assertViewHas(['INBOX']);
    }
}
