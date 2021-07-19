<?php

namespace App\Controller;

use App\Exceptions\GetWordException;
use App\Exceptions\MyExceptionSubscriber;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class TranslationController extends AbstractController
{
    private array $dex = [
        "alda" => "tree",
        "amandil" => "priest",
        "and" => "long",
        "barad" => "tower",
        "beleg" => "mighty"
    ];


    /**
     * @throws GetWordException
     */
    public function getWord(string $word): JsonResponse
    {
        if(\array_key_exists($word, $this->dex)){
            return new JsonResponse([$word => $this->dex[$word]]);
        }

        throw new GetWordException("The word you are searching for does not exist!", 404);
    }

    /**
     * @Route("app/translationsSecond/{word}", name="translations_Second")
     * @param string $word
     * @return JsonResponse
     * @throws GetWordException
     */
    public function getWordAnother(string $word): JsonResponse
    {
        if(\array_key_exists($word, $this->dex)){
            return new JsonResponse([$word => $this->dex[$word]]);
        }

        throw new GetWordException("The word you are searching for does not exist!", 404);
    }
}