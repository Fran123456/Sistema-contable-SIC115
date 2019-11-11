<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CuentaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cuentas')->insert([
            'codigo' => '1103',
            'nombre' => 'IVA - CREDITOS FISCAL',
            'tipo' => 'ACTIVO'
        ]);

        DB::table('Cuentas')->insert([
            'codigo' => '2106',
            'nombre' => 'IVA - DEBITO FISCAL',
            'tipo' => 'PASIVO'
        ]);
    }
}
