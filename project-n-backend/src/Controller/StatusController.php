<?php


namespace App\Controller;

use App\EventListener\ContadorListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Uptime\System;
use Symfony\Component\HttpKernel\Profiler\Profiler;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class StatusController
 * @package App\Controller
 */
class StatusController
{

    /**
     * @Route(
     *     name="status",
     *     path="/api/status",
     *     methods={"GET"},
     *     )
     */
    public function getStatus(Profiler $profile)
    {
        $countQueries = 0;
        $countRequest = file_get_contents(ContadorListener::FILE_LOG);
        $tokens = $profile->find('','',$countRequest,'','','');

        foreach ($tokens as $token) {
            $row = $profile->loadProfile($token['token']);
            $commands = $row->getCollector('mongodb')->getCommands();
            $countQueries += count($commands);
        }

        $system = new System();

        $uptime = $system->getUptime();

        $boottime = $system->getBoottime();

        $display = sprintf("%s:%s:%s", str_pad($uptime->h, 2, 0, STR_PAD_LEFT), str_pad($uptime->i, 2, 0, STR_PAD_LEFT), str_pad($uptime->s, 2, 0, STR_PAD_LEFT));

        return new JsonResponse([
            'countRequest' => (int) $countRequest,
            'countQueries' => $countQueries,
            'serverUpTime' => $display,
            'serverBootTime' => $boottime->format('d/m/Y H:i:s')
        ]);
    }
}