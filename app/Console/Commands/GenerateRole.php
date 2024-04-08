<?php

namespace App\Console\Commands;

use App\Enums\Roles;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class GenerateRole extends Command
{
    protected $signature = 'role:generate';

    protected $description = 'Command for generate all of role in system';

    public function handle()
    {

        $this->call('shield:install');

        collect(Roles::asArray())
            ->filter(function ($it) {
                return $it !== Roles::SUPER_ADMIN;
            })
            ->each(function ($it) {
                Role::create([
                    'name' => $it,
                    'guard_name' => 'web'
                ]);
            });

        if (config('app.env') == 'local') {
            $users = [
                [
                    'name' => 'Test User',
                    'email' => 'user@local.dev',
                    'password' => bcrypt('password'),
                    'role' => Roles::USER
                ],
                [
                    'name' => 'Test Admin',
                    'email' => 'admin@local.dev',
                    'password' => bcrypt('password'),
                    'role' => Roles::ADMIN
                ]
            ];

            foreach ($users as $user) {
                $u = User::create($user);
                $u->assignRole($user['role']);
            }
        }

        $this->info('Roles created');
    }
}
