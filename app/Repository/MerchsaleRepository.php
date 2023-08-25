<?php

namespace App\Repository;

use App\Models\MerchSale;

class MerchsaleRepository extends CommonRepository implements ServiceInterface
{
    private $table;
    public function __construct(MerchSale $merchSale)
    {
        $this->table = $merchSale;
        parent::__construct($this->table);
    }
    public function getTotal(string $startDate, string $endDate)
    {
        $details = $this->table->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');
        return $details;
    }
    public function getTopItems(int $noOfItems = 1, string $startDate, string $endDate): ?array
    {
        $details = $this->table->whereBetween('created_at', [$startDate, $endDate])->orderBy('amount', 'desc')
            ->limit($noOfItems)
            ->get();
        if ($details) {
            $details = $details->toArray();
        }
        return $details;
    }
}
