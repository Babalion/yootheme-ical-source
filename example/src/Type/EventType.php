<?php

/**
 * All contents we can select in an element
 */
class EventType
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
                    ]
                ],
                // use ISO8601-format
                'startDate' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Start date'
                    ]
                ],
                // use ISO8601-format
                'endDate' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'End date'
                    ]
                ]
            ],
            'metadata' => [
                'type' => true,
                'label' => 'iCal Event'
            ]
        ];
    }

    /**
     * This function is trivial and not needed when used like this
     * Just for demonstration
     */
    public static function resolve($obj, $args, $context, $info)
    {
        // Query the data …
        return $obj->title;
    }
}
