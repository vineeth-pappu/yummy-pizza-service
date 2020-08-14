<?php namespace App\Exceptions;

use Illuminate\Http\Response;

class RunTimeException extends FindWorkRunTimeException
{
    public static function notFound()
    {
        return new static(sprintf('Not Found.'), Response::HTTP_NOT_FOUND);
    }

    public static function badRequest()
    {
        return new static(sprintf('Bad Request.'), Response::HTTP_BAD_REQUEST);
    }

}