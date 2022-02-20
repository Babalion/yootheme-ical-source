<?php

use YOOtheme\Builder;
use YOOtheme\Path;

include_once __DIR__ . '/src/SourceListener.php';
include_once __DIR__ . '/src/MyTypeProvider.php';
include_once __DIR__ . '/src/Type/MyType.php';
include_once __DIR__ . '/src/Type/MyQueryType.php';

return [


    'events' => [

        // Add custom demo source
        'source.init' => [
            SourceListener::class => 'initSource',
        ],

    ],

    // Add builder elements
    'extend' => [

        Builder::class => function (Builder $builder) {
            $builder->addTypePath(Path::get('./elements/*/element.json'));
        },

    ],

];
