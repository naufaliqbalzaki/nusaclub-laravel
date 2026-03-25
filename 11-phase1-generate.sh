#!/usr/bin/env bash
set -e

cd /c/xampp/htdocs/nusaclub-laravel

php artisan make:model Program -m
php artisan make:model Package -m
php artisan make:model Student -m
php artisan make:model MonthlyBill -m
php artisan make:model Payment -m

php artisan make:migration add_role_and_is_active_to_users_table --table=users
php artisan make:migration add_program_id_and_status_to_pendaftarans_table --table=pendaftarans

php artisan make:controller Admin/AuthController
php artisan make:controller Admin/DashboardController
php artisan make:controller Admin/PendaftaranController
php artisan make:middleware AdminMiddleware
php artisan make:seeder AdminUserSeeder

mkdir -p resources/views/admin/auth
mkdir -p resources/views/admin/dashboard
mkdir -p resources/views/admin/pendaftarans
mkdir -p resources/views/admin/layouts
mkdir -p resources/views/admin/partials

touch resources/views/admin/auth/login.blade.php
touch resources/views/admin/dashboard/index.blade.php
touch resources/views/admin/pendaftarans/index.blade.php
touch resources/views/admin/layouts/app.blade.php
touch resources/views/admin/partials/sidebar.blade.php
touch resources/views/admin/partials/navbar.blade.php

echo "[OK] Tahap 1 generator selesai"