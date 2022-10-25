<?php

namespace App\Http\Response;

use Illuminate\Contracts\Support\Arrayable;

class ApiResponse implements Arrayable
{
    private ?array $result;
    private bool $success;

    public function __construct($success, $result = null)
    {
        $this->success = $success;
        $this->result = $result;
    }

    public function toArray()
    {
        return array_merge([
            'success' => $this->success
        ],
        $this->result ? ['result' => $this->result] : []
        );
    }
}
