<?php

use ICalEvent;

class ICalEventQueryType
{
    public static function config()
    {
        return [

            'fields' => [

                'i_cal_event' => [

                    'type' => 'ICalEvent',

                    'args' => [
                        'iCalUrl' => [
                            'type' => 'String',
                        ],
                    ],

                    'metadata' => [

                        'label' => 'iCal event',
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

            ]

        ];
    }

    public static function resolve(array $args)
    {
        //print($args['iCalUrl']);
        $events = ICalEvent::query($args);
        //$events=array();
        return array_shift($events);
    }
}
