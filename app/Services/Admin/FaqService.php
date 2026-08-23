<?php

namespace App\Services\Admin;

use App\Models\Faq;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class FaqService extends Service
{
    public function paginate(Request $request): LengthAwarePaginator
    {
        return Faq::query()
            ->when(in_array($request->query('type'), ['user', 'driver'], true), fn ($query) => $query->where('type', $request->query('type')))
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->trim();

                $query->where(function ($inner) use ($search) {
                    $inner->where('question_ar', 'like', "%{$search}%")
                        ->orWhere('question_en', 'like', "%{$search}%")
                        ->orWhere('answer_ar', 'like', "%{$search}%")
                        ->orWhere('answer_en', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate($request->integer('per_page', 10))
            ->withQueryString();
    }

    public function store(array $data): Faq
    {
        return Faq::create($data);
    }

    public function update(array $data, Faq $faq): Faq
    {
        $faq->update($data);

        return $faq;
    }

    public function destroy(Faq $faq): void
    {
        $faq->delete();
    }
}
