<?php

include_once __DIR__ . '/../ICalParser/ICal.php';
include_once __DIR__ . '/../ICalParser/Event.php';

use ICal\ICal;
use QueryEventsType;

/**
 * All settings we can tweak in our source
 */
class QueryEventType
{
    public static function config()
    {
        return [

            'fields' => [
                'event_type' => [
                    'type' => 'EventType',
                    'args' => [
                        'iCalUrl' => [
                            'type' => 'String'
                        ],
                    ],
                    'metadata' => [
                        'label' => 'iCal Event',
                        'group' => 'Events',
                        'fields' => [
                            'iCalUrl' => [
                                'label' => 'iCal url',
                                'description' => 'Input a valid URL to an iCal file.'
                            ],
                        ],
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::getFirstEvent',
                    ],
                ],
            ]
        ];
    }

    public static function dummyEvent()
    {
        return (object)[
            'title' => "Event Title",
            'description' => "this is the event description",
            'startDate' => "20201103T23:50:12+02:00",
            'endDate' => "20201103T23:50:12+02:00"
        ];
    }

    public static function getFirstEvent($item, $args, $context, $info)
    {
        $iCalUrl = $args['iCalUrl'];
        if (empty($iCalUrl)) {
            return self::dummyEvent();
        }
        // TODO add check if URL is valid


        $firstEvent = QueryEventsType::crawler($iCalUrl)->events()[0];
        return (object)[
            'title' => "$firstEvent->summary",
            'description' => "$firstEvent->description",
            'startDate' => "$firstEvent->dtstart_tz",
            'endDate' => "$firstEvent->dtend_tz"
        ];
    }
}
