<?php

namespace App\Repository;

/**
 * All cumpulosory method to be implemented by other model repository
 */
interface ModelInterface
{
    //Implement method to get listing
    public function getDetails(): ?array;
}
