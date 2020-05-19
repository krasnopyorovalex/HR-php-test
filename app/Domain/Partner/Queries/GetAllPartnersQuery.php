<?php

declare(strict_types=1);

namespace Domain\Partner\Queries;

use App\Partner;
use Illuminate\Database\Eloquent\Collection;

class GetAllPartnersQuery
{
    /**
     * @return Partner[]|Collection
     */
    public function handle()
    {
        return Partner::all();
    }
}
