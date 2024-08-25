<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_post_category(): void
    {
        $uploadedFile = UploadedFile::fake()->create('test.txt',1);
        $response = $this->post('/_api/category', ['Name'=>'testCategory', 'Specifications'=>'["testSpec"]', 'Updating_id'=>'0', 'Image'=>$uploadedFile]);
        $response->assertStatus(200);
    }
}
