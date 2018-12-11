<?php

use Faker\Generator as Faker;

$factory->define(Modules\Domain\Entities\Tld::class, function (Faker $faker) {
    static $sequence = 1;
    return [
        'name' => $faker->unique()->randomElement(['.com', '.net', '.biz', '.au', '.org', '.xxx', '.live', '.test', '.name', '.ca', '.in']),
        'sequence' => $sequence++,
        'feature' => $faker->randomElement(['Popular', 'Regular']),
        'is_active_for_sale' => $faker->boolean,
        'registrar' => $faker->randomElement(['OpenSRS', 'ResellerClub', 'Both']),
    ];
});
