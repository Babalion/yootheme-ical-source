<?php

class ICalType
{
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

            ],

            'metadata' => [
                'type' => true,
                'label' => 'iCal Source'
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
