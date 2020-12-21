<?php

namespace App\EventListener;



use Symfony\Component\HttpKernel\Event\RequestEvent;

class ContadorListener
{
    public const FILE_LOG = '/tmp/contador.log';

    public function onKernelRequest(RequestEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        if (file_exists(self::FILE_LOG)) {
            $log = file_get_contents(self::FILE_LOG);
            file_put_contents(self::FILE_LOG, (int) $log + 1);

            return;
        }

        file_put_contents(self::FILE_LOG, 1);
    }
}