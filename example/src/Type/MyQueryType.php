<?php

include_once __DIR__ . '/../ICalParser/ICal.php';
include_once __DIR__ . '/../ICalParser/Event.php';

use ICal\ICal;

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

/**
 * All settings we can tweak in our source
 */
class MyQueryType
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


    public static function getFirstEvent($item, $args, $context, $info)
    {
        $iCalUrl = $args['iCalUrl'];
        $firstEvent = self::crawler($iCalUrl)->events()[0];
        return (object)[
            'title' => "$firstEvent->summary",
            'description' => "$firstEvent->description",
            'startDate' => "$firstEvent->dtstart_tz",
            'endDate' => "$firstEvent->dtstart_tz"
        ];
    }

    public static function crawler($iCalUrl)
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
            $ical->initUrl($iCalUrl, $username = null, $password = null, $userAgent = null);
        } catch (\Exception $e) {
            die($e);
        }
        return $ical;

//        $events = array();
//
//        foreach ($ical->events() as $event) {
//            $events[] = [
//                'title' => $event->summary,
//                'description' => $event->description,
//                'dtStart' => $event->dtstart_tz,
//                'dtEnd' => $event->dtend_tz,
//                //'eventCount' => $event->eventCount,
//            ];
//        }
//
//        //print $events[0]->printData();
//        return $events;
    }
}
