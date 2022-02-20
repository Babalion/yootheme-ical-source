<?php

use YOOtheme\Builder\Source;

class SourceListener
{
    /**
     * @param Source $source
     */
    public static function initSource($source)
    {
        $source->objectType('ICalType', ICalType::config());
        $source->queryType(ICalQueryType::config());
    }
}
