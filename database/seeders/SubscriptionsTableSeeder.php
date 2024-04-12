<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Website;
// use APP\Models\Website;
class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get all users and websites
        $users = User::all();
        $websites = Website::all();

        // For each user, subscribe them to random websites
        foreach ($users as $user) {
            // Get a random number of websites (between 1 and 3)
            $websitesCount = rand(1, 3);

            // Get random websites
            $subscriptions = $websites->random($websitesCount);

            // Subscribe the user to the websites
            foreach ($subscriptions as $website) {
                DB::table('subscriptions')->insert([
                    'user_id' => $user->id,
                    'website_id' => $website->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}