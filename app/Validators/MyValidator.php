<?php


/**
 * Project: up-and-down
 * Created by Aurélien Chappard.
 * Date: 23/11/2016 à 10:39
 */
class MyValidator
{
    public function validateDistantImage($attribute, $value, $parameters, $validator){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$value);
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if(curl_exec($ch)!== FALSE)
        {
            $mimeImage =  curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
            $mimeImageValid = array('image/gif', 'image/jpeg', 'image/png');
            if (in_array($mimeImage, $mimeImageValid)){
                return true;
            }
            return false;
        }
        return false;
    }
}