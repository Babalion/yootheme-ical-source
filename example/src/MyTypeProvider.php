<?php

class MyTypeProvider
{
    public static function get($iCalUrl)
    {
        // Query objects
        return (object) [
            'title' => "The title for id: {$iCalUrl}",
            'description' => "The description for id: {$iCalUrl}",
            'date' => "The date for id: {$iCalUrl}",
        ];
    }
}
