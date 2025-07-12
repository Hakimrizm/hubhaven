<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Partner;
use App\Models\Place;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Comment;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory()->create();
        // \App\Models\Partner::factory(5)->create();
        // \App\Models\Place::factory(5)->create();
        $faker = Faker::create();

        $users = [];
        for ($i = 0; $i < 100; $i++) {
            $users[] = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'role' => 'user', // default, nanti 50 diubah jadi partner
                'password' => bcrypt('password'),
                'profile' => null,
                'remember_token' => Str::random(10),
            ]);
        }

        $partnersUser = collect($users)->shuffle()->take(50);
        $partners = [];
        foreach ($partnersUser as $user) {
            $user->update(['role' => 'partner']);

            $partners[] = Partner::create([
                'user_id' => $user->id,
                'partner_address' => $faker->address,
                'partner_location_url' => $faker->url,
                'partner_bussiness_name' => $faker->company,
                'partner_phone' => $faker->unique()->phoneNumber,
                'partner_description' => $faker->paragraph,
            ]);
        }

        $places = [];
        foreach($partners as $partner){
            $count = rand(1, 5);

            for ($i = 0; $i < $count; $i++) {
                $places[] = Place::create([
                    'partner_id' => $partner->id,
                    'place_name' => $faker->company . ' Space',
                    'place_description' => $faker->text,
                    'place_type' => $faker->randomElement(['studio', 'field', 'co_working', 'meeting_room', 'etc']),
                    'place_price_per_hour' => $faker->randomFloat(2, 50, 500),
                    'place_location_url' => $faker->url,
                    'place_address' => $faker->address,
                    'place_open_time' => '08:00:00',
                    'place_close_time' => '22:00:00',
                ]);
            }
        }

        $usersOnly = collect($users)->diff($partnersUser);
        foreach($places as $place){
            $bookingCount = rand(3, 8);

            for($i = 0; $i < $bookingCount; $i++){
                $user = $usersOnly->random();
                $start = $faker->dateTimeBetween('-2 months', '+1 months');
                $duration = rand(1, 3); // jam
                $end = (clone $start)->modify("+{$duration} hours");

                Booking::create([
                    'user_id' => $user->id,
                    'place_id' => $place->id,
                    'booking_start_time' => $start,
                    'booking_end_time' => $end,
                    'status' => $faker->randomElement(['pending', 'confirmed', 'canceled', 'complete']),
                ]);

                if (rand(0, 1)) {
                    Review::create([
                        'user_id' => $user->id,
                        'place_id' => $place->id,
                        'review_rating' => rand(1, 5),
                    ]);

                    Comment::create([
                        'user_id' => $user->id,
                        'place_id' => $place->id,
                        'comment_content' => $faker->sentence,
                    ]);
                }
            }
        }
    }
}
