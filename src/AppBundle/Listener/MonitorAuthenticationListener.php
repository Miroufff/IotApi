<?php

namespace AppBundle\Listener;

use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;
use InfluxDB\Point;

class MonitorAuthenticationListener
{
    private $database;
    
    public function __construct($database)
    {
        $this->database = $database;
    }
    
    public function onFailure(AuthenticationFailureEvent $event)
    {
        $this->database->writePoints([new Point(
            'login',
            1,
            ['status' => 'error']
        )]);
    }
}
