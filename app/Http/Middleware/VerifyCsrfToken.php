<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "/signeddealsheet",
        "/signlogin","/searchcustomer","test","/makeorder",
        "/findcustomer",
        "/get/task",
        "/set/coordinates",
        "/update/task",
        "/savestockmovement",
        "/savestockonhand",
        "/savereport",
        "/clockin"
    ];
}
