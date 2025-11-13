/**
 * Request DTO for GenerateReleveRequestDto
 * Corresponds to: App\Application\Dto\Input\Releve\GenerateReleveInputDto
 */
import type { ReleveCompteursRequestDto } from './ReleveCompteursRequestDto';

export interface GenerateReleveRequestDto {
  numeroImmeuble: string;
  datePassage: string; // ISO date string
  prenom: string;
  nom: string;
  adresse: string;
  codePostal: string;
  ville: string;
  telephone: string;
  email: string;
  batiment?: string | null;
  escalier?: string | null;
  etage?: string | null;
  eauChaude: ReleveCompteursRequestDto;
  eauFroide: ReleveCompteursRequestDto;
}
