<?php

declare(strict_types=1);

namespace App\Http\Action\Facture;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Facture\IndexUseCase;
use App\Application\Dto\Input\Facture\IndexInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/factures', name: 'facture_index', methods: ['GET'])]
final class IndexAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly IndexUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new IndexInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
