<?php
if (!function_exists('failureResponse')) {
    /**
     * @param array $errors
     * @param int $code
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    function failureResponse($code, $message = null, array $errors = array()){
        return response()->json(['error' => $errors, 'message' => $message], $code);
    }


}
if (!function_exists('successResponse')) {
    /**
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    function successResponse($message = null, array $data = null){
        return response()->json(['message' => $message, 'data' => $data], 200);
    }
}
