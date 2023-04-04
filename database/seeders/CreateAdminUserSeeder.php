<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        $user = User::create([
            'first_name' => 'raphael',
            'last_name' => 'siphael',
            'email' => 'admin@gmail.com',
            'phone' =>'0712544816',
            'address' => 'dar',
            'gender'=>'ME',
            'password' => bcrypt('12345'),
            'created_at'=> $date,
            // 'updated_at'=>$date,


        ]);

        $role = Role::where('name','SuperAdmin')->get();



        $user->assignRole([$role]);


}
}
