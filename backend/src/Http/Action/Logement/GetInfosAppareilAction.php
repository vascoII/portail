<?php

declare(strict_types=1);

namespace App\Http\Action\Logement;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Logement\GetInfosAppareilUseCase;
use App\Application\Dto\Input\Logement\GetInfosAppareilInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/infos-appareils', name: 'logement_infos_appareils', methods: ['GET'])]
final class GetInfosAppareilAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly GetInfosAppareilUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new GetInfosAppareilInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
