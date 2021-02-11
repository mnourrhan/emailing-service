<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class IndexingEmailAttachmentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'link' => route('attachment.download',
                ['id' => $this->id, 'token' => Hash::make(env('ENCRYPTION_KEY'))])
        ];
    }
}
