<?php

declare(strict_types=1);

namespace Domain\Order\Requests;

use App\Http\Requests\Request;

class UpdateOrderRequest extends Request
{
    public function rules(): array
    {
        return [
            'client_email' => 'required|email|max:255',
            'partner_id' => 'required|integer|exists:partners,id',
            'status' => 'required|integer'
        ];
    }
}
