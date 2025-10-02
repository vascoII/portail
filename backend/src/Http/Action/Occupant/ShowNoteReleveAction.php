<?php

declare(strict_types=1);

namespace App\Http\Action\Occupant;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Occupant\ShowNoteReleveUseCase;
use App\Application\Factory\Occupant\OccupantInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/occupant/{pkOccupant}/releve_note/{pkImmeuble}/{energie}', name: 'occupant_note_releve', methods: ['GET'])]
final class ShowNoteReleveAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly ShowNoteReleveUseCase $useCase,
    private readonly OccupantInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createShowNoteReleveFromRoute($request, self::PARAM_PK_OCCUPANT, self::PARAM_PK_IMMEUBLE, self::PARAM_ENERGIE);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
