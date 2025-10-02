<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Output\Admin\GetSousTraitantsOutputDto;

interface FrontDataProviderInterface
{

 public function personalDatasService(): GetSousTraitantsOutputDto;
}
