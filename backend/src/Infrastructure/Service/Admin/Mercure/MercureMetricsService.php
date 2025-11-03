<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Admin\Mercure;

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\InMemory;

final class MercureMetricsService
{
    private CollectorRegistry $registry;

    public function __construct()
    {
        $this->registry = new CollectorRegistry(new InMemory());
    }

    public function getMetrics(): string
    {
        $renderer = new RenderTextFormat();

        return $renderer->render($this->registry->getMetricFamilySamples());
    }

    public function incrementPublication(string $routeName): void
    {
        $counter = $this->registry->getOrRegisterCounter(
            'mercure',
            'publications_total',
            'Total Mercure publications per route',
            ['route']
        );

        $counter->inc([$routeName]);
    }
}
