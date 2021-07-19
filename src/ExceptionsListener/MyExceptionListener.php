<?php


namespace App\ExceptionsListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;


class MyExceptionListener
{

    public function onKernelException(ExceptionEvent $event)
    {

        $exception = $event->getThrowable();
        $message = sprintf(
            'My Error says: %s with code: %s, [\'error\': true]',
            $exception->getMessage(),
            $exception->getCode()
        );


        $response = new Response();
        $response->setContent($message);

        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        $event->setResponse($response);
    }

}