<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Services;

use App\Repositories\MailAttachmentsRepository;
use App\Repositories\MailsRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Description of DownloadingAttachmentService
 *
 * @author Nourhan
 */
class DownloadingAttachmentService
{
    /**
     * @var MailAttachmentsRepository
     */
    protected $attachmentsRepository;

    /**
     * DownloadingAttachmentService constructor.
     * @param MailAttachmentsRepository $attachmentsRepository
     */
    public function __construct(MailAttachmentsRepository $attachmentsRepository) {
        $this->attachmentsRepository = $attachmentsRepository;
    }

    /**
     * @param $emails
     * @return \Illuminate\Http\JsonResponse
     */
    public function execute($id)
    {
        $attachment = $this->attachmentsRepository->find($id);
        $fileName = $attachment->name . '.' . Str::afterLast($attachment->file_path, '.');
        return Storage::disk('local')->download($attachment->file_path, $fileName);
    }
}
