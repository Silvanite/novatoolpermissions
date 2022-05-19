<?php

namespace Silvanite\NovaToolPermissions;

use Illuminate\Http\Request;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaToolPermissions extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::resources([
            Role::class,
        ]);
    }

    public function menu(Request $request)
    {
    }
}
