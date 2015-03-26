<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        // id = 1
        $admin_role = new Role;
        $admin_role->name = 'admin';
        $admin_role->save();

        // id = 2
        $affair_manager_role = new Role;
        $affair_manager_role->name = 'affairs manager';
        $affair_manager_role->save();

        // id = 3
        $affair_translator_role = new Role;
        $affair_translator_role->name = 'affairs translator';
        $affair_translator_role->save();

        // id = 4
        $categories_manager_role = new Role;
        $categories_manager_role->name = 'categories manager';
        $categories_manager_role->save();

        // id = 5
        $categories_translator_role = new Role;
        $categories_translator_role->name = 'categories translator';
        $categories_translator_role->save();

        // id = 6
        $user_manager_role = new Role;
        $user_manager_role->name = 'users manager';
        $user_manager_role->save();

        $user = User::where('username','=','admin')->first();
        $user->attachRole( $admin_role );
    }
}
