<?php

declare(strict_types=1);

namespace Domain\Product\Requests;

use App\Http\Requests\Request;

class UpdateProductRequest extends Request
{
    /**
     * @return array|string[]
     */
    public function rules(): array
    {
        return [
            'price' => 'required|integer'
        ];
    }
}
