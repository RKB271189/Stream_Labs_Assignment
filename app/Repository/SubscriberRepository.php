<?php

namespace App\Repository;

use App\Models\Subscriber;

class SubscriberRepository extends CommonRepository implements ServiceInterface
{
    private $table;
    public function __construct(Subscriber $subscriber)
    {
        $this->table = $subscriber;
        parent::__construct($this->table);
    }
    public function getTotal(string $startDate, string $endDate)
    {
        $details = $this->table->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('subscription_tier, SUM(CASE
                        WHEN subscription_tier = 1 THEN 5
                        WHEN subscription_tier = 2 THEN 10
                        WHEN subscription_tier = 3 THEN 15
                        ELSE 0
                    END) AS amount')
            ->groupBy('subscription_tier')
            ->get();
        return $details;
    }
}
