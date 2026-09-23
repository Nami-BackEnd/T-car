<?php

namespace App\Http\Controllers\Company;

class PageController extends Controller
{
    public function show(string $page)
    {
        $extraClass = $page === 'edit-profile' ? 'profile-page' : '';

        return $this->page($page, $extraClass);
    }
}