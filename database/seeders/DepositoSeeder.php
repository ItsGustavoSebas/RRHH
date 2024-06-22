<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DepositoSeeder extends Seeder
{
    public function run()
    {
        DB::table('depositos')->insert([
            [
                'empleado_id' => 1,
                'depositado' => false,
                'fecha' => Carbon::now()->subDays(10),
                'monto' => 1000.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'empleado_id' => 2,
                'depositado' => true,
                'fecha' => Carbon::now()->subDays(5),
                'monto' => 2000.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'empleado_id' => 3,
                'depositado' => false,
                'fecha' => Carbon::now(),
                'monto' => 1500.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
