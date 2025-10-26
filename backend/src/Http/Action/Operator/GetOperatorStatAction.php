<?php

declare(strict_types=1);

namespace App\Http\Action\Operator;

use App\Application\Factory\Operator\OperatorInputFactory;
use App\Application\UseCase\Operator\GetOperatorStatUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Attribute\RequireUserType;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/operator/{id}/stats', name: 'operator_stats_get', methods: ['GET'])]
#[RequireUserType(['C'])] // Seuls Client
final class GetOperatorStatAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly GetOperatorStatUseCase $useCase,
        private readonly OperatorInputFactory $inputFactory
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $input = $this->inputFactory->getOperatorFromRoute($request);
        $output = $this->useCase->execute($input);

        return $this->responder->respond($output);
    }
}
