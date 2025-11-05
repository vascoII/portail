// Types pour le formulaire de relevé

export interface ReleveFormData {
  numeroImmeuble: string;
  batiment: string;
  escalier: string;
  etage: string;
  datePassage: string;

  prenom: string;
  nom: string;
  adresse: string;
  codePostal: string;
  ville: string;
  telephone: string;
  email: string;

  cuisine_ef_num: string;
  cuisine_ef: number;
  salleDeBains_ef_num: string;
  salleDeBains_ef: number;
  wc_ef_num: string;
  wc_ef: number;
  autreEmplacement_ef_loc: string;
  autreEmplacement_ef_num: string;
  autreEmplacement_ef: number;

  cuisine_ec_num: string;
  cuisine_ec: number;
  salleDeBains_ec_num: string;
  salleDeBains_ec: number;
  wc_ec_num: string;
  wc_ec: number;
  autreEmplacement_ec_loc: string;
  autreEmplacement_ec_num: string;
  autreEmplacement_ec: number;
}