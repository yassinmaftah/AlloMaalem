<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Job;
use App\Models\Application;
use App\Models\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Plomberie', 'Électricité', 'Peinture', 'Menuiserie', 'Jardinage', 'Maçonnerie'];
        foreach ($categories as $cat) {
            Category::create(['name' => $cat, 'icon' => 'fa-solid fa-toolbox']);
        }

        $Admin = User::factory()->create(['name' => 'Yassine Maftah','email' => 'admin@allomaalem.com','role' => 'admin',]);
        $client = User::factory()->create(['name' => 'Yassine Bahajou', 'email' => 'YassineBahajou@gmail.com', 'role' => 'client']);
        $maalem = User::factory()->create(['name' => 'Oussama Kara', 'email' => 'OussamaKara@gmail.com', 'role' => 'maalem']);

        User::factory(20)->create();

        $clients = User::where('role', 'client')->get();
        $cats = Category::all();

        foreach($clients as $c) {
            Job::factory(3)->create([
                'user_id' => $c->id,
                'category_id' => $cats->random()->id,
            ]);
        }

        $jobs = Job::where('status', 'open')->get();
        $maalems = User::where('role', 'maalem')->get();

        foreach($jobs as $job) {
            $applicants = $maalems->random(2);
            foreach($applicants as $applicant)
            {
                Application::factory()->create(['job_id' => $job->id,'user_id' => $applicant->id,]);
            }
        }

        $completedJobs = Job::where('status', 'completed')->get();

        foreach($completedJobs as $job) {
            $randomMaalem = $maalems->random();

            Review::factory()->create([
                'job_id' => $job->id,
                'reviewer_id' => $job->user_id,
                'reviewed_id' => $randomMaalem->id,
                'rating' => fake()->numberBetween(3, 5),
                'comment' => fake()->sentence(),
            ]);
        }
    }
}
