<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\DownloadingAttachmentService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DownloadingAttachmentController extends Controller
{
    /**
     * @param Request $request
     * @param $id
     * @param DownloadingAttachmentService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, $id, DownloadingAttachmentService $service) {
        try {
            return $service->execute($id);
        } catch (ModelNotFoundException $exc) {
            return failureResponse(Response::HTTP_NOT_FOUND, __('Attachment not found!'));
        } catch (\Exception $exc) {
            return failureResponse(Response::HTTP_INTERNAL_SERVER_ERROR, __('Server error occurred. Please try again later!'));
        }
    }
}
