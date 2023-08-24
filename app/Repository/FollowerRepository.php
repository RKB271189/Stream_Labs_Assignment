<?php

namespace App\Repository;

use App\Models\Follower;

class FollowerRepository implements ServiceInterface
{
    private $table;
    public function __construct(Follower $follower)
    {
        $this->table = $follower;
    }
    public function getTotal(string $startDate, string $endDate)
    {
        $details = $this->table->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        return $details;
    }
}
