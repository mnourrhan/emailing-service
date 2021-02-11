<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Services;

use App\Repositories\MailsRepository;

/**
 * Description of IndexingMailsService
 *
 * @author Nourhan
 */
class IndexingMailsService
{
    /**
     * @var MailsRepository
     */
    protected $repository;

    /**
     * IndexingMailsService constructor.
     * @param MailsRepository $repository
     */
    public function __construct(MailsRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param $emails
     * @return \Illuminate\Http\JsonResponse
     */
    public function execute()
    {
        return $this->repository->paginate(10);
    }
}
