<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

class CommonRepository
{
    private $table;
    public function __construct(Model $model)
    {
        $this->table = $model;
    }
    public function getDetails(int $page, int $perPage): array
    {
        $details = $this->table->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);
        if ($details) {
            return $details->toArray();
        }
        return [];
    }
}
