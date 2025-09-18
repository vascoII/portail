<?php

declare(strict_types=1);

namespace App\Http\Action\Front;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Front\IndexUseCase;
use App\Application\Dto\Input\Front\IndexInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/', name: 'front_index', methods: ['GET'])]
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
