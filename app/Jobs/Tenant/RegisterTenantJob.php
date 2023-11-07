<?php

namespace App\Jobs\Tenant;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RegisterTenantJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $tenant;
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->tenant->run(function (){
            User::create([
                'first_name'=> $this->tenant->first_name,
                'last_name'=> $this->tenant->last_name,
                'email'=> $this->tenant->email,
                'country'=> 167,
                'city'=> 1,
                'state'=> 3176,
                'password'=> $this->tenant->password,
            ]);
        });
    }
}
