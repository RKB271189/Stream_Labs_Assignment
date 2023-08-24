<?php

namespace App\Http\Controllers;

use App\Repository\ModelInterface;
use App\Usables\ReadWrite;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use ReadWrite;
    private $listing;
    public function __construct(ModelInterface $modelInterface)
    {
        $this->listing = $modelInterface;
    }
    public function index()
    {
        return inertia('Admin/Dashboard');
    }
    public function getList()
    {
        try {
            $details = $this->listing->getDetails();
        } catch (Exception $ex) {
            $this->WriteGeneralException($ex);
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
}
