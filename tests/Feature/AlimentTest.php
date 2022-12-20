<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Aliment;
use App\Models\User;

class AlimentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_aliment()
    {
        $user = User::where('id', 1)->first();
        $test_aliment = [
            'name' => 'Aguacate',
            'measure' => 'g.',
            'kcalories' => 200,
            'protein' => 5,
            'lipids' => 30,
            'glucids' => 0,
            '_token'=>'test' //here
        ];
        $response = $this->actingAs($user)->post('/add-aliment', $test_aliment);
        $response->assertTrue(!$response['error']);

        //$aliment = Aliment::where('name', $test_aliment['name'])->first();


    }
}
