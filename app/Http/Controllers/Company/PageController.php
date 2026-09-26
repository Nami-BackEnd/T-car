<?php

namespace App\Http\Controllers\Company;

class PageController extends Controller
{
    public function show(string $page)
    {
        // Route parameters are injected positionally, so a URI parameter such
        // as {driver} would land in $page on routes like edit-driver/{driver}.
        // Resolve the page by name instead.
        $page = (string) (request()->route('page') ?? $page);

        $extraClass = $page === 'edit-profile' ? 'profile-page' : '';

        return $this->page($page, $extraClass);
    }
}
