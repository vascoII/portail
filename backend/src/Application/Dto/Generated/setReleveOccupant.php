<?php

class setReleveOccupant
{

  /**
   * 
   * @var string $SuperLoginID
   * @access public
   */
  public $SuperLoginID = null;

  /**
   * 
   * @var string $SuperPassword
   * @access public
   */
  public $SuperPassword = null;

  /**
   * 
   * @var string $immeuble
   * @access public
   */
  public $immeuble = null;

  /**
   * 
   * @var string $batiment
   * @access public
   */
  public $batiment = null;

  /**
   * 
   * @var string $escalier
   * @access public
   */
  public $escalier = null;

  /**
   * 
   * @var string $etage
   * @access public
   */
  public $etage = null;

  /**
   * 
   * @var string $date_passage
   * @access public
   */
  public $date_passage = null;

  /**
   * 
   * @var string $prenom
   * @access public
   */
  public $prenom = null;

  /**
   * 
   * @var string $nom
   * @access public
   */
  public $nom = null;

  /**
   * 
   * @var string $adresse
   * @access public
   */
  public $adresse = null;

  /**
   * 
   * @var string $code_postal
   * @access public
   */
  public $code_postal = null;

  /**
   * 
   * @var string $ville
   * @access public
   */
  public $ville = null;

  /**
   * 
   * @var string $telephone
   * @access public
   */
  public $telephone = null;

  /**
   * 
   * @var string $email
   * @access public
   */
  public $email = null;

  /**
   * 
   * @var string $ef_cuisine
   * @access public
   */
  public $ef_cuisine = null;

  /**
   * 
   * @var string $ef_salle_de_bains
   * @access public
   */
  public $ef_salle_de_bains = null;

  /**
   * 
   * @var string $ef_wc
   * @access public
   */
  public $ef_wc = null;

  /**
   * 
   * @var string $ef_autre
   * @access public
   */
  public $ef_autre = null;

  /**
   * 
   * @var string $ef_nomautre
   * @access public
   */
  public $ef_nomautre = null;

  /**
   * 
   * @var string $ec_cuisine
   * @access public
   */
  public $ec_cuisine = null;

  /**
   * 
   * @var string $ec_salle_de_bains
   * @access public
   */
  public $ec_salle_de_bains = null;

  /**
   * 
   * @var string $ec_wc
   * @access public
   */
  public $ec_wc = null;

  /**
   * 
   * @var string $ec_autre
   * @access public
   */
  public $ec_autre = null;

  /**
   * 
   * @var string $ec_nomautre
   * @access public
   */
  public $ec_nomautre = null;

  /**
   * 
   * @param string $SuperLoginID
   * @param string $SuperPassword
   * @param string $immeuble
   * @param string $batiment
   * @param string $escalier
   * @param string $etage
   * @param string $date_passage
   * @param string $prenom
   * @param string $nom
   * @param string $adresse
   * @param string $code_postal
   * @param string $ville
   * @param string $telephone
   * @param string $email
   * @param string $ef_cuisine
   * @param string $ef_salle_de_bains
   * @param string $ef_wc
   * @param string $ef_autre
   * @param string $ef_nomautre
   * @param string $ec_cuisine
   * @param string $ec_salle_de_bains
   * @param string $ec_wc
   * @param string $ec_autre
   * @param string $ec_nomautre
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword, $immeuble, $batiment, $escalier, $etage, $date_passage, $prenom, $nom, $adresse, $code_postal, $ville, $telephone, $email, $ef_cuisine, $ef_salle_de_bains, $ef_wc, $ef_autre, $ef_nomautre, $ec_cuisine, $ec_salle_de_bains, $ec_wc, $ec_autre, $ec_nomautre)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
    $this->immeuble = $immeuble;
    $this->batiment = $batiment;
    $this->escalier = $escalier;
    $this->etage = $etage;
    $this->date_passage = $date_passage;
    $this->prenom = $prenom;
    $this->nom = $nom;
    $this->adresse = $adresse;
    $this->code_postal = $code_postal;
    $this->ville = $ville;
    $this->telephone = $telephone;
    $this->email = $email;
    $this->ef_cuisine = $ef_cuisine;
    $this->ef_salle_de_bains = $ef_salle_de_bains;
    $this->ef_wc = $ef_wc;
    $this->ef_autre = $ef_autre;
    $this->ef_nomautre = $ef_nomautre;
    $this->ec_cuisine = $ec_cuisine;
    $this->ec_salle_de_bains = $ec_salle_de_bains;
    $this->ec_wc = $ec_wc;
    $this->ec_autre = $ec_autre;
    $this->ec_nomautre = $ec_nomautre;
  }

}
