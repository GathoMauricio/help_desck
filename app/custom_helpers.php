<?php
if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        $mesesN = array(
            1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
            "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        );
        return 
        ' '.date_format(new \DateTime($date), 'd'). 
        ' de '.
        $mesesN[date_format(new \DateTime($date), 'n')].
        ' del '.
        date_format(new \DateTime($date), 'Y')
        .' a las '.
        date_format(new \DateTime($date),'g:i A');
    }
}

if (!function_exists('sendPusher')) {
    function sendPusher($id,$event,$message,$extra = null)
    {
        event(new \App\Events\NotificationEvent([
            'id' => $id,
            'event' => $event,
            'message' => $message,
            'extra' => $extra,
        ]));
    }
}

if (!function_exists('sendFcm')) {
    function sendFcm($fcm_token, $title, $body, $dataArray)
   {
       $data = json_encode([
               "to" => $fcm_token,
               //"to" => "/topics/all",
               //"to" => "some_token",
               "notification" => [
                   "title" => $title,
                   "body" => $body,
                   "icon" => "ic_launcher",
                   "sound" => "default",
                   "priority" => "high"
               ],
               "data" => $dataArray
           ]);
           $url = 'https://fcm.googleapis.com/fcm/send';
           $server_key = env('FCM_KEY');
           $headers = array(
               'Content-Type:application/json',
               'Authorization:key=' . $server_key
           );
           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_POST, true);
           curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
           curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
           curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
           $result = curl_exec($ch);
           if ($result === FALSE) {
               return die('Oops! FCM Send Error: ' . curl_error($ch));
           }
           curl_close($ch);
           return $result;
   }
}

if (!function_exists('getUrl')) {
    function getUrl()
    {
        return env('APP_URL');
    }
}