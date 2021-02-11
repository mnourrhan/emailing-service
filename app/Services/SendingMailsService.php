<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Services;

use App\Jobs\SendEmail;

/**
 * Description of SendingMailsService
 *
 * @author Nourhan
 */
class SendingMailsService
{
    /**
     * @param $emails
     * @return \Illuminate\Http\JsonResponse
     */
    public function execute($request)
    {
        $emails = $request->get('emails');
        foreach ($emails as $email){
            SendEmail::dispatch($email);
        }
        return successResponse(__('Emails are sent successfully'));
    }
}
