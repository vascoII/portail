<?php

declare(strict_types=1);

namespace App\Http\Action\Immeuble;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Immeuble\ListInterventionsUseCase;
use App\Application\Dto\Input\Immeuble\ListInterventionsInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/immeuble/{pkImmeuble}/interventions', name: 'immeuble_list_interventions', methods: ['GET'])]
final class ListInterventionsAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly ListInterventionsUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkImmeuble = (string) $request->attributes->get(self::PARAM_PK_IMMEUBLE);
    $input = new ListInterventionsInputDto($pkImmeuble);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
