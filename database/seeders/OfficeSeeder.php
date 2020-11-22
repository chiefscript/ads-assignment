<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = [
            'Europe Office',
            'Economy Division',
            'Ecosystems',
            'Latin America Office',
            'CTCN',
            'West Asia Office',
            'Asia Pacific Office',
            'Africa Office',
            'Policy & Programme Division'
        ];

        foreach ($offices as $office) {
            Office::firstOrCreate([
                'name' => $office
            ]);
        }
    }
}
