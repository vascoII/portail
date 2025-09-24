<?php

declare(strict_types=1);

namespace App\Http\Action\Immeuble;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Immeuble\ListAnomaliesUseCase;
use App\Application\Dto\Input\Immeuble\ListAnomaliesInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/immeuble/{pkImmeuble}/anomalies', name: 'immeuble_list_anomalies', methods: ['GET'])]
final class ListAnomaliesAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly ListAnomaliesUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkImmeuble = (string) $request->attributes->get(self::PARAM_PK_IMMEUBLE);
    $input = new ListAnomaliesInputDto($pkImmeuble);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
