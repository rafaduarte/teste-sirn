<?php

namespace App\Listeners;

use App\Events\TenantCreated;
use App\Models\Profile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddProfileTenant
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TenantCreated $event)
    {
        //$user = $event->user();
        $tenant = $event->tenant();

        if (!$profile = Profile::first())
            return;

        $tenant->profiles()->attach($profile);

        return 1;
    }
}
