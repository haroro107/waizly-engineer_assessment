<?php

namespace App\Http\Transformers;

use Illuminate\Support\Facades\Log;

/**
 *  Class Json is transformers from raw data to json view
 */
class Result
{
   public static function response($data = null, $message = null,  $code = 200, $status = true)
   {
      $result = [
         'status' => $status,
         'message' => $message,
         'data' => $data,
      ];

      return response()->json($result, $code);
   }

   public static function error($data = null, $message = null,  $code = 400, $status = false)
   {
      $result = [
         'status' => $status,
         'message' => $message,
         'data' => $data,
      ];

      Log::info($data);

      return response()->json($result, $code);
   }
}
