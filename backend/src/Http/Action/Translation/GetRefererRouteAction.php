<?php

declare(strict_types=1);

namespace App\Http\Action\Translation;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/change/locale/{language}/referer', name: 'translation_get_referer_route', methods: ['GET'])]
final class GetRefererRouteAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $language = $request->attributes->get('language');
    $referer = $request->headers->get('referer');
    return $this->responder->respond([
      'language' => $language,
      'referer' => $referer,
    ]);
  }
}
