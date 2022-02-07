<?php

namespace App\Repositories;

class ImageRepository
{
    public function upload($folder, $image): string
    {
        $fileName = time() . '_' . $image->getClientOriginalName();

        return $image->storeAs($folder, $fileName, 'public');
    }
}
