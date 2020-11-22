<?php

namespace Database\Seeders;

use App\Models\ReadinessType;
use Illuminate\Database\Seeder;

class ReadinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Capacity Building',
            'FI/TNA/other',
            'Capacity Building',
            'NAP',
            'REDD+'
        ];
        foreach ($types as $type) {
            ReadinessType::firstOrCreate([
                'name' => $type
            ]);
        }
    }
}
