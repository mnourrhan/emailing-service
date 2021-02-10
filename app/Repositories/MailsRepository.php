<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Repositories;


use App\Models\Mail;

/**
 * Description of MailsRepository
 *
 * @author Nourhan
 */
class MailsRepository extends BaseRepository
{
    /**
     * MailsRepository constructor.
     * @param Mail $model
     */
    public function __construct(Mail $model)
    {
        parent::__construct($model);
    }
}
