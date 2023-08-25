<?php

namespace App\Repository;

interface ServiceInterface
{
    public function getTotal(string $startDate, string $endDate);
    
}
