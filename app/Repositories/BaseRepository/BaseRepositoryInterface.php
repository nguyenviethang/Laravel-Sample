<?php

namespace App\Repositories\BaseRepository;

interface BaseRepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function getAll($validated);
}
