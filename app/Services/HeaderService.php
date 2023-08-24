<?php

namespace App\Services;

class HeaderService
{
    public function getTableTabs()
    {
        return [
            'Tab-1',
            'Tab-2',
            'Tab-3',
        ];
    }
    public function getTableHeaders()
    {
        return [
            'Tab-1' => [
                'Sr. No.',
                'Name',
                'Price',
                'Color',
                'Size',
            ],
            'Tab-2' => [
                'Sr. No.',
                'First Name',
                'Last Name',
                'Email',
            ],
            'Tab-3' => [
                'Sr. No.',
                'Order No.',
                'Last Name',
                'Email',
            ]
        ];
    }
}
