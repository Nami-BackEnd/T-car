<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AbstractDropdownController;
use App\Services\Company\LookupService;

class DropdownController extends AbstractDropdownController
{
    public function __construct(LookupService $service)
    {
        parent::__construct($service);

        $this->panel = 'admin';
        $this->routeBase = 'admin.lookups';
        $this->viewName = 'admin.pages.lookups.index';
    }
}
