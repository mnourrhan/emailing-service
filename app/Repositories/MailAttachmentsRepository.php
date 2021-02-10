<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Repositories;

use App\Models\MailAttachment;

/**
 * Description of MailAttachmentsRepository
 *
 * @author Nourhan
 */
class MailAttachmentsRepository extends BaseRepository
{
    /**
     * MailAttachmentsRepository constructor.
     * @param MailAttachment $model
     */
    public function __construct(MailAttachment $model)
    {
        parent::__construct($model);
    }
}
