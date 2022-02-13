<?php

namespace App\Traits;

trait EventDispatchMessages
{
    // $this->emit('response', $id);
    public function successMessage($message = "The action was successful.", $smiley = "👍")
    {
        return [
            'code' => 200,
            'heading' => "Action successful " . $smiley,
            'message' => $message,
            'type' => 'success',
        ];
    }

    public function errorMessage($message = "The action was failed.", $smiley = "😞")
    {
        return [
            'code' => 400,
            'heading' => "Error occured" . $smiley,
            'message' => $message,
            'type' => 'error',
        ];
    }

    public function exceptionMessage($exception, $smiley = "😭")
    {
        return [
            'code' => 409,
            'heading' => "Exception occured " . $smiley,
            'message' => $exception->errorInfo[2] ?? $exception->getMessage(),
            'type' => 'info',
        ];
    }
}
