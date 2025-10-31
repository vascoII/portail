<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

interface ParcDataSourceInterface
{
    public function fetchGetParc(): object;
}
