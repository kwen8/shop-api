<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeedRolesAndPermissionsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // 清除缓存
       app()['cache']->forget('spatie.permission.cache');

		// 先创建权限
		Permission::create(['name' => 'goods_item_add']);
		Permission::create(['name' => 'goods_item_delete']);
		Permission::create(['name' => 'goods_category_add']);
		Permission::create(['name' => 'goods_category_delete']);
		Permission::create(['name' => 'edit_settings']);

		// 创建站长角色，并赋予权限
		$superAdmin = Role::create(['name' => 'superAdmin']);
		$superAdmin->givePermissionTo('goods_item_add');
		$superAdmin->givePermissionTo('goods_item_delete');
		$superAdmin->givePermissionTo('goods_category_add');
		$superAdmin->givePermissionTo('goods_category_delete');

		$admin = Role::create(['name' => 'admin']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		// 清除缓存
		app()['cache']->forget('spatie.permission.cache');

		// 清空所有数据表数据
		$tableNames = config('permission.table_names');

		Model::unguard();
		DB::table($tableNames['role_has_permissions'])->delete();
		DB::table($tableNames['model_has_roles'])->delete();
		DB::table($tableNames['model_has_permissions'])->delete();
		DB::table($tableNames['roles'])->delete();
		DB::table($tableNames['permissions'])->delete();
		Model::reguard();
    }
}
