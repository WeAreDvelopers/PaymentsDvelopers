<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $empresa = \App\Models\Empresas::create([
            'nome'=>'Empresa 1',
        ]);
        \App\Models\User::factory()->create([
            'id_empresa' =>$empresa->id,
             'name'     => 'master',
             'email'    => 'master@dvelopers.com.br',
             'role'     =>  'master',
             'email_verified_at' => now(),
             'password' => Hash::make('password'),
        ]);
        \App\Models\User::factory()->create([
            'id_empresa' =>$empresa->id,
             'name'     => 'admin',
             'email'    => 'admin@dvelopers.com.br',
             'role'     =>'admin',
             'email_verified_at' => now(),
             'password' => Hash::make('password'),
        ]);
       

       
    }
}
