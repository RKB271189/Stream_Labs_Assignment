<?php

namespace App\Usables;

use Exception;
use Illuminate\Support\Facades\Log;

trait ReadWrite
{
    /**
     * Writing general exception
     */
    public function WriteGeneralException(Exception $ex)
    {
        Log::channel('general_exception')->info("General Exception : " . $ex->getMessage() . ' On Line : ' . $ex->getLine());
    }       
}
