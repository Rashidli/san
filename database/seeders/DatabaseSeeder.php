<?php

namespace Database\Seeders;

use App\Models\Single;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $superAdmin = Role::create(['name' => 'super-admin']);
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);

        // Create permissions
        $permissions = [
            'list-users', 'create-users', 'edit-users', 'delete-users',
            'list-roles', 'create-roles', 'edit-roles', 'delete-roles',
            'list-permissions', 'create-permissions', 'edit-permissions', 'delete-permissions',
            'list-services', 'create-services', 'edit-services', 'delete-services',
            'list-blogs', 'create-blogs', 'edit-blogs', 'delete-blogs',
            'list-portfolios', 'create-portfolios', 'edit-portfolios', 'delete-portfolios',
            'list-tags', 'create-tags', 'edit-tags', 'delete-tags',
            'list-sliders', 'create-sliders', 'edit-sliders', 'delete-sliders',
            'list-faqs', 'create-faqs', 'edit-faqs', 'delete-faqs',
            'list-reviews', 'create-reviews', 'edit-reviews', 'delete-reviews',
            'list-abouts', 'create-abouts', 'edit-abouts', 'delete-abouts',
            'list-contacts', 'delete-contacts',
            'list-contact_items', 'create-contact_items', 'edit-contact_items', 'delete-contact_items',
            'list-socials', 'create-socials', 'edit-socials', 'delete-socials',
            'list-singles', 'create-singles', 'edit-singles', 'delete-singles',
            'list-words', 'create-words', 'edit-words', 'delete-words',
            'list-images', 'create-images', 'edit-images', 'delete-images',
            'list-settings', 'edit-settings',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign all permissions to admin role
        $admin->givePermissionTo(Permission::all());

        // Create super admin user
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('super-admin');

        // Create SEO pages (Singles)
        $seoPages = [
            ['type' => 'home', 'az' => ['title' => 'Ana Səhifə', 'slug' => 'ana-sehife'], 'en' => ['title' => 'Home', 'slug' => 'home'], 'ru' => ['title' => 'Главная', 'slug' => 'glavnaya']],
            ['type' => 'about', 'az' => ['title' => 'Haqqımızda', 'slug' => 'haqqimizda'], 'en' => ['title' => 'About', 'slug' => 'about'], 'ru' => ['title' => 'О нас', 'slug' => 'o-nas']],
            ['type' => 'services', 'az' => ['title' => 'Xidmətlər', 'slug' => 'xidmetler'], 'en' => ['title' => 'Services', 'slug' => 'services'], 'ru' => ['title' => 'Услуги', 'slug' => 'uslugi']],
            ['type' => 'portfolio', 'az' => ['title' => 'Portfolio', 'slug' => 'portfolio'], 'en' => ['title' => 'Portfolio', 'slug' => 'portfolio-en'], 'ru' => ['title' => 'Портфолио', 'slug' => 'portfolio-ru']],
            ['type' => 'blogs', 'az' => ['title' => 'Bloq', 'slug' => 'bloq'], 'en' => ['title' => 'Blog', 'slug' => 'blog'], 'ru' => ['title' => 'Блог', 'slug' => 'blog-ru']],
            ['type' => 'contact', 'az' => ['title' => 'Əlaqə', 'slug' => 'elaqe'], 'en' => ['title' => 'Contact', 'slug' => 'contact'], 'ru' => ['title' => 'Контакты', 'slug' => 'kontakty']],
        ];

        foreach ($seoPages as $page) {
            Single::create($page);
        }
    }
}
