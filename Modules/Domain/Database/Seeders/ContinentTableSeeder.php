<?php

namespace Modules\Domain\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Domain\Entities\Continent;

class ContinentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('continents')->delete();
        $continents = [
            [
                'name' => 'Asia',
            ],
            [
                'name' => 'Africa',
            ],
            [
                'name' => 'North America',
            ],
            [
                'name' => 'South America',
            ],
            [
                'name' => 'Antarctica',
            ],
            [
                'name' => 'Europe',
            ],
            [
                'name' => 'Australia',
            ]
        ];

        Continent::insert($continents);

    }
}
