<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\Mercure;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Infrastructure\Service\Admin\Mercure\MercureMetricsService;
use Prometheus\RenderTextFormat;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/admin/mercure_metrics', name: 'admin_mercure_metrics', methods: ['GET'])]
final class MercureAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly MercureMetricsService $metricsService
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        return new Response(
            $this->metricsService->getMetrics(),
            200,
            ['Content-Type' => RenderTextFormat::MIME_TYPE]
        );
    }
}
