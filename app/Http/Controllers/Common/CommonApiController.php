<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseFormat;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CommonApiController extends Controller
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;
    use ApiResponseFormat;
}
