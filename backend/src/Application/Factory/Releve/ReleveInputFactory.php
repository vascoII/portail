<?php

declare(strict_types=1);

namespace App\Application\Factory\Releve;

use App\Application\Dto\Input\Releve\GenerateReleveInputDto;
use App\Application\Dto\Input\Releve\ReleveCompteursDto;
use App\Application\Validator\Input\Releve\GenerateReleveInputValidator;
use Symfony\Component\HttpFoundation\Request;

final class ReleveInputFactory
{
    private array $data;

    public function __construct(
        private GenerateReleveInputValidator $validator
    ) {}

    public function generateReleveFromRequest(Request $request): GenerateReleveInputDto
    {
        $this->getData($request);

        $numeroImmeuble = $this->getString('numeroImmeuble');
        $batiment = $this->getString('batiment', null);
        $escalier = $this->getString('escalier', null);
        $etage = $this->getString('etage', null);
        $datePassage = $this->getDate('datePassage');

        $prenom = $this->getString('prenom');
        $nom = $this->getString('nom');
        $adresse = $this->getString('adresse');
        $codePostal = $this->getString('codePostal');
        $ville = $this->getString('ville');
        $telephone = $this->getString('telephone');
        $email = $this->getString('email');

        $cuisine_ef = $this->getInt('cuisine_ef', null);
        $salleDeBains_ef = $this->getInt('salleDeBains_ef', null);
        $wc_ef = $this->getInt('wc_ef', null);
        $autreEmplacement_ef = $this->getString('autreEmplacement_ef', null);

        $cuisine_ec = $this->getString('cuisine_ec', null);
        $salleDeBains_ec = $this->getInt('salleDeBains_ec', null);
        $wc_ec = $this->getInt('wc_ec', null);
        $autreEmplacement_ec = $this->getInt('autreEmplacement_ef', null);

        // Relevés des compteurs
        $eauFroide = new ReleveCompteursDto(
            $cuisine_ef,
            $salleDeBains_ef,
            $wc_ef,
            $autreEmplacement_ef
        );

        $eauChaude = new ReleveCompteursDto(
            $cuisine_ec,
            $salleDeBains_ec,
            $wc_ec,
            $autreEmplacement_ec
        );

        return new GenerateReleveInputDto(
            $numeroImmeuble,
            $batiment,
            $escalier,
            $etage,
            $datePassage,
            $prenom,
            $nom,
            $adresse,
            $codePostal,
            $ville,
            $telephone,
            $email,
            $eauFroide,
            $eauChaude
        );
    }

    private function getData(Request $request): void
    {
        $raw = (string) $request->getContent();
        $data = json_decode($raw, true);

        if (! is_array($data)) {
            $data = [];
        }

        $this->data = $data;
        // $this->validator->validate($this->data);
    }

    private function getDate(string $key): ?\DateTimeImmutable
    {
        return array_key_exists($key, $this->data) && null !== $this->data[$key]
            ? new \DateTimeImmutable($this->data[$key])
            : null;
    }

    private function getInt(string $key): ?int
    {
        return array_key_exists($key, $this->data) && null !== $this->data[$key]
            ? (int) $this->data[$key]
            : null;
    }

    private function getString(string $key): string
    {
        return array_key_exists($key, $this->data) && null !== $this->data[$key]
            ? (string) $this->data[$key]
            : '';
    }
}
