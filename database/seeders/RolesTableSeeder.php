<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create([
            'slug' => 'administrateur',
            'name' => 'Administrateur' 
        ]);

        Role::create([
            'slug' => 'superviseur',
            'name' => 'Superviseur' 
        ]);

        Role::create([
            'slug' => 'caisse',
            'name' => 'Caisse' 
        ]);

        Role::create([
            'slug' => 'gestionnaire',
            'name' => 'Gestionnaire' 
        ]);
        
    }
}
