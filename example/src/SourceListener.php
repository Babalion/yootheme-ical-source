<?php

use YOOtheme\Builder\Source;

include_once __DIR__ . '/Type/ICalEventType.php';
include_once __DIR__ . '/Type/ICalEventQueryType.php';
include_once __DIR__ . '/Type/ICalEventsQueryType.php';

class SourceListener
{
    /**
     * @param Source $source
     */
    public static function initSource($source)
    {
        $source->queryType(ICalEventQueryType::config());
        //$source->queryType(ICalEventsQueryType::config());
        $source->objectType('ICalEvent', ICalEvent::config());
    }
}
