<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\External;

final class GetReportByTokenDataSourceOutputDto
{
  
  public function __construct(
      public readonly ?string $pdfContent
  ) {

  }
}
