<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Mail
 *
 * @author Nourhan
 */
class Mail extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body', 'subject', 'receiver_email'
    ];

    public function attachments() {
        return $this->hasMany(MailAttachment::class, 'email_id', 'id');
    }
}
