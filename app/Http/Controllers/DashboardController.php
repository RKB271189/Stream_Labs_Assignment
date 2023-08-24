<?php

namespace App\Http\Controllers;

use App\Repository\DonationRepository;
use App\Repository\FollowerRepository;
use App\Repository\MerchsaleRepository;
use App\Repository\ModelInterface;
use App\Repository\SubscriberRepository;
use App\Usables\ReadWrite;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use ReadWrite;
    private $listing;
    private $follower;
    private $subscriber;
    private $donation;
    private $merchsale;
    private $perPage = 100;
    public function __construct(
        ModelInterface $modelInterface,
        FollowerRepository $followerRepository,
        SubscriberRepository $subscriberRepository,
        DonationRepository $donationRepository,
        MerchsaleRepository $merchsaleRepository
    ) {
        $this->listing = $modelInterface;
        $this->follower = $followerRepository;
        $this->subscriber = $subscriberRepository;
        $this->donation = $donationRepository;
        $this->merchsale = $merchsaleRepository;
    }
    public function index()
    {
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();
        $totalRevenue = 0;
        $noOfFollowers = $this->follower->getTotal($startDate, $endDate);
        $donationAmount = floatval($this->donation->getTotal($startDate, $endDate));
        $merchsaleAmount = floatval($this->merchsale->getTotal($startDate, $endDate));
        $subscriberDetails = $this->subscriber->getTotal($startDate, $endDate);
        $subscriberAmount = 0;
        foreach ($subscriberDetails as $val) {
            $subscriberAmount = $val->amount;
        }
        $totalRevenue = $donationAmount + $merchsaleAmount + $subscriberAmount;
        $topItems = $this->merchsale->getTopItems(3, $startDate, $endDate);
        $details = [
            'follower' => $noOfFollowers,
            'total' => $totalRevenue,
            'items' => $topItems
        ];
        return inertia('Admin/Dashboard', $details);
    }
    public function getList(Request $request)
    {
        try {
            $page = $request->input('page');
            $perPage = 100;
            $details = $this->listing->getDetails();
        } catch (Exception $ex) {
            $this->WriteGeneralException($ex);
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
}
