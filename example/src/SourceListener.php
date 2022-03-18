<?php

use YOOtheme\Builder\Source;

/**
 * In this file we provide a class with which YooTheme can later on instantiate our Type and Query Type
 *
 * The queryType 'MyQueryType' describes the structure we see later on in the Dynamic Source Settings
 *
 * The objectType 'EventType' describes the contents which our Source provides
 * and which we can select later on in the element builder
 */

class SourceListener
{
    /**
     * @param Source $source
     */
    public static function initSource($source)
    {
        $source->objectType('EventType', EventType::config());
        $source->queryType(MyQueryType::config());
    }
}
