<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *     version="1.0",
 *     title="The project is intended to provide data for the terminal interface.",
 *     description="The project supports such data as Categories,Products, Cart, etc.The project has API authorization, in most cases it is provided for terminals. Also in the project,there is an Administrator panel, where all the necessary tools for data control are located.",
 *     @OA\Contact(
 *         email="info@algorithm.am"
 *     ),
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 * )
 *
 */
class ApiController extends Controller
{

}
