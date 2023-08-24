<?php

namespace App\Http\Controllers;

use App\Repository\FollowerRepository;
use App\Repository\ModelInterface;
use App\Usables\ReadWrite;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use ReadWrite;
    private $listing;
    private $follower;
    public function __construct(ModelInterface $modelInterface, FollowerRepository $followerRepository)
    {
        $this->listing = $modelInterface;
        $this->follower = $followerRepository;
    }
    public function index()
    {
        $startDate = '';
        $endDate = '';
        $followerDetails = $this->follower->getTotal($startDate, $endDate);        
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
