<?php

namespace App\Repositories\Department;

use App\Repositories\BaseRepository\BaseRepositoryInterface;

interface DepartmentRepositoryInterface extends BaseRepositoryInterface
{
    public function find($id);
    public function getDepart();
    public function getListDepart();
    public function storeDepart($data);
    public function updateDepart($id, $data);
    public function deleteDepart($id);
}
