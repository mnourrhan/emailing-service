<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Validators;

/**
 * Description of SendingMailsValidator
 *
 * @author Nourhan
 */
class SendingMailsValidator extends BaseRequestValidator
{

    /**
     * Validation rules
     *
     * @return array
     */
    protected function rules(): array {
        return [
            'emails' => ['required', 'array'],
            'emails.*.body' => ['required', 'string', 'max:500'],
            'emails.*.subject' => ['required', 'string', 'max:100'],
            'emails.*.receiver_email' => ['required', 'email', 'max:100'],
            'emails.*.attachments' => ['nullable', 'array'],
            'emails.*.attachments.*.name' => ['required_with:emails.*.attachments', 'string', 'max:100'],
            'emails.*.attachments.*.value' => ['required_with:emails.*.attachments', 'base64file'],
        ];
    }

}
