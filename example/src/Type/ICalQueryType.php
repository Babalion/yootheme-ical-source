<?php

class ICalQueryType
{
    public static function config()
    {
        return [

            'fields' => [

                'calendar_icaltype' => [

                    'type' => 'ICalType',

                    'args' => [

                        'iCalUrl' => [
                            'type' => 'String'
                        ],

                    ],

                    'metadata' => [

                        'label' => 'iCal Calendar',
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

    public static function resolve($item, $args, $context, $info)
    {
        return MyTypeProvider::get($args['iCalUrl']);
    }
}
