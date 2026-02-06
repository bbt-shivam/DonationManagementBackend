<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UnlockUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:unlock-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unlock user accounts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::whereNotNull('locked_until')->where('locked_until', '<=', now())->update(['locked_until' => null]);
    }
}
