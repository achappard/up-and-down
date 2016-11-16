<?php

namespace App\Http\ViewComposers;
use Illuminate\View\View;

/**
 * Project: up-and-down
 * Created by Aurélien Chappard.
 * Date: 16/11/2016 à 16:45
 */
class ProfileComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('count', "ma vue partagée !");
    }
}