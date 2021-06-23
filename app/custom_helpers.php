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