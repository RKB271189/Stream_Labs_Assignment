<?php

namespace App\Repository;

use App\Models\Donation;

class DonationRepository implements ServiceInterface
{
    private $table;
    public function __construct(Donation $donation)
    {
        $this->table = $donation;
    }
    public function getTotal(string $startDate, string $endDate)
    {
        $details = $this->table->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');
        return $details;
    }
}
