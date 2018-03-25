<?php

use App\User;
use Enea\Authorization\Repositories\PermissionRepository;
use Enea\Authorization\Repositories\RoleRepository;
use Enea\Authorization\Repositories\Struct;
use Illuminate\Database\Seeder;

class AuthorizationsSeeder extends Seeder
{
    private $permissionRepository;

    private $roleRepository;

    public function __construct(PermissionRepository $permissionRepository, RoleRepository $roleRepository)
    {
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
    }

    public function run(): void
    {
        $permissions = $this->permissionRepository->createMultiple([
            Struct::create('Create Articles'),
            Struct::create('Modify Articles'),
            Struct::create('Destroy Articles'),
        ]);

        $role = $this->roleRepository->create('Admin');
        $role->grantMultiple($permissions->all());

        $this->user('user@enea.io')->grantMultiple($permissions->all());
        $this->user('hello@enea.io')->grant($role);
    }

    private function user(string $email): User
    {
        return User::query()->where('email', $email)->first();
    }
}
