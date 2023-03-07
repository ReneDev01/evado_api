<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        DB::table('role_user')->truncate();

        $admin = User::create([
            'name' => 'Tegi',
            'surname' => 'Dbla',
            'phone' => '93448686',
            'password' => bcrypt("Dbla2022"),
            'sexe' => "Masculin",
        ]);

        $adminRole = Role::where('slug', 'administrateur')->first();

        $admin->roles()->attach($adminRole);
    }
}
