<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\CommentsService;

class CommentsServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $service = new CommentsService();
        $comments = $service->getLists();
        $this->assertTrue(!empty($comments));
    }
}
