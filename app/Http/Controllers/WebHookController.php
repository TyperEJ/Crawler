<?php

namespace App\Http\Controllers;

use App\Jobs\PttSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebHookController extends Controller
{
    public function callback(Request $request)
    {
        $payload = $request->getContent();

        Log::channel('single')->info($payload);

        $dataObject = json_decode($payload);

        if(!isset($dataObject->responseId))
        {
            return;
        }

        switch ($dataObject->queryResult->action) {
            case 'sendPttMail':
                PttSend::dispatch(
                    $dataObject->queryResult->parameters,
                    $dataObject->originalDetectIntentRequest->payload
                )->onQueue('ptt_mails');
                break;
        }
    }
}
