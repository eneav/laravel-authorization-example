<?php

use App\User;
use Enea\Authorization\Repositories\PermissionRepository;
use Enea\Authorization\Repositories\RoleRepository;
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
        $create = $this->permissionRepository->create('Create Articles');
        $modify = $this->permissionRepository->create('Modify Articles');
        $destroy = $this->permissionRepository->create('Destroy Articles');

        $role = $this->roleRepository->create('Admin');
        $role->grantMultiple([$create, $modify, $destroy]);

        $this->user('user@enea.io')->grantMultiple([$create, $modify, $destroy]);
        $this->user('hello@enea.io')->grant($role);
        $this->user('editor@enea.io')->grant($modify);
        $this->user('creator@enea.io')->grant($create);
        $this->user('destroyer@enea.io')->grant($destroy);
    }

    private function user(string $email): User
    {
        return User::query()->where('email', $email)->first();
    }
}
