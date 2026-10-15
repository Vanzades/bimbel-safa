<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class SuperAdminTopbar extends Component
{
    public function render(): View
    {
        return view('components.super-admin-topbar');
    }
}