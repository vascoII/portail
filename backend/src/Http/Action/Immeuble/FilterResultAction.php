<?php

declare(strict_types=1);

namespace App\Http\Action\Immeuble;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Immeuble\FilterResultUseCase;
use App\Application\Dto\Input\Immeuble\FilterResultInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/immeuble/filter', name: 'immeuble_filter', methods: ['POST'])]
final class FilterResultAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly FilterResultUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new FilterResultInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
