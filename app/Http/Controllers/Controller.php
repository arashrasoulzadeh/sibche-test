<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="Sibche test",
 *     version="1.0.0",
 *     description="trip info",
 *     @OA\Contact(
 *         email="arashrasoulzadeh@gmail.com"
 *     ),
 *     @OA\License(
 *         name="Your License",
 *         url="http://your-license-url.com"
 *     )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
