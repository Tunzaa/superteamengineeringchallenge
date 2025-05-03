<?php
namespace App\Helpers;


class MenuHelper {

//    public static function getMenuFor(User $user) {
//        $menu = [];
//
//        if ($user->hasPermission('view_dashboard')) {
//            $menu[] = ['name' => 'Dashboard', 'route' => '/dashboard'];
//        }
//        if ($user->hasPermission('create_sale')) {
//            $menu[] = ['name' => 'New Sale', 'route' => '/sales/create'];
//        }
//        if ($user->hasPermission('export_sales')) {
//            $menu[] = ['name' => 'Export', 'route' => '/sales/export'];
//        }
//
//        return $menu;
//    }
    
    public static function getMenuFor($user) {
        return [
            ['name' => 'Dashboard', 'route' => '/dashboard'],
            //['name' => 'Sales', 'route' => '/sales'],
            ['name' => 'New Sale', 'route' => '/sales/create'],
            //['name' => 'Export Sales', 'route' => '/sales/export'],
            ['name' => 'Products', 'route' => '/products'],
            //['name' => 'Add Product', 'route' => '/products/create'],
            //['name' => 'Export Inventory', 'route' => '/products/inventory/export'],
        ];
    }
}
