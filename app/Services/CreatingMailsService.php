<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Services;

use App\Repositories\MailAttachmentsRepository;
use App\Repositories\MailsRepository;

/**
 * Description of CreatingMailsService
 *
 * @author Nourhan
 */
class CreatingMailsService
{
    /**
     * @var MailsRepository
     */
    protected $repository;

    /**
     * @var MailAttachmentsRepository
     */
    protected $attachmentsRepository;

    /**
     * SendingMailsService constructor.
     * @param MailsRepository $repository
     * @param MailAttachmentsRepository $attachmentsRepository
     */
    public function __construct(MailsRepository $repository,
                                MailAttachmentsRepository $attachmentsRepository) {
        $this->repository = $repository;
        $this->attachmentsRepository = $attachmentsRepository;
    }

    /**
     * @param $email
     * @return array
     */
    public function execute($email)
    {
        $created_email = $this->createMail($email);
        $attachments = [];
        if(isset($email['attachments'])) {
            foreach ($email['attachments'] as $attachment) {
                $attachment_path = app(SaveBase64AttachmentService::class)
                    ->execute($attachment, $created_email['id']);
                array_push($attachments, $attachment_path);
            }
        }
        return $attachments;
    }

    /**
     * @param $email
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function createMail($email){
        return app(MailsRepository::class)->create([
            'body' => $email['body'],
            'subject' => $email['subject'],
            'receiver_email' => $email['receiver_email'],
        ]);
    }
}
