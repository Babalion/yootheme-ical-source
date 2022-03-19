<?php

use YOOtheme\Builder;
use YOOtheme\Path;

include_once __DIR__ . '/src/SourceListener.php';
include_once __DIR__ . '/src/Type/EventType.php';
include_once __DIR__ . '/src/Type/QueryEventType.php';
include_once __DIR__ . '/src/Type/QueryEventsType.php';

/**
 *  In this file we load all functionalities this plugin provides
 */


return [

    'events' => [
        // Add custom demo source
        'source.init' => [
            SourceListener::class => 'initSource',
        ],
    ],
];
