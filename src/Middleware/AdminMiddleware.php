<?php

namespace App\Middleware;

use App\Kernel\Middleware\AbstractMiddleware;

class AdminMiddleware extends AbstractMiddleware
{

    public function handle(): void
    {
        $user = $this->auth->user();
        if($user == null){
            $this->redirect->to('/');
        }
        if ($user !== null) {
            if (!$user->is_admin()) {
                $this->redirect->to('/');
            }
        }
    }
}