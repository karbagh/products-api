<?php

namespace App\Repositories\Size;

use App\Models\Size;
use Illuminate\Database\Eloquent\Builder;

class SizeRepository
{
    public function query(): Builder
    {
        return Size::query();
    }
}
