<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        User::truncate();
        DB::table('role_user')->truncate();
        $adminroleadmin = Role::where('name','admin')->first();
        $adminroleauthor = Role::where('name','author')->first();
        $adminrolesubscriber = Role::where('name','subscriber')->first();

//        $adminroleadmin = DB::table('roles')->where('name','admin')->first();
//        $adminroleauthor = DB::table('roles')->where('name', 'author')->first();
//        $adminrolesubscriber = DB::table('roles')->where('name', 'subscriber')->first();



        $adminadmin = User::create([
            'name'=>'Christopher Oludhe',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('password')
            ]);


        $adminauthor = User::create([
            'name'=>'Christopher Mcludhe',
            'email'=>'author@author.com',
            'password'=>Hash::make('password')
        ]);


        $adminsubscriber = User::create([
            'name'=>'Andrew Oludhe',
            'email'=>'subscriber@subscriber.com',
            'password'=>Hash::make('password')
        ]);

        $adminadmin->roles()->attach($adminroleadmin);
        $adminauthor->roles()->attach($adminroleauthor);
        $adminsubscriber->roles()->attach($adminrolesubscriber);
    }

}
