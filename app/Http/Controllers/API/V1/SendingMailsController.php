<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Validators\SendingMailsValidator;
use App\Services\SendingMailsService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class SendingMailsController extends Controller
{

    /**
     * @param Request $request
     * @param SendingMailsValidator $validator
     * @param SendingMailsService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, SendingMailsValidator $validator,
                             SendingMailsService $service) {
        try {
            if ($validator->validate($request)->failed()) {
                return failureResponse(Response::HTTP_UNPROCESSABLE_ENTITY, __('Invalid Request!'), $validator->errors());
            }
            return $service->execute($request);
        }catch (\Exception $ex){
            Log::info($ex);
            return failureResponse(Response::HTTP_INTERNAL_SERVER_ERROR, __('Server error occurred. Please try again later!'));
        }
    }
}
