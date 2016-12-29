<?php

namespace Quincalla\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    /**
     * Returns a HTTP redirect back with error message.
     */
    public function redirectBackWithMessage($message)
    {
        return redirect()->back()
            ->with('error', $message);
    }

    /**
     * Returns a HTTP redirect back with validation message.
     */
    public function redirectBackWithValidationErrors($validator)
    {
        return redirect()->back()
            ->withErrors($validator->errors())->withInput();
    }
}
