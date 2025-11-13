/**
 * Request DTO for ReleveCompteursRequestDto
 * Corresponds to: App\Application\Dto\Input\Releve\ReleveCompteursDto
 */
export interface ReleveCompteursRequestDto {
  cuisineNum?: string | null;
  cuisine?: number | null;
  salleDeBainsNum?: string | null;
  salleDeBains?: number | null;
  wcNum?: string | null;
  wc?: number | null;
  autreEmplacementLoc?: string | null;
  autreEmplacementNum?: string | null;
  autreEmplacement?: number | null;
}
