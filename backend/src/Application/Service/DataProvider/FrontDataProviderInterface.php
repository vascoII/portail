<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Output\Admin\ListSousTraitantOutputDto;

interface FrontDataProviderInterface
{

 public function personalDatasService(): ListSousTraitantOutputDto;
}
