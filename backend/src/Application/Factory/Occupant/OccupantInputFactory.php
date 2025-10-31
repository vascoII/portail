<?php

declare(strict_types=1);

namespace App\Application\Factory\Occupant;

use App\Application\Dto\Input\Occupant\PatchOccupantInputDto;
use App\Application\Dto\Input\Occupant\PostOccupantInputDto;
use App\Application\Dto\Input\Shared\GetByEnergyStringInputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use Symfony\Component\HttpFoundation\Request;

final class OccupantInputFactory
{
    public function createGetByEnergyFromRequest(Request $request, array $args = []): GetByEnergyStringInputDto
    {
        $energy = (string) ($args['energy'] ?? $request->query->get('energy', ''));

        return new GetByEnergyStringInputDto($energy);
    }

    public function createGetByIdFromRequest(Request $request, array $args = []): GetByIdIntInputDto
    {
        $id = (int) ($args['id'] ?? $request->query->get('id', 0));

        return new GetByIdIntInputDto($id);
    }

    public function createPatchOccupantFromRequest(Request $request, array $args = []): PatchOccupantInputDto
    {
        $raw = (string) $request->getContent();
        $data = json_decode($raw, true);

        if (! is_array($data)) {
            $data = [];
        }

        $pkOccupant = (int) ($args['id'] ?? $request->query->get('id', ''));

        $nom = array_key_exists('nom', $data) && null !== $data['nom']
          ? (string) $data['nom']
          : '';
        $ref = array_key_exists('ref', $data) && null !== $data['ref']
          ? (string) $data['ref']
          : '';
        $dateArrivee = array_key_exists('dateArrivee', $data) && null !== $data['dateArrivee']
          ? (string) $data['dateArrivee']
          : '';
        $dateDepart = array_key_exists('dateDepart', $data) && null !== $data['dateDepart']
          ? (string) $data['dateDepart']
          : '';

        return new PatchOccupantInputDto(
            $pkOccupant,
            $nom,
            $ref,
            new \DateTimeImmutable($dateArrivee),
            new \DateTimeImmutable($dateDepart)
        );
    }

    public function createPostOccupantFromRequest(Request $request, array $args = []): PostOccupantInputDto
    {
        $raw = (string) $request->getContent();
        $data = json_decode($raw, true);

        if (! is_array($data)) {
            $data = [];
        }

        $nom = array_key_exists('nom', $data) && null !== $data['nom']
          ? (string) $data['nom']
          : '';
        $ref = array_key_exists('ref', $data) && null !== $data['ref']
          ? (string) $data['ref']
          : '';
        $dateArrivee = array_key_exists('dateArrivee', $data) && null !== $data['dateArrivee']
          ? (string) $data['dateArrivee']
          : '';
        $dateDepart = array_key_exists('dateDepart', $data) && null !== $data['dateDepart']
          ? (string) $data['dateDepart']
          : '';

        return new PostOccupantInputDto(
            $nom,
            $ref,
            new \DateTimeImmutable($dateArrivee),
            new \DateTimeImmutable($dateDepart)
        );
    }
}
