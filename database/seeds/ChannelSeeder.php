<?php

use App\Channel;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
            'name' => 'Laravel',
            'slug' => str_slug('laravel 5.8'),
        ]);

        Channel::create([
            'name' => 'Java',
            'slug' => str_slug('Java 7'),
        ]);

        Channel::create([
            'name' => 'Vue js',
            'slug' => str_slug('Vue js'),
        ]);

        Channel::create([
            'name' => 'React Native',
            'slug' => str_slug('React Native'),
        ]);
    }
}
