<?php

namespace App\Http\Controllers;
class SendprojectController extends Controller
{

    public function get_notification()
    {
        return view('admin.notification.get_note', ['title' => 'Notification']);
    }

}


?>
