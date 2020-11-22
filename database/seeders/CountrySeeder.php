<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            'Albania',
            'Romania',
            'Brazil',
            'Panama',
            'Comoros',
            'Costa Rica',
            'Dominican Republic',
            'Egypt',
            'Morocco',
            'Ghana',
            'Uganda',
            'Sudan',
            'Honduras',
            'Jordan',
            'Madagascar',
            'Malaysia',
            'Maldives ',
            'Mauritania ',
            'Mauritius',
            'Mongolia',
            'Montenegro',
            'Myanmar',
            'Nepal',
            'Niger',
            'Pakistan',
            'Palestine ',
            'Serbia',
            'South Sudan',
            'Egypt',
            'Swaziland ',
            'Tonga',
            'uganda',
            'Tanzania',
            'Kenya ',
            'Zimbabwe',
            'Jordan PPFA'
        ];

        foreach ($countries as $country) {
            Country::firstOrCreate([
                'name' => $country
            ]);
        }
    }
}
