<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Releve;

final class ReleveCompteursDto
{
    public ?string $autreEmplacement; // description si autre emplacement

    public ?int $cuisine;           // m³

    public ?int $salleDeBains;      // m³

    public ?int $wc;                // m³
}
