<?php

namespace App\Services\Admin;

use App\Models\Slider;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SliderService extends Service
{
    public function paginate(Request $request): LengthAwarePaginator
    {
        return Slider::query()
            ->orderBy('order')
            ->orderByDesc('id')
            ->paginate($request->integer('per_page', 10))
            ->withQueryString();
    }

    public function store(array $data): Slider
    {
        if (($data['image'] ?? null) instanceof UploadedFile) {
            $data['image'] = $this->uploadImage($data['image']);
        }

        return Slider::create($data);
    }

    public function update(array $data, Slider $slider): Slider
    {
        if (($data['image'] ?? null) instanceof UploadedFile) {
            $this->deleteImage($slider->image);
            $data['image'] = $this->uploadImage($data['image']);
        } else {
            unset($data['image']);
        }

        $slider->update($data);

        return $slider;
    }

    public function destroy(Slider $slider): void
    {
        $this->deleteImage($slider->image);
        $slider->delete();
    }

    private function uploadImage(UploadedFile $image): string
    {
        return Storage::disk('public')->putFile('sliders', $image);
    }

    private function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
