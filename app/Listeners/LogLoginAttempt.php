<?php

namespace App\Listeners;

use App\Models\LoginAttempt;
use App\Models\User;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;

class LogLoginAttempt
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $email = $event->credentials['email'] ?? $event->user?->email;

        LoginAttempt::create([
            'email' => $email,
            'ip_address' => request()->ip(),
            'sucessfull' => $event instanceof Login,
        ]);

        if ($event instanceof Failed && $email) {
            $this->handleLock($email);
        }
    }

    protected function handleLock(string $email): void
    {
        $failures = LoginAttempt::where('email', $email)
            ->where('successful', false)
            ->where('created_at', '>=', now()->subMinutes(15))
            ->count();

        if ($failures >= 5) {
            User::where('email', $email)->update(['lock_until' => now()->addMinutes(15)]);
        }
    }
}
