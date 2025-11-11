/**
 * DTO for getting parc (portfolio) data
 * Corresponds to: App\Application\Dto\Output\Parc\GetParcOutputDto
 */
export interface GetParcResponseDto {
  // Building counts
  nbImmeubles: number;
  nbImmeublesTelereleve: number;
  nbImmeublesTransfertFichiers: number;

  // Counter counts
  nbCompteursARelever: number;
  nbCompteursReleves: number;
  nbLogements: number;
  nbCompteurs: number;

  // Counter types
  nbCompteursEc: number; // Eau Chaude
  nbCompteursEf: number; // Eau Froide
  nbCompteursRepart: number; // Répartiteurs
  nbCompteursCet: number; // Compteur d'énergie thermique
  nbCompteursCapteur: number; // Capteurs
  nbCompteursElect: number; // Électricité
  nbCompteursGaz: number; // Gaz

  // Alert counts
  nbFuites: number;
  degresFuites: number;
  nbDepannages: number;
  degresDepannages: number;
  nbDysfonctionnements: number;
  degresDysfonctionnements: number;
  nbAnomalies: number;
  degresAnomalies: number;

  // Construction data
  nbChantiers: number;
  nbCompteursPoses: number;
  nbCompteursCommandes: number;

  // Percentages
  pcImmeublesTelereleve: number;
  pcImmeublesTransfertFichiers: number;
}

