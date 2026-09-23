<?php

namespace App\Http\Controllers\Company;

use Illuminate\Contracts\View\View;

class Controller extends \Illuminate\Routing\Controller
{
    protected function page(string $page, string $extraClass = ''): View
    {
        return view("company.pages.$page", [
            'title'      => __('company.pages.' . $page),
            'extraClass' => $extraClass,
        ]);
    }
}