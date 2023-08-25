<?php

namespace App\Http\Controllers;

use App\Repository\DonationRepository;
use App\Repository\FollowerRepository;
use App\Repository\MerchsaleRepository;
use App\Repository\SubscriberRepository;
use App\Usables\Helper;
use App\Usables\ReadWrite;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use ReadWrite;
    use Helper;
    private $listing;
    private $follower;
    private $subscriber;
    private $donation;
    private $merchsale;
    private $perPage = 5;
    public function __construct(
        FollowerRepository $followerRepository,
        SubscriberRepository $subscriberRepository,
        DonationRepository $donationRepository,
        MerchsaleRepository $merchsaleRepository
    ) {
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
        $totalRevenue = number_format($donationAmount + $merchsaleAmount + $subscriberAmount, 2, '.', '');
        $topItems = $this->merchsale->getTopItems(3, $startDate, $endDate);
        $details = [
            'follower' => $noOfFollowers,
            'total' => $totalRevenue,
            'items' => $topItems
        ];
        return inertia('Admin/Dashboard', $details);
    }
    public function getActivity(Request $request)
    {
        try {
            $page = $request->input('page');
            $followerDetails = $this->follower->getDetails($page, $this->perPage);
            $subscriberDetails = $this->subscriber->getDetails($page, $this->perPage);
            $donationDetails = $this->donation->getDetails($page, $this->perPage);
            $merchsaleDetails = $this->merchsale->getDetails($page, $this->perPage);
            $events = $this->formatToSentence($followerDetails, $subscriberDetails, $donationDetails, $merchsaleDetails);
            return response()->json(['message' => 'Details fetched successfully', 'events' => $events], 200);
        } catch (Exception $ex) {
            $this->WriteGeneralException($ex);
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
}
