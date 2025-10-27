<?php

declare(strict_types=1);

namespace App\Http\Action\Operator;

use App\Application\Dto\Input\Operator\AddBuildingInputDto;
use App\Application\UseCase\Operator\AddBuildingUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Attribute\RequireUserType;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/operator/{id}/immeuble/ajouter', name: 'operator_add_building', methods: ['POST'])]
#[RequireUserType(['C'])] // Seuls Client
final class AddBuildingToOperatorAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder, 
        private readonly AddBuildingUseCase $useCase
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $id = (string) $request->attributes->get(self::PARAM_ID);
        $input = new AddBuildingInputDto($id);
        $output = $this->useCase->execute($input);

        return $this->responder->respond($output);
    }
}
