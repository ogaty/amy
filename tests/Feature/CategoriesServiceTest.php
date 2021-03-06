<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \App\Services\CategoriesService;

class CategoriesServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetList()
    {
        $category = new CategoriesService();
        $list = $category->getList();
        $this->assertNotEmpty($list);
    }

    public function testGetDetail()
    {
        $category = new CategoriesService();
        $detail = $category->getListDetail(1);
        $this->assertNotEmpty($detail);
    }

    public function testAddCategory()
    {
        $category = new CategoriesService();
        $detail = $category->addCategory("");
        $this->assertEquals($detail['error'], 1);
        $detail = $category->addCategory([]);
        $this->assertEquals($detail['error'], 2);
        $detail = $category->addCategory(['name' => '']);
        $this->assertEquals($detail['error'], 3);
        $detail = $category->addCategory(['name' => 'testCate']);
        $this->assertEquals($detail['name'], 'testCate');
    }

    public function testUpdateCategory()
    {
        $category = new CategoriesService();
        $detail = $category->addCategory(['name' => 'testCate1']);
        $category->updateCategory(['id' => $detail['id'], 'name' => 'testCate2']);
        $detail = $category->getListDetail($detail['id']);
        $this->assertEquals($detail['name'], 'testCate2');
    }
}
