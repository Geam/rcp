<?php

class PermissionsTableSeeder extends Seeder {

  public function run()
  {
    DB::table('permissions')->delete();

    $permissions = array(
      array( // 1
        'name'         => 'manage_affairs',
        'display_name' => 'Manage affairs'
      ),
      array( // 2
        'name'         => 'affair_translation',
        'display_name' => 'Affair translation'
      ),
      array( // 3
        'name'         => 'manage_categories',
        'display_name' => 'Manage categories'
      ),
      array( // 4
        'name'         => 'categories_translation',
        'display_name' => 'Categories translation'
      ),
      array( // 5
        'name'         => 'manage_users',
        'display_name' => 'Manage users'
      ),
      array( // 6
        'name'         => 'manage_roles',
        'display_name' => 'Manage roles'
      ),
    );

    DB::table('permissions')->insert( $permissions );

    DB::table('permission_role')->delete();

    $role_id_admin = Role::where('name', '=', 'admin')->first()->id;
    $role_id_aff_man = Role::where('name', '=', 'affairs manager')->first()->id;
    $role_id_aff_tran = Role::where('name', '=', 'affairs translator')->first()->id;
    $role_id_cat_man = Role::where('name', '=', 'categories manager')->first()->id;
    $role_id_cat_tran = Role::where('name', '=', 'categories translator')->first()->id;
    $role_id_user_man = Role::where('name', '=', 'users manager')->first()->id;

    $permission_base = (int)DB::table('permissions')->first()->id - 1;

    $permissions = array(
      array(
        'role_id'       => $role_id_admin,
        'permission_id' => $permission_base + 1
      ),
      array(
        'role_id'       => $role_id_admin,
        'permission_id' => $permission_base + 2
      ),
      array(
        'role_id'       => $role_id_admin,
        'permission_id' => $permission_base + 3
      ),
      array(
        'role_id'       => $role_id_admin,
        'permission_id' => $permission_base + 4
      ),
      array(
        'role_id'       => $role_id_admin,
        'permission_id' => $permission_base + 5
      ),
      array(
        'role_id'       => $role_id_admin,
        'permission_id' => $permission_base + 6
      ),
      array(
        'role_id'       => $role_id_aff_man,
        'permission_id' => $permission_base + 1
      ),
      array(
        'role_id'       => $role_id_aff_man,
        'permission_id' => $permission_base + 2
      ),
      array(
        'role_id'       => $role_id_aff_tran,
        'permission_id' => $permission_base + 2
      ),
      array(
        'role_id'       => $role_id_cat_man,
        'permission_id' => $permission_base + 3
      ),
      array(
        'role_id'       => $role_id_cat_man,
        'permission_id' => $permission_base + 4
      ),
      array(
        'role_id'       => $role_id_cat_tran,
        'permission_id' => $permission_base + 4
      ),
      array(
        'role_id'       => $role_id_user_man,
        'permission_id' => $permission_base + 5
      )
    );

    DB::table('permission_role')->insert( $permissions );
  }

}
