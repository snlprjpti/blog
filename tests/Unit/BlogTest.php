<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

//
//    public function testCreateBlogWithMiddleware()
//    {
//        $data = [
//            'title' => "New Product",
//            'description' => "This is a product",
//            'published_date' => Carbon::now(),
//            'user_id' => 1,
//        ];
//
//        $response = $this->json('POST', '/api/blogs',$data);
//        $response->assertStatus(401);
//        $response->assertJson(['message' => "Unauthenticated."]);
//    }
}
