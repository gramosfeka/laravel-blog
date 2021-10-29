<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'name' => 'Tag 1'
        ]);

        Tag::create([
            'name' => 'Tag 2'
        ]);
        Tag::create([
            'name' => 'Tag 3'
        ]);
    }
}
