<?php

declare(strict_types=1);

namespace App\Http\Action\Logement;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Logement\EditUseCase;
use App\Application\Dto\Input\Logement\EditInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/gestionParc/{pkLogement}/edit', name: 'logement_edit', methods: ['POST'])]
final class EditAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly EditUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkLogement = (string) $request->attributes->get(self::PARAM_PK_LOGEMENT);
    $input = new EditInputDto($pkLogement);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
