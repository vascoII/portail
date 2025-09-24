<?php

declare(strict_types=1);

namespace App\Http\Action\Immeuble;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Immeuble\LinterventionUseCase;
use App\Application\Dto\Input\Immeuble\LinterventionInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/immeuble/{pkImmeuble}/lintervention', name: 'immeuble_lintervention', methods: ['GET'])]
final class LinterventionAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly LinterventionUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkImmeuble = (string) $request->attributes->get(self::PARAM_PK_IMMEUBLE);
    $input = new LinterventionInputDto($pkImmeuble);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
