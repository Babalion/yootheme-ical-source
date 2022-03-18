<?php

use ICalEvent;

class ICalEventsQueryType
{
    public static function config()
    {
        return [

            'fields' => [

                'i_cal_events' => [

                    'type' => [
                        'listOf' => 'ICalEvent',
                    ],

                    'args' => [
                        'iCalUrl' => [
                            'type' => 'String'
                        ],
                    ],

                    'metadata' => [
                        'label' => 'iCal events',
                        'group' => 'Calendar',
                        'fields' => [
                            'iCalUrl' => [
                                'label' => 'iCal URL',
                                'description' => 'input an URL to an iCal file.'
                            ],
                        ],
                    ],

                    'extensions' => [
                        'call' => __CLASS__ . '::resolve',
                    ],
                ],
            ],
        ];
    }

    // demonstration for a custom resolve function
    public static function resolve(array $args)
    {
        return ICalEvent::get($args['iCalUrl']);
    }
}
