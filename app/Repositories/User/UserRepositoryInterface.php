<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function find($id);

    public function update($id, $data);
    public function changePassword($id, $data = []);
    public function store($data);
    public function delete($id);
    public function findUser($department_id, $role_id);
}
