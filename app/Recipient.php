<?php
/**
 * Project: up-and-down
 * Created by Aurélien Chappard.
 * Date: 08/12/2016 à 10:50
 */

namespace App;


use Illuminate\Notifications\Notifiable;

class Recipient
{
    use Notifiable;

    public $email;
}