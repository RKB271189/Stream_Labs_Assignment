<?php

namespace App\Usables;

trait Helper
{
    public function formatToSentence(array $followerDetails, array $subscriberDetails, array $donationDetails, array $merchsaleDetails): array
    {
        $events = [];
        $follower = $followerDetails['data'];
        $donation = $donationDetails['data'];
        $merchsale = $merchsaleDetails['data'];
        $subscriber = $subscriberDetails['data'];
        $maxCount = max(count($follower), count($subscriber), count($donation), count($merchsale));
        for ($i = 0; $i < $maxCount; $i++) {
            $sentence = '';
            if ($i < count($follower)) {
                $sentence .= $follower[$i]['name']  . ' followed you.</br>';
            }
            if ($i < count($subscriber)) {
                $tier = $subscriber[$i]['subscription_tier'];
                $sentence .= $subscriber[$i]['name'] . '(Tier - ' . $tier . ')' . ' subscribe to you' . '.</br>';
            }
            if ($i < count($donation)) {
                $sentence .= $donation[$i]['name'] . ' donated ' . $donation[$i]['amount'] . ' ' . $donation[$i]['currency'] . '.</br>'
                    . 'Message : ' . $donation[$i]['donation_message'] . '.</br>';
            }
            if ($i < count($merchsale)) {
                $sentence .= $merchsale[$i]['name'] . ' bought some ' . $merchsale[$i]['item_name'] . ' for ' . $merchsale[$i]['amount'] . 'USD .</br>';
            }
            array_push($events, $sentence);
        }
        return $events;
    }
}
