<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\IndexingMailsService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\IndexingEmailsResource;

class MailController extends Controller
{

    public function index(Request $request, IndexingMailsService $service) {
        try {
            return IndexingEmailsResource::collection($service->execute());
        }catch (\Exception $ex){
            Log::info($ex);
            return failureResponse(Response::HTTP_INTERNAL_SERVER_ERROR, __('Server error occurred. Please try again later!'));
        }
    }
}
