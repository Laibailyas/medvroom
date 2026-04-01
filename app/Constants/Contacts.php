<?php

namespace App\Constants;

/**
 * Class Contacts
 *
 * Centralized store for all contact-related constant values.
 */
class Contacts
{
    public const EMAIL = 'service@medvroom.com';

    public const PHONE = '855-962-3621';

    public const ADDRESS_NY = [
        'name' => 'New York',
        'street' => '568 Broadway',
        'floor' => 'Floor 9',
        'city_state_zip' => 'New York, NY 10012',
    ];

    public const ADDRESS_SV = [
        'name' => 'Silicon Valley',
        'street' => '2150 North 1st Street',
        'suite' => 'Suite 200',
        'city_state_zip' => 'San Jose, CA, 95131',
    ];

    public const WORKING_HOURS_WEEKDAYS = 'Mon – Fri from 8am-8pm ET';

    public const WORKING_HOURS_WEEKENDS = 'Weekends and holidays from 9am-6pm ET';
}
