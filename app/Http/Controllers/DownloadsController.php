<?php

namespace App\Http\Controllers;

use App\Downloads;
use Illuminate\Http\Request;

class DownloadsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request, $token = null)
    {
        $download = Downloads::where("uuid", $token)->firstOrFail();
        $date_created = strftime("%A %d %B %Y à %Hh%M",strtotime($download->created_at));
        $date_expiration = $download->expiration_date;
        $date_expiration_str = null;
        $expired_link = false;
        $message=  nl2br($download->message);

        $findme   = '/';
        $pos = strpos($download->file_name, $findme);

        $file_name =        substr($download->file_name, $pos + 1, strlen($download->file_name));
        $file_size = \SizeHelper::formatSizeUnits($download->file_size);



        if( $date_expiration ){
            $date_expiration_str = strftime("%A %d %B %Y",strtotime($download->expiration_date));
            $today_datetime = new \DateTime();
            $expiration_datetime = new \DateTime($date_expiration);

            // On rajoute un jour pour pouvoir télécharger le document jusqu'à la date de péremption COMPRISE
            $expiration_datetime->modify('+1 day');
            if($today_datetime > $expiration_datetime){
                $expired_link = true;
            }
        }

        return view('upAndDown.downloads', compact(
            'download',
            'date_created',
            'expired_link',
            'date_expiration_str',
            'message',
            'file_name',
            'file_size'
        ) );

    }


    public function push_document(Request $request, $token = null)
    {
        $download = Downloads::where("uuid", $token)->firstOrFail();

        $date_expiration = $download->expiration_date;
        $date_expiration_str = null;
        $expired_link = false;

        if( $date_expiration ){
            $today_datetime = new \DateTime();
            $expiration_datetime = new \DateTime($date_expiration);

            // On rajoute un jour pour pouvoir télécharger le document jusqu'à la date de péremption COMPRISE
            $expiration_datetime->modify('+1 day');
            if($today_datetime > $expiration_datetime){
                $expired_link = true;
            }
        }

        if ( !$expired_link ){

            $findme   = '/';
            $pos = strpos($download->file_name, $findme);

            $file_name =        substr($download->file_name, $pos + 1, strlen($download->file_name));



            $file = "/home/vagrant/Code/up-and-down/storage/app/up-and-down/" . $file_name;
            header('Content-Type: application/octet-stream');
            header('Content-Transfer-Encoding: Binary');
            header('Content-disposition: attachment; filename="' . basename($file) . '"');
            header('X-Accel-Redirect: /tititititi/'.basename($file));
        }
    }
}
