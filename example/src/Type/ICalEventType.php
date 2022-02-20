<?php

include_once __DIR__ . '/../ICalParser/ICal.php';
include_once __DIR__ . '/../ICalParser/Event.php';

use ICal\ICal;

class ICalEvent
{
    public static function query(array $iCalUrl)
    {
        // Query objects

        try {
            $ical = new ICal(false, array(
                'defaultSpan' => 2,     // Default value
                'defaultTimeZone' => 'UTC',
                'defaultWeekStart' => 'MO',  // Default value
                'disableCharacterReplacement' => false, // Default value
                'filterDaysAfter' => null,  // Default value
                'filterDaysBefore' => null,  // Default value
                'skipRecurrence' => false, // Default value
            ));
            print($iCalUrl);
            print('\n');
            // $ical->initFile('ICal.ics');
            $ical->initUrl($iCalUrl, $username = null, $password = null, $userAgent = null);
        } catch (\Exception $e) {
            die($e);
        }

        $events = array();

        foreach ($ical->events() as $event) {
            $events[] = [
                'title' => $event->summary,
                'description' => $event->description,
                'dtStart' => $event->dtstart_tz,
                'dtEnd' => $event->dtend_tz,
                //'eventCount' => $event->eventCount,
            ];
        }

        //print $events[0]->printData();
        return $events;

    }


    public static function config()
    {
        return [

            'fields' => [

                'title' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Title'
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::resolve'
                    ]
                ],
                'description' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Description'
                    ],
                ],
                'dtStart' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Start Time'
                    ],
                ],
                'dtEnd' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'End Time'
                    ],
                ],
            ],

            'metadata' => [
                'type' => true,
                'label' => 'iCal Event'
            ]

        ];
    }

    // demonstration for a custom resolve function
    public static function resolve($obj, $args, $context, $info)
    {
        // Query the data …
        return $obj->title;
    }
}
