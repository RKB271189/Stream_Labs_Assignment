<?php

namespace App\Repository;

use App\Models\Follower;

class FollowerRepository extends CommonRepository implements ServiceInterface
{
    private $table;
    public function __construct(Follower $follower)
    {
        $this->table = $follower;
        parent::__construct($this->table);
    }
    public function getTotal(string $startDate, string $endDate)
    {
        $details = $this->table->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        return $details;
    }  
}
