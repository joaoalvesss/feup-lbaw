<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteExpiredTokens extends Command
{
    protected $signature = 'tokens:delete-expired';

    protected $description = 'Delete expired password reset tokens';

    public function handle(){
        $expirationHours = 24;

        $expiredTokens = DB::table('password_reset_tokens')
        ->where('created_at', '<=', now()->subHours($expirationHours))
        ->delete();

        $this->info("Deleted {$expiredTokens} expired password reset tokens.");
    }
}
