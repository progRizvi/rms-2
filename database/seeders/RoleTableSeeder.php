<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'=>'Super Admin',
                'slug'=>'super-admin'
            ],
            [
                'name'=>'Admin',
                'slug'=>'admin'
            ],
        ];

        foreach($data as $info){
            Role::create($info);
        }
    }
}
