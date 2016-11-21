<?php

namespace App\Http\ViewComposers;
use App\Backgrounds;
use Illuminate\View\View;

/**
 * Project: up-and-down
 * Created by Aurélien Chappard.
 * Date: 16/11/2016 à 16:45
 */
class VegasSlideshowComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with( [
            'backgrounds' =>  $this->getBackgrounds()
        ]);
    }


    private function getBackgrounds(){
        return Backgrounds::all();
    }
}