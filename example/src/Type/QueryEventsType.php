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
class QueryEventsType
{
    public static function config()
    {
        return [

            'fields' => [
                'events_type' => [
                    'type' => [
                        'listOf' => 'EventType',
                    ],
                    'args' => [
                        'iCalUrl' => [
                            'type' => 'String'
                        ],
                    ],
                    'metadata' => [
                        'label' => 'iCal Events',
                        'group' => 'Events',
                        'fields' => [
                            'iCalUrl' => [
                                'label' => 'iCal url',
                                'description' => 'Input a valid URL to an iCal file.'
                            ],
                        ],
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::getEvents',
                    ],
                ],
            ]
        ];
    }


    public static function getEvents($item, $args, $context, $info)
    {
        $iCalUrl = $args['iCalUrl'];
        if (empty($iCalUrl)) {
            return [QueryEventType::dummyEvent()];
        }

        // TODO add check if URL is valid

        $ical = self::crawler($iCalUrl);

        $ListOfEventsTypeFields = [];
        foreach ($ical->events() as $event) {
            debug_to_console(count($event));
            $ListOfEventsTypeFields[] = (object)[
                'title' => $event->summary,
                'description' => $event->description,
                'startDate' => $event->dtstart_tz,
                'endDate' => $event->dtend_tz,
                //'eventCount' => $event->eventCount,
            ];
        }

        return $ListOfEventsTypeFields;
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
    }
}
