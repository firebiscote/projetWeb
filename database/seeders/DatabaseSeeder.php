<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Locality, Offer, Promotion, Center, User, Company, Rating, Right, Skill};
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $localities = [
            'Bordeaux',
            'Paris',
            'Marseille',
            'Arbanats',
            'Tour',
            'Lille',
            'Lyon',
            'Begle',
            'Merignac',
        ];

        $promotions = [
            'A1',
            'A2',
            'A3',
            'A4',
            'A5',
        ];

        $centers = [
            'Bordeaux',
            'Tour',
            'Lille',
            'Nice',
            'Toulouse',
        ];

        $ids = range(1, 5);
        
        foreach($promotions as $promotion) {
            Promotion::create(['name' => $promotion, 'slug' => Str::slug($promotion)]);
        }

        foreach($localities as $locality) {
            Locality::create(['name' => $locality, 'slug' => Str::slug($locality)]);
        }

        foreach($centers as $center) {
            Center::create(['name' => $center, 'slug' => Str::slug($center)]);
        }

        Skill::factory(30)->create();

        Center::factory(10)->create();

        Right::factory(20)->create();

        User::factory()->count(30)->create()->each(function ($user) use ($ids) {
            shuffle($ids);
            $user->promotions()->attach(array_slice($ids, 0, rand(1,4)));
        });

        Offer::factory()->count(40)->create()->each(function ($offer) use ($ids) {
            shuffle($ids);
            $offer->promotions()->attach(array_slice($ids, 0, rand(1,4)));
            shuffle($ids);
            $offer->skills()->attach(array_slice($ids, 0, rand(1,4)));
            shuffle($ids);
            $offer->users()->attach(array_slice($ids, 0, rand(1,4)));
        });

        Rating::factory(20)->create();
    }
}
