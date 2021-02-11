<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Services;

use App\Repositories\MailAttachmentsRepository;
use Illuminate\Support\Facades\Storage;

/**
 * Description of SaveBase64AttachmentService
 *
 * @author Nourhan
 */
class SaveBase64AttachmentService
{
    /**
     * @var MailAttachmentsRepository
     */
    protected $attachmentsRepository;

    /**
     * SendingMailsService constructor.
     * @param MailAttachmentsRepository $attachmentsRepository
     */
    public function __construct(MailAttachmentsRepository $attachmentsRepository) {
        $this->attachmentsRepository = $attachmentsRepository;
    }

    /**
     * @param $attachment
     * @param $email_id
     * @return string
     */
    public function execute($attachment, $email_id){
        $binaryData = base64_decode($attachment['value']);
        $extension = $this->getFileExtension($binaryData);
        $filePath = '/public/' .  md5($attachment['name'] . microtime()). '.' . $extension;
        Storage::put($filePath , $binaryData);
        $this->attachmentsRepository->create([
            'name' => $attachment['name'],
            'file_path' => $filePath,
            'email_id' => $email_id,
        ]);
        return storage_path('app' . $filePath);
    }

    /**
     * @param $binaryData
     * @return string|null
     */
    private function getFileExtension($binaryData){
        $tmpFile = tempnam(sys_get_temp_dir(), 'base64validator');
        file_put_contents($tmpFile, $binaryData);
        $extension = (new \Symfony\Component\HttpFoundation\File\File($tmpFile))->guessExtension();
        return $extension;
    }
}
