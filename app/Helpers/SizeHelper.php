<?php

/**
 * Project: up-and-down
 * Created by Aurélien Chappard.
 * Date: 12/01/2017 à 11:18
 */
class SizeHelper
{

    public static function formatSizeUnits ($bytes){
        if ($bytes >= 1073741824)
        {
            $bytes = number_format( $bytes / 1000000000 , 2 , ',', '' ) . ' Go';
        }
        else if ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1000000, 1, ',', '') . ' Mo';
        }
        else if ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1000, 0, ',', '') . ' Ko';
        }
        else if ($bytes > 1)
        {
            $bytes = $bytes . ' octets';
        }
        else if ($bytes == 1)
        {
            $bytes = $bytes . ' octet';
        }
        else
        {
            $bytes = '0 octet';
        }
        return $bytes;
    }
}

