<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexingEmailsResource extends JsonResource
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
            'id' => $this->id,
            'body' => $this->body,
            'subject' => $this->subject,
            'receiver_email' => $this->receiver_email,
            'attachments' => IndexingEmailAttachmentsResource::collection($this->attachments),
        ];
    }
}
