<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Request;
use App\Models\Log;

class LogUserLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        $userAgent = Request::header('User-Agent');
        $ipAddress = Request::ip();
        $browser = $this->getBrowser($userAgent);
        $deviceInfo = $this->getDeviceInfo($userAgent);

        // Registra los datos en la tabla logs
        Log::create([
            'user_id' => $user->id,
            'login_time' => now(),
            'ip_address' => $ipAddress,
            'browser' => $browser,
            'device_info' => $deviceInfo,
            'user_agent' => $userAgent,
        ]);
    }

    private function getBrowser($userAgent)
    {
        if (preg_match('/MSIE|Trident/', $userAgent)) {
            return 'Internet Explorer';
        } elseif (preg_match('/Edge/', $userAgent)) {
            return 'Microsoft Edge';
        } elseif (preg_match('/Chrome/', $userAgent)) {
            return 'Google Chrome';
        } elseif (preg_match('/Safari/', $userAgent)) {
            return 'Safari';
        } elseif (preg_match('/Firefox/', $userAgent)) {
            return 'Mozilla Firefox';
        } elseif (preg_match('/Opera|OPR/', $userAgent)) {
            return 'Opera';
        } else {
            return 'Desconocido';
        }
    }

    private function getDeviceInfo($userAgent)
    {
        if (preg_match('/Windows NT/', $userAgent)) {
            return 'Windows PC';
        } elseif (preg_match('/Mac OS X/', $userAgent)) {
            return 'Macintosh';
        } elseif (preg_match('/Linux/', $userAgent)) {
            return 'Linux';
        } elseif (preg_match('/Android/', $userAgent)) {
            return 'Android Device';
        } elseif (preg_match('/iPhone|iPad|iPod/', $userAgent)) {
            return 'iOS Device';
        } else {
            return 'Desconocido';
        }
    }
}
