<?php


namespace App\ExceptionsSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class MyExceptionSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['MySubscriberOnKernelView'],

        ];
    }

    public function MySubscriberOnKernelView(ViewEvent $event): void
    {
        $request = $event->getRequest();
        $result = $event->getControllerResult();

        if($request->headers->contains('accept', 'application/xml')){
            $xml = new \SimpleXMLElement('<root/>');
            \array_walk_recursive($result, [$xml, 'addChild']);

            $response = new Response($xml->asXML());
            $response->headers->set('CONTENT_TYPE', 'application/xml');

            $event->setResponse($response);

            return;

        }

        $event->setResponse(new JsonResponse($result, Response::HTTP_OK));
    }
}