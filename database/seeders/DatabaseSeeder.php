<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Author;
use App\Models\Beat;
use App\Models\Category;
use App\Models\File;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@email.net',
            'password' => Hash::make('password'),
            'is_admin' => 1
        ]);


        Author::create(['name' => 'Автор1']);
        Author::create(['name' => 'Автор2']);
        Author::create(['name' => 'Автор3']);

        Category::create(['name' => 'Караоке']);
        Category::create(['name' => 'Не караоке']);

        $prices = [1999, 2499, 3900];

        for($i = 1; $i <= 5; $i++){
            Beat::create(
                [
                    'author_id' => rand(1,3),
                    'category_id' => rand(1,2),
                    'name' => 'Бит'.$i,
                    'price' => $prices[rand(0,2)]
                ]
            );
        }

        $statuses = ['done', 'fail', 'wait'];

        foreach (Beat::pluck('id')->all() as $track_id) {
            Payment::create(['beat_id' => $track_id, 'user_id' => 1, 'price' => $prices[rand(0,2)], 'status' => $statuses[rand(0,2)]]);
            DB::table('users_beats')->insert(['user_id' => 1, 'beat_id' => $track_id]);
            File::create(['fileable_type' => 'App\Models\Beat' ,'fileable_id' => $track_id, 'src' => '/track'.$track_id.'.mp3']);
        }

        for ($i = 0; $i < 100; $i++){
            Payment::create(['beat_id' => 1, 'user_id' => 1, 'price' => $prices[rand(0,2)], 'status' => $statuses[rand(0,2)]]);
        }
    }
}
