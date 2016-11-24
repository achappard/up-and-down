<?php
/**
 * Project: up-and-down
 * Created by Aurélien Chappard.
 * Date: 22/11/2016 à 16:49
 */

namespace App\Http\ViewComposers;



use Illuminate\View\View;

class AdminMainNavComposer
{
    public function compose(View $view)
    {
        $view->with( [
            'adminNav' =>  $this->getAdminMainNav()
        ]);
    }



    private function getAdminMainNav(){
        return array(
            array(
                'label'             => '<i class="fa fa-dashboard"></i> <span>Tableau de bord</span>',
                'url'               => route('dashboard.index'),
                'hightlight_menu'   => 'admin'
            ),
            array(
                'label'   => '<i class="ion ion-image"></i> <span>Images de fond</span>',
                'url'     => route('background.index'),
                'hightlight_menu'   => 'admin.manage-backgrounds'
            ),
        );
    }
}