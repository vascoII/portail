<?php

declare(strict_types=1);

namespace App\Http\Action\Occupant;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Occupant\ShowNoteReleveUseCase;
use App\Application\Dto\Input\Occupant\ShowNoteReleveInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/occupant/{pkOccupant}/releve_note/{pkImmeuble}/{energie}', name: 'occupant_note_releve', methods: ['GET'])]
final class ShowNoteReleveAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly ShowNoteReleveUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkOccupant = (string) $request->attributes->get(self::PARAM_PK_OCCUPANT);
    $pkImmeuble = (string) $request->attributes->get(self::PARAM_PK_IMMEUBLE);
    $energie = (string) $request->attributes->get(self::PARAM_ENERGIE);
    $input = new ShowNoteReleveInputDto($pkOccupant, $pkImmeuble, $energie);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
