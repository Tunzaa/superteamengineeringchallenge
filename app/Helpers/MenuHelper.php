<?php

class MenuHelper {

    public static function getMenuFor(User $user) {
        $menu = [];

        if ($user->hasPermission('view_dashboard')) {
            $menu[] = ['name' => 'Dashboard', 'route' => '/dashboard'];
        }
        if ($user->hasPermission('create_sale')) {
            $menu[] = ['name' => 'New Sale', 'route' => '/sales/create'];
        }
        if ($user->hasPermission('export_sales')) {
            $menu[] = ['name' => 'Export', 'route' => '/sales/export'];
        }

        return $menu;
    }
}
