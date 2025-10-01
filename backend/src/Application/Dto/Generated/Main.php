<?php

include_once('GetHello.php');
include_once('GetHelloResponse.php');
include_once('GetInfosImmeubles.php');
include_once('GetInfosImmeublesResponse.php');
include_once('infosImmeubles.php');
include_once('retour.php');
include_once('infosImmeuble.php');
include_once('immeuble.php');
include_once('GetImmeublesByPKUser.php');
include_once('GetImmeublesByPKUserResponse.php');
include_once('immeubles.php');
include_once('SetImmeubles.php');
include_once('SetImmeublesResponse.php');
include_once('Login.php');
include_once('LoginResponse.php');
include_once('session.php');
include_once('user.php');
include_once('LoginFromParam.php');
include_once('LoginFromParamResponse.php');
include_once('GetLoginToken.php');
include_once('GetLoginTokenResponse.php');
include_once('Logout.php');
include_once('LogoutResponse.php');
include_once('CreateGestionnaire.php');
include_once('CreateGestionnaireResponse.php');
include_once('CreateOccupants.php');
include_once('CreateOccupantsResponse.php');
include_once('users.php');
include_once('CreateDirecteur.php');
include_once('CreateDirecteurResponse.php');
include_once('CreateOccupant.php');
include_once('CreateOccupantResponse.php');
include_once('GetChildUsers.php');
include_once('GetChildUsersResponse.php');
include_once('GetUsers.php');
include_once('GetUsersResponse.php');
include_once('DeleteUser.php');
include_once('DeleteUserResponse.php');
include_once('GetUser.php');
include_once('GetUserResponse.php');
include_once('GetUserByLogin.php');
include_once('GetUserByLoginResponse.php');
include_once('UpdatePassword.php');
include_once('UpdatePasswordResponse.php');
include_once('UpdateUser.php');
include_once('UpdateUserResponse.php');
include_once('UpdateUser2.php');
include_once('UpdateUser2Response.php');
include_once('UpdateUser3.php');
include_once('UpdateUser3Response.php');
include_once('ResetPasswordFromEmail2.php');
include_once('ResetPasswordFromEmail2Response.php');
include_once('ResetPasswordFromEmail.php');
include_once('ResetPasswordFromEmailResponse.php');
include_once('ResetPasswordFromPKUser.php');
include_once('ResetPasswordFromPKUserResponse.php');
include_once('SendEmailToUser.php');
include_once('SendEmailToUserResponse.php');
include_once('UpdateExpirationDateFromPKUser.php');
include_once('UpdateExpirationDateFromPKUserResponse.php');
include_once('UpdateCGUFromPKUser.php');
include_once('UpdateCGUFromPKUserResponse.php');
include_once('UpdateEmailFromPKUser.php');
include_once('UpdateEmailFromPKUserResponse.php');
include_once('GetTchWeekPwd.php');
include_once('GetTchWeekPwdResponse.php');
include_once('GetExportParams.php');
include_once('GetExportParamsResponse.php');
include_once('userExportParams.php');
include_once('GetTableauBordImmeuble.php');
include_once('GetTableauBordImmeubleResponse.php');
include_once('tableauDeBordImmeuble.php');
include_once('immeubleEAU.php');
include_once('chantier.php');
include_once('topConsos.php');
include_once('conso.php');
include_once('serie.php');
include_once('releve.php');
include_once('immeubleRepart.php');
include_once('immeubleCET.php');
include_once('immeubleCapteur.php');
include_once('indexRecapDate.php');
include_once('immeubleElect.php');
include_once('immeubleGaz.php');
include_once('GetConsoImmeuble.php');
include_once('GetConsoImmeubleResponse.php');
include_once('GetTableauBordClient.php');
include_once('GetTableauBordClientResponse.php');
include_once('tableauDeBordClient.php');
include_once('GetReport.php');
include_once('GetReportResponse.php');
include_once('GetExcel.php');
include_once('GetExcelResponse.php');
include_once('GetNoteInfo.php');
include_once('GetNoteInfoResponse.php');
include_once('GetInfosLogements.php');
include_once('GetInfosLogementsResponse.php');
include_once('infosLogements.php');
include_once('infosLogement.php');
include_once('logement.php');
include_once('occupant.php');
include_once('appareil.php');
include_once('GetInfosLogementsByImmeuble.php');
include_once('GetInfosLogementsByImmeubleResponse.php');
include_once('GetTableauBordLogement.php');
include_once('GetTableauBordLogementResponse.php');
include_once('tableauDeBordLogement.php');
include_once('logementEAU.php');
include_once('consosPeriode.php');
include_once('indexReleve.php');
include_once('infosAppareilEAU.php');
include_once('logementRepart.php');
include_once('infosAppareilRepart.php');
include_once('consoPieceRepart.php');
include_once('logementCET.php');
include_once('infosAppareilCET.php');
include_once('logementCapteur.php');
include_once('logementElect.php');
include_once('infosAppareilElect.php');
include_once('logementGaz.php');
include_once('infosAppareilGaz.php');
include_once('GetInfosFuitesByImmeuble.php');
include_once('GetInfosFuitesByImmeubleResponse.php');
include_once('infosFuites.php');
include_once('infosFuite.php');
include_once('fuite.php');
include_once('GetInfosAppareilsByLogementEC.php');
include_once('GetInfosAppareilsByLogementECResponse.php');
include_once('infosAppareilsEAU.php');
include_once('GetInfosAppareilsByLogementEF.php');
include_once('GetInfosAppareilsByLogementEFResponse.php');
include_once('GetInfosAppareilsByLogementRepart.php');
include_once('GetInfosAppareilsByLogementRepartResponse.php');
include_once('infosAppareilsRepart.php');
include_once('GetInfosAppareilsByLogementCET.php');
include_once('GetInfosAppareilsByLogementCETResponse.php');
include_once('infosAppareilsCET.php');
include_once('GetInfosAppareilsByLogementElect.php');
include_once('GetInfosAppareilsByLogementElectResponse.php');
include_once('infosAppareilsElect.php');
include_once('GetInfosAppareilsByLogementGaz.php');
include_once('GetInfosAppareilsByLogementGazResponse.php');
include_once('infosAppareilsGaz.php');
include_once('GetInfosDysfonctionnementsByImmeuble.php');
include_once('GetInfosDysfonctionnementsByImmeubleResponse.php');
include_once('infosDysfonctionnements.php');
include_once('infosDysfonctionnement.php');
include_once('dysfonctionnement.php');
include_once('GetInfosAnomaliesByImmeuble.php');
include_once('GetInfosAnomaliesByImmeubleResponse.php');
include_once('infosAnomalies.php');
include_once('infosAnomalie.php');
include_once('anomalie.php');
include_once('GetInfosDepannagesByImmeuble.php');
include_once('GetInfosDepannagesByImmeubleResponse.php');
include_once('infosDepannages.php');
include_once('infosDepannage.php');
include_once('depannage.php');
include_once('GetDetailsDepannage.php');
include_once('GetDetailsDepannageResponse.php');
include_once('detailsDepannage.php');
include_once('GetUsersBigData.php');
include_once('GetUsersBigDataResponse.php');
include_once('usersBigData.php');
include_once('GetFile.php');
include_once('GetFileResponse.php');
include_once('CheckTicketsInterEnabled.php');
include_once('CheckTicketsInterEnabledResponse.php');
include_once('GetNbTicketsInterByLogement.php');
include_once('GetNbTicketsInterByLogementResponse.php');
include_once('GetTicketInterInit.php');
include_once('GetTicketInterInitResponse.php');
include_once('ticketInterInit.php');
include_once('SetTicketStatus.php');
include_once('SetTicketStatusResponse.php');
include_once('CreateTicketInter.php');
include_once('CreateTicketInterResponse.php');
include_once('GetTicketsIntersUser.php');
include_once('GetTicketsIntersUserResponse.php');
include_once('ticketsInter.php');
include_once('ticketInter.php');
include_once('GetNbTicketsIntersUser.php');
include_once('GetNbTicketsIntersUserResponse.php');
include_once('SetSeuilConso.php');
include_once('SetSeuilConsoResponse.php');
include_once('getCase.php');
include_once('getCaseResponse.php');
include_once('caseSF.php');
include_once('workOrderSF.php');
include_once('workOrderLineItemSF.php');
include_once('getFactures.php');
include_once('getFacturesResponse.php');
include_once('factures.php');
include_once('facture.php');
include_once('getOccupants4Chgt.php');
include_once('getOccupants4ChgtResponse.php');
include_once('occupant4Chgt.php');
include_once('setOccupants4Chgt.php');
include_once('setOccupants4ChgtResponse.php');
include_once('getOccupants4Chgt4LER.php');
include_once('getOccupants4Chgt4LERResponse.php');
include_once('setOccupants4Chgt4LER.php');
include_once('setOccupants4Chgt4LERResponse.php');
include_once('setReleveOccupant.php');
include_once('setReleveOccupantResponse.php');
include_once('GetSousTraitants.php');
include_once('GetSousTraitantsResponse.php');
include_once('sousTraitant.php');
include_once('GetStatOccupants.php');
include_once('GetStatOccupantsResponse.php');
include_once('userLog.php');
include_once('GetStatOccupants2.php');
include_once('GetStatOccupants2Response.php');
include_once('GetStatOccupantsGraph.php');
include_once('GetStatOccupantsGraphResponse.php');
include_once('GraphPoint.php');
include_once('GetStatClient.php');
include_once('GetStatClientResponse.php');
include_once('ResetPassword.php');
include_once('ResetPasswordResponse.php');
include_once('GetResetTokenIDValidation.php');
include_once('GetResetTokenIDValidationResponse.php');
include_once('UpdateExpirationDateOccupants.php');
include_once('UpdateExpirationDateOccupantsResponse.php');
include_once('InsertReportToken.php');
include_once('InsertReportTokenResponse.php');
include_once('GetReportByToken.php');
include_once('GetReportByTokenResponse.php');


/**
 * 
 */
class Main extends \SoapClient
{

  /**
   * 
   * @var array $classmap The defined classes
   * @access private
   */
  private static $classmap = array(
    'GetHello' => '\\GetHello',
    'GetHelloResponse' => '\\GetHelloResponse',
    'GetInfosImmeubles' => '\\GetInfosImmeubles',
    'GetInfosImmeublesResponse' => '\\GetInfosImmeublesResponse',
    'infosImmeubles' => '\\infosImmeubles',
    'retour' => '\\retour',
    'infosImmeuble' => '\\infosImmeuble',
    'immeuble' => '\\immeuble',
    'GetImmeublesByPKUser' => '\\GetImmeublesByPKUser',
    'GetImmeublesByPKUserResponse' => '\\GetImmeublesByPKUserResponse',
    'immeubles' => '\\immeubles',
    'SetImmeubles' => '\\SetImmeubles',
    'SetImmeublesResponse' => '\\SetImmeublesResponse',
    'Login' => '\\Login',
    'LoginResponse' => '\\LoginResponse',
    'session' => '\\session',
    'user' => '\\user',
    'LoginFromParam' => '\\LoginFromParam',
    'LoginFromParamResponse' => '\\LoginFromParamResponse',
    'GetLoginToken' => '\\GetLoginToken',
    'GetLoginTokenResponse' => '\\GetLoginTokenResponse',
    'Logout' => '\\Logout',
    'LogoutResponse' => '\\LogoutResponse',
    'CreateGestionnaire' => '\\CreateGestionnaire',
    'CreateGestionnaireResponse' => '\\CreateGestionnaireResponse',
    'CreateOccupants' => '\\CreateOccupants',
    'CreateOccupantsResponse' => '\\CreateOccupantsResponse',
    'users' => '\\users',
    'CreateDirecteur' => '\\CreateDirecteur',
    'CreateDirecteurResponse' => '\\CreateDirecteurResponse',
    'CreateOccupant' => '\\CreateOccupant',
    'CreateOccupantResponse' => '\\CreateOccupantResponse',
    'GetChildUsers' => '\\GetChildUsers',
    'GetChildUsersResponse' => '\\GetChildUsersResponse',
    'GetUsers' => '\\GetUsers',
    'GetUsersResponse' => '\\GetUsersResponse',
    'DeleteUser' => '\\DeleteUser',
    'DeleteUserResponse' => '\\DeleteUserResponse',
    'GetUser' => '\\GetUser',
    'GetUserResponse' => '\\GetUserResponse',
    'GetUserByLogin' => '\\GetUserByLogin',
    'GetUserByLoginResponse' => '\\GetUserByLoginResponse',
    'UpdatePassword' => '\\UpdatePassword',
    'UpdatePasswordResponse' => '\\UpdatePasswordResponse',
    'UpdateUser' => '\\UpdateUser',
    'UpdateUserResponse' => '\\UpdateUserResponse',
    'UpdateUser2' => '\\UpdateUser2',
    'UpdateUser2Response' => '\\UpdateUser2Response',
    'UpdateUser3' => '\\UpdateUser3',
    'UpdateUser3Response' => '\\UpdateUser3Response',
    'ResetPasswordFromEmail2' => '\\ResetPasswordFromEmail2',
    'ResetPasswordFromEmail2Response' => '\\ResetPasswordFromEmail2Response',
    'ResetPasswordFromEmail' => '\\ResetPasswordFromEmail',
    'ResetPasswordFromEmailResponse' => '\\ResetPasswordFromEmailResponse',
    'ResetPasswordFromPKUser' => '\\ResetPasswordFromPKUser',
    'ResetPasswordFromPKUserResponse' => '\\ResetPasswordFromPKUserResponse',
    'SendEmailToUser' => '\\SendEmailToUser',
    'SendEmailToUserResponse' => '\\SendEmailToUserResponse',
    'UpdateExpirationDateFromPKUser' => '\\UpdateExpirationDateFromPKUser',
    'UpdateExpirationDateFromPKUserResponse' => '\\UpdateExpirationDateFromPKUserResponse',
    'UpdateCGUFromPKUser' => '\\UpdateCGUFromPKUser',
    'UpdateCGUFromPKUserResponse' => '\\UpdateCGUFromPKUserResponse',
    'UpdateEmailFromPKUser' => '\\UpdateEmailFromPKUser',
    'UpdateEmailFromPKUserResponse' => '\\UpdateEmailFromPKUserResponse',
    'GetTchWeekPwd' => '\\GetTchWeekPwd',
    'GetTchWeekPwdResponse' => '\\GetTchWeekPwdResponse',
    'GetExportParams' => '\\GetExportParams',
    'GetExportParamsResponse' => '\\GetExportParamsResponse',
    'userExportParams' => '\\userExportParams',
    'GetTableauBordImmeuble' => '\\GetTableauBordImmeuble',
    'GetTableauBordImmeubleResponse' => '\\GetTableauBordImmeubleResponse',
    'tableauDeBordImmeuble' => '\\tableauDeBordImmeuble',
    'immeubleEAU' => '\\immeubleEAU',
    'chantier' => '\\chantier',
    'topConsos' => '\\topConsos',
    'conso' => '\\conso',
    'serie' => '\\serie',
    'releve' => '\\releve',
    'immeubleRepart' => '\\immeubleRepart',
    'immeubleCET' => '\\immeubleCET',
    'immeubleCapteur' => '\\immeubleCapteur',
    'indexRecapDate' => '\\indexRecapDate',
    'immeubleElect' => '\\immeubleElect',
    'immeubleGaz' => '\\immeubleGaz',
    'GetConsoImmeuble' => '\\GetConsoImmeuble',
    'GetConsoImmeubleResponse' => '\\GetConsoImmeubleResponse',
    'GetTableauBordClient' => '\\GetTableauBordClient',
    'GetTableauBordClientResponse' => '\\GetTableauBordClientResponse',
    'tableauDeBordClient' => '\\tableauDeBordClient',
    'GetReport' => '\\GetReport',
    'GetReportResponse' => '\\GetReportResponse',
    'GetExcel' => '\\GetExcel',
    'GetExcelResponse' => '\\GetExcelResponse',
    'GetNoteInfo' => '\\GetNoteInfo',
    'GetNoteInfoResponse' => '\\GetNoteInfoResponse',
    'GetInfosLogements' => '\\GetInfosLogements',
    'GetInfosLogementsResponse' => '\\GetInfosLogementsResponse',
    'infosLogements' => '\\infosLogements',
    'infosLogement' => '\\infosLogement',
    'logement' => '\\logement',
    'occupant' => '\\occupant',
    'appareil' => '\\appareil',
    'GetInfosLogementsByImmeuble' => '\\GetInfosLogementsByImmeuble',
    'GetInfosLogementsByImmeubleResponse' => '\\GetInfosLogementsByImmeubleResponse',
    'GetTableauBordLogement' => '\\GetTableauBordLogement',
    'GetTableauBordLogementResponse' => '\\GetTableauBordLogementResponse',
    'tableauDeBordLogement' => '\\tableauDeBordLogement',
    'logementEAU' => '\\logementEAU',
    'consosPeriode' => '\\consosPeriode',
    'indexReleve' => '\\indexReleve',
    'infosAppareilEAU' => '\\infosAppareilEAU',
    'logementRepart' => '\\logementRepart',
    'infosAppareilRepart' => '\\infosAppareilRepart',
    'consoPieceRepart' => '\\consoPieceRepart',
    'logementCET' => '\\logementCET',
    'infosAppareilCET' => '\\infosAppareilCET',
    'logementCapteur' => '\\logementCapteur',
    'logementElect' => '\\logementElect',
    'infosAppareilElect' => '\\infosAppareilElect',
    'logementGaz' => '\\logementGaz',
    'infosAppareilGaz' => '\\infosAppareilGaz',
    'GetInfosFuitesByImmeuble' => '\\GetInfosFuitesByImmeuble',
    'GetInfosFuitesByImmeubleResponse' => '\\GetInfosFuitesByImmeubleResponse',
    'infosFuites' => '\\infosFuites',
    'infosFuite' => '\\infosFuite',
    'fuite' => '\\fuite',
    'GetInfosAppareilsByLogementEC' => '\\GetInfosAppareilsByLogementEC',
    'GetInfosAppareilsByLogementECResponse' => '\\GetInfosAppareilsByLogementECResponse',
    'infosAppareilsEAU' => '\\infosAppareilsEAU',
    'GetInfosAppareilsByLogementEF' => '\\GetInfosAppareilsByLogementEF',
    'GetInfosAppareilsByLogementEFResponse' => '\\GetInfosAppareilsByLogementEFResponse',
    'GetInfosAppareilsByLogementRepart' => '\\GetInfosAppareilsByLogementRepart',
    'GetInfosAppareilsByLogementRepartResponse' => '\\GetInfosAppareilsByLogementRepartResponse',
    'infosAppareilsRepart' => '\\infosAppareilsRepart',
    'GetInfosAppareilsByLogementCET' => '\\GetInfosAppareilsByLogementCET',
    'GetInfosAppareilsByLogementCETResponse' => '\\GetInfosAppareilsByLogementCETResponse',
    'infosAppareilsCET' => '\\infosAppareilsCET',
    'GetInfosAppareilsByLogementElect' => '\\GetInfosAppareilsByLogementElect',
    'GetInfosAppareilsByLogementElectResponse' => '\\GetInfosAppareilsByLogementElectResponse',
    'infosAppareilsElect' => '\\infosAppareilsElect',
    'GetInfosAppareilsByLogementGaz' => '\\GetInfosAppareilsByLogementGaz',
    'GetInfosAppareilsByLogementGazResponse' => '\\GetInfosAppareilsByLogementGazResponse',
    'infosAppareilsGaz' => '\\infosAppareilsGaz',
    'GetInfosDysfonctionnementsByImmeuble' => '\\GetInfosDysfonctionnementsByImmeuble',
    'GetInfosDysfonctionnementsByImmeubleResponse' => '\\GetInfosDysfonctionnementsByImmeubleResponse',
    'infosDysfonctionnements' => '\\infosDysfonctionnements',
    'infosDysfonctionnement' => '\\infosDysfonctionnement',
    'dysfonctionnement' => '\\dysfonctionnement',
    'GetInfosAnomaliesByImmeuble' => '\\GetInfosAnomaliesByImmeuble',
    'GetInfosAnomaliesByImmeubleResponse' => '\\GetInfosAnomaliesByImmeubleResponse',
    'infosAnomalies' => '\\infosAnomalies',
    'infosAnomalie' => '\\infosAnomalie',
    'anomalie' => '\\anomalie',
    'GetInfosDepannagesByImmeuble' => '\\GetInfosDepannagesByImmeuble',
    'GetInfosDepannagesByImmeubleResponse' => '\\GetInfosDepannagesByImmeubleResponse',
    'infosDepannages' => '\\infosDepannages',
    'infosDepannage' => '\\infosDepannage',
    'depannage' => '\\depannage',
    'GetDetailsDepannage' => '\\GetDetailsDepannage',
    'GetDetailsDepannageResponse' => '\\GetDetailsDepannageResponse',
    'detailsDepannage' => '\\detailsDepannage',
    'GetUsersBigData' => '\\GetUsersBigData',
    'GetUsersBigDataResponse' => '\\GetUsersBigDataResponse',
    'usersBigData' => '\\usersBigData',
    'GetFile' => '\\GetFile',
    'GetFileResponse' => '\\GetFileResponse',
    'CheckTicketsInterEnabled' => '\\CheckTicketsInterEnabled',
    'CheckTicketsInterEnabledResponse' => '\\CheckTicketsInterEnabledResponse',
    'GetNbTicketsInterByLogement' => '\\GetNbTicketsInterByLogement',
    'GetNbTicketsInterByLogementResponse' => '\\GetNbTicketsInterByLogementResponse',
    'GetTicketInterInit' => '\\GetTicketInterInit',
    'GetTicketInterInitResponse' => '\\GetTicketInterInitResponse',
    'ticketInterInit' => '\\ticketInterInit',
    'SetTicketStatus' => '\\SetTicketStatus',
    'SetTicketStatusResponse' => '\\SetTicketStatusResponse',
    'CreateTicketInter' => '\\CreateTicketInter',
    'CreateTicketInterResponse' => '\\CreateTicketInterResponse',
    'GetTicketsIntersUser' => '\\GetTicketsIntersUser',
    'GetTicketsIntersUserResponse' => '\\GetTicketsIntersUserResponse',
    'ticketsInter' => '\\ticketsInter',
    'ticketInter' => '\\ticketInter',
    'GetNbTicketsIntersUser' => '\\GetNbTicketsIntersUser',
    'GetNbTicketsIntersUserResponse' => '\\GetNbTicketsIntersUserResponse',
    'SetSeuilConso' => '\\SetSeuilConso',
    'SetSeuilConsoResponse' => '\\SetSeuilConsoResponse',
    'getCase' => '\\getCase',
    'getCaseResponse' => '\\getCaseResponse',
    'caseSF' => '\\caseSF',
    'workOrderSF' => '\\workOrderSF',
    'workOrderLineItemSF' => '\\workOrderLineItemSF',
    'getFactures' => '\\getFactures',
    'getFacturesResponse' => '\\getFacturesResponse',
    'factures' => '\\factures',
    'facture' => '\\facture',
    'getOccupants4Chgt' => '\\getOccupants4Chgt',
    'getOccupants4ChgtResponse' => '\\getOccupants4ChgtResponse',
    'occupant4Chgt' => '\\occupant4Chgt',
    'setOccupants4Chgt' => '\\setOccupants4Chgt',
    'setOccupants4ChgtResponse' => '\\setOccupants4ChgtResponse',
    'getOccupants4Chgt4LER' => '\\getOccupants4Chgt4LER',
    'getOccupants4Chgt4LERResponse' => '\\getOccupants4Chgt4LERResponse',
    'setOccupants4Chgt4LER' => '\\setOccupants4Chgt4LER',
    'setOccupants4Chgt4LERResponse' => '\\setOccupants4Chgt4LERResponse',
    'setReleveOccupant' => '\\setReleveOccupant',
    'setReleveOccupantResponse' => '\\setReleveOccupantResponse',
    'GetSousTraitants' => '\\GetSousTraitants',
    'GetSousTraitantsResponse' => '\\GetSousTraitantsResponse',
    'sousTraitant' => '\\sousTraitant',
    'GetStatOccupants' => '\\GetStatOccupants',
    'GetStatOccupantsResponse' => '\\GetStatOccupantsResponse',
    'userLog' => '\\userLog',
    'GetStatOccupants2' => '\\GetStatOccupants2',
    'GetStatOccupants2Response' => '\\GetStatOccupants2Response',
    'GetStatOccupantsGraph' => '\\GetStatOccupantsGraph',
    'GetStatOccupantsGraphResponse' => '\\GetStatOccupantsGraphResponse',
    'GraphPoint' => '\\GraphPoint',
    'GetStatClient' => '\\GetStatClient',
    'GetStatClientResponse' => '\\GetStatClientResponse',
    'ResetPassword' => '\\ResetPassword',
    'ResetPasswordResponse' => '\\ResetPasswordResponse',
    'GetResetTokenIDValidation' => '\\GetResetTokenIDValidation',
    'GetResetTokenIDValidationResponse' => '\\GetResetTokenIDValidationResponse',
    'UpdateExpirationDateOccupants' => '\\UpdateExpirationDateOccupants',
    'UpdateExpirationDateOccupantsResponse' => '\\UpdateExpirationDateOccupantsResponse',
    'InsertReportToken' => '\\InsertReportToken',
    'InsertReportTokenResponse' => '\\InsertReportTokenResponse',
    'GetReportByToken' => '\\GetReportByToken',
    'GetReportByTokenResponse' => '\\GetReportByTokenResponse');

  /**
   * 
   * @param array $options A array of config values
   * @param string $wsdl The wsdl file to use
   * @access public
   */
  public function __construct(array $options = array(), $wsdl = 'http://techn5292.eu.techem.corp:8083/Main.asmx?wsdl')
  {
    foreach (self::$classmap as $key => $value) {
    if (!isset($options['classmap'][$key])) {
      $options['classmap'][$key] = $value;
    }
  }
  
  parent::__construct($wsdl, $options);
  }

  /**
   * 
   * @param GetHello $parameters
   * @access public
   * @return GetHelloResponse
   */
  public function GetHello(GetHello $parameters)
  {
    return $this->__soapCall('GetHello', array($parameters));
  }

  /**
   * 
   * @param GetInfosImmeubles $parameters
   * @access public
   * @return GetInfosImmeublesResponse
   */
  public function GetInfosImmeubles(GetInfosImmeubles $parameters)
  {
    return $this->__soapCall('GetInfosImmeubles', array($parameters));
  }

  /**
   * 
   * @param GetImmeublesByPKUser $parameters
   * @access public
   * @return GetImmeublesByPKUserResponse
   */
  public function GetImmeublesByPKUser(GetImmeublesByPKUser $parameters)
  {
    return $this->__soapCall('GetImmeublesByPKUser', array($parameters));
  }

  /**
   * 
   * @param SetImmeubles $parameters
   * @access public
   * @return SetImmeublesResponse
   */
  public function SetImmeubles(SetImmeubles $parameters)
  {
    return $this->__soapCall('SetImmeubles', array($parameters));
  }

  /**
   * 
   * @param Login $parameters
   * @access public
   * @return LoginResponse
   */
  public function Login(Login $parameters)
  {
    return $this->__soapCall('Login', array($parameters));
  }

  /**
   * 
   * @param LoginFromParam $parameters
   * @access public
   * @return LoginFromParamResponse
   */
  public function LoginFromParam(LoginFromParam $parameters)
  {
    return $this->__soapCall('LoginFromParam', array($parameters));
  }

  /**
   * 
   * @param GetLoginToken $parameters
   * @access public
   * @return GetLoginTokenResponse
   */
  public function GetLoginToken(GetLoginToken $parameters)
  {
    return $this->__soapCall('GetLoginToken', array($parameters));
  }

  /**
   * 
   * @param Logout $parameters
   * @access public
   * @return LogoutResponse
   */
  public function Logout(Logout $parameters)
  {
    return $this->__soapCall('Logout', array($parameters));
  }

  /**
   * 
   * @param CreateGestionnaire $parameters
   * @access public
   * @return CreateGestionnaireResponse
   */
  public function CreateGestionnaire(CreateGestionnaire $parameters)
  {
    return $this->__soapCall('CreateGestionnaire', array($parameters));
  }

  /**
   * 
   * @param CreateOccupants $parameters
   * @access public
   * @return CreateOccupantsResponse
   */
  public function CreateOccupants(CreateOccupants $parameters)
  {
    return $this->__soapCall('CreateOccupants', array($parameters));
  }

  /**
   * 
   * @param CreateDirecteur $parameters
   * @access public
   * @return CreateDirecteurResponse
   */
  public function CreateDirecteur(CreateDirecteur $parameters)
  {
    return $this->__soapCall('CreateDirecteur', array($parameters));
  }

  /**
   * 
   * @param CreateOccupant $parameters
   * @access public
   * @return CreateOccupantResponse
   */
  public function CreateOccupant(CreateOccupant $parameters)
  {
    return $this->__soapCall('CreateOccupant', array($parameters));
  }

  /**
   * 
   * @param GetChildUsers $parameters
   * @access public
   * @return GetChildUsersResponse
   */
  public function GetChildUsers(GetChildUsers $parameters)
  {
    return $this->__soapCall('GetChildUsers', array($parameters));
  }

  /**
   * 
   * @param GetUsers $parameters
   * @access public
   * @return GetUsersResponse
   */
  public function GetUsers(GetUsers $parameters)
  {
    return $this->__soapCall('GetUsers', array($parameters));
  }

  /**
   * 
   * @param DeleteUser $parameters
   * @access public
   * @return DeleteUserResponse
   */
  public function DeleteUser(DeleteUser $parameters)
  {
    return $this->__soapCall('DeleteUser', array($parameters));
  }

  /**
   * 
   * @param GetUser $parameters
   * @access public
   * @return GetUserResponse
   */
  public function GetUser(GetUser $parameters)
  {
    return $this->__soapCall('GetUser', array($parameters));
  }

  /**
   * 
   * @param GetUserByLogin $parameters
   * @access public
   * @return GetUserByLoginResponse
   */
  public function GetUserByLogin(GetUserByLogin $parameters)
  {
    return $this->__soapCall('GetUserByLogin', array($parameters));
  }

  /**
   * 
   * @param UpdatePassword $parameters
   * @access public
   * @return UpdatePasswordResponse
   */
  public function UpdatePassword(UpdatePassword $parameters)
  {
    return $this->__soapCall('UpdatePassword', array($parameters));
  }

  /**
   * 
   * @param UpdateUser $parameters
   * @access public
   * @return UpdateUserResponse
   */
  public function UpdateUser(UpdateUser $parameters)
  {
    return $this->__soapCall('UpdateUser', array($parameters));
  }

  /**
   * 
   * @param UpdateUser2 $parameters
   * @access public
   * @return UpdateUser2Response
   */
  public function UpdateUser2(UpdateUser2 $parameters)
  {
    return $this->__soapCall('UpdateUser2', array($parameters));
  }

  /**
   * 
   * @param UpdateUser3 $parameters
   * @access public
   * @return UpdateUser3Response
   */
  public function UpdateUser3(UpdateUser3 $parameters)
  {
    return $this->__soapCall('UpdateUser3', array($parameters));
  }

  /**
   * 
   * @param ResetPasswordFromEmail2 $parameters
   * @access public
   * @return ResetPasswordFromEmail2Response
   */
  public function ResetPasswordFromEmail2(ResetPasswordFromEmail2 $parameters)
  {
    return $this->__soapCall('ResetPasswordFromEmail2', array($parameters));
  }

  /**
   * 
   * @param ResetPasswordFromEmail $parameters
   * @access public
   * @return ResetPasswordFromEmailResponse
   */
  public function ResetPasswordFromEmail(ResetPasswordFromEmail $parameters)
  {
    return $this->__soapCall('ResetPasswordFromEmail', array($parameters));
  }

  /**
   * 
   * @param ResetPasswordFromPKUser $parameters
   * @access public
   * @return ResetPasswordFromPKUserResponse
   */
  public function ResetPasswordFromPKUser(ResetPasswordFromPKUser $parameters)
  {
    return $this->__soapCall('ResetPasswordFromPKUser', array($parameters));
  }

  /**
   * 
   * @param SendEmailToUser $parameters
   * @access public
   * @return SendEmailToUserResponse
   */
  public function SendEmailToUser(SendEmailToUser $parameters)
  {
    return $this->__soapCall('SendEmailToUser', array($parameters));
  }

  /**
   * 
   * @param UpdateExpirationDateFromPKUser $parameters
   * @access public
   * @return UpdateExpirationDateFromPKUserResponse
   */
  public function UpdateExpirationDateFromPKUser(UpdateExpirationDateFromPKUser $parameters)
  {
    return $this->__soapCall('UpdateExpirationDateFromPKUser', array($parameters));
  }

  /**
   * 
   * @param UpdateCGUFromPKUser $parameters
   * @access public
   * @return UpdateCGUFromPKUserResponse
   */
  public function UpdateCGUFromPKUser(UpdateCGUFromPKUser $parameters)
  {
    return $this->__soapCall('UpdateCGUFromPKUser', array($parameters));
  }

  /**
   * 
   * @param UpdateEmailFromPKUser $parameters
   * @access public
   * @return UpdateEmailFromPKUserResponse
   */
  public function UpdateEmailFromPKUser(UpdateEmailFromPKUser $parameters)
  {
    return $this->__soapCall('UpdateEmailFromPKUser', array($parameters));
  }

  /**
   * 
   * @param GetTchWeekPwd $parameters
   * @access public
   * @return GetTchWeekPwdResponse
   */
  public function GetTchWeekPwd(GetTchWeekPwd $parameters)
  {
    return $this->__soapCall('GetTchWeekPwd', array($parameters));
  }

  /**
   * 
   * @param GetExportParams $parameters
   * @access public
   * @return GetExportParamsResponse
   */
  public function GetExportParams(GetExportParams $parameters)
  {
    return $this->__soapCall('GetExportParams', array($parameters));
  }

  /**
   * 
   * @param GetTableauBordImmeuble $parameters
   * @access public
   * @return GetTableauBordImmeubleResponse
   */
  public function GetTableauBordImmeuble(GetTableauBordImmeuble $parameters)
  {
    return $this->__soapCall('GetTableauBordImmeuble', array($parameters));
  }

  /**
   * 
   * @param GetConsoImmeuble $parameters
   * @access public
   * @return GetConsoImmeubleResponse
   */
  public function GetConsoImmeuble(GetConsoImmeuble $parameters)
  {
    return $this->__soapCall('GetConsoImmeuble', array($parameters));
  }

  /**
   * 
   * @param GetTableauBordClient $parameters
   * @access public
   * @return GetTableauBordClientResponse
   */
  public function GetTableauBordClient(GetTableauBordClient $parameters)
  {
    return $this->__soapCall('GetTableauBordClient', array($parameters));
  }

  /**
   * 
   * @param GetReport $parameters
   * @access public
   * @return GetReportResponse
   */
  public function GetReport(GetReport $parameters)
  {
    return $this->__soapCall('GetReport', array($parameters));
  }

  /**
   * 
   * @param GetExcel $parameters
   * @access public
   * @return GetExcelResponse
   */
  public function GetExcel(GetExcel $parameters)
  {
    return $this->__soapCall('GetExcel', array($parameters));
  }

  /**
   * 
   * @param GetNoteInfo $parameters
   * @access public
   * @return GetNoteInfoResponse
   */
  public function GetNoteInfo(GetNoteInfo $parameters)
  {
    return $this->__soapCall('GetNoteInfo', array($parameters));
  }

  /**
   * 
   * @param GetInfosLogements $parameters
   * @access public
   * @return GetInfosLogementsResponse
   */
  public function GetInfosLogements(GetInfosLogements $parameters)
  {
    return $this->__soapCall('GetInfosLogements', array($parameters));
  }

  /**
   * 
   * @param GetInfosLogementsByImmeuble $parameters
   * @access public
   * @return GetInfosLogementsByImmeubleResponse
   */
  public function GetInfosLogementsByImmeuble(GetInfosLogementsByImmeuble $parameters)
  {
    return $this->__soapCall('GetInfosLogementsByImmeuble', array($parameters));
  }

  /**
   * 
   * @param GetTableauBordLogement $parameters
   * @access public
   * @return GetTableauBordLogementResponse
   */
  public function GetTableauBordLogement(GetTableauBordLogement $parameters)
  {
    return $this->__soapCall('GetTableauBordLogement', array($parameters));
  }

  /**
   * 
   * @param GetInfosFuitesByImmeuble $parameters
   * @access public
   * @return GetInfosFuitesByImmeubleResponse
   */
  public function GetInfosFuitesByImmeuble(GetInfosFuitesByImmeuble $parameters)
  {
    return $this->__soapCall('GetInfosFuitesByImmeuble', array($parameters));
  }

  /**
   * 
   * @param GetInfosAppareilsByLogementEC $parameters
   * @access public
   * @return GetInfosAppareilsByLogementECResponse
   */
  public function GetInfosAppareilsByLogementEC(GetInfosAppareilsByLogementEC $parameters)
  {
    return $this->__soapCall('GetInfosAppareilsByLogementEC', array($parameters));
  }

  /**
   * 
   * @param GetInfosAppareilsByLogementEF $parameters
   * @access public
   * @return GetInfosAppareilsByLogementEFResponse
   */
  public function GetInfosAppareilsByLogementEF(GetInfosAppareilsByLogementEF $parameters)
  {
    return $this->__soapCall('GetInfosAppareilsByLogementEF', array($parameters));
  }

  /**
   * 
   * @param GetInfosAppareilsByLogementRepart $parameters
   * @access public
   * @return GetInfosAppareilsByLogementRepartResponse
   */
  public function GetInfosAppareilsByLogementRepart(GetInfosAppareilsByLogementRepart $parameters)
  {
    return $this->__soapCall('GetInfosAppareilsByLogementRepart', array($parameters));
  }

  /**
   * 
   * @param GetInfosAppareilsByLogementCET $parameters
   * @access public
   * @return GetInfosAppareilsByLogementCETResponse
   */
  public function GetInfosAppareilsByLogementCET(GetInfosAppareilsByLogementCET $parameters)
  {
    return $this->__soapCall('GetInfosAppareilsByLogementCET', array($parameters));
  }

  /**
   * 
   * @param GetInfosAppareilsByLogementElect $parameters
   * @access public
   * @return GetInfosAppareilsByLogementElectResponse
   */
  public function GetInfosAppareilsByLogementElect(GetInfosAppareilsByLogementElect $parameters)
  {
    return $this->__soapCall('GetInfosAppareilsByLogementElect', array($parameters));
  }

  /**
   * 
   * @param GetInfosAppareilsByLogementGaz $parameters
   * @access public
   * @return GetInfosAppareilsByLogementGazResponse
   */
  public function GetInfosAppareilsByLogementGaz(GetInfosAppareilsByLogementGaz $parameters)
  {
    return $this->__soapCall('GetInfosAppareilsByLogementGaz', array($parameters));
  }

  /**
   * 
   * @param GetInfosDysfonctionnementsByImmeuble $parameters
   * @access public
   * @return GetInfosDysfonctionnementsByImmeubleResponse
   */
  public function GetInfosDysfonctionnementsByImmeuble(GetInfosDysfonctionnementsByImmeuble $parameters)
  {
    return $this->__soapCall('GetInfosDysfonctionnementsByImmeuble', array($parameters));
  }

  /**
   * 
   * @param GetInfosAnomaliesByImmeuble $parameters
   * @access public
   * @return GetInfosAnomaliesByImmeubleResponse
   */
  public function GetInfosAnomaliesByImmeuble(GetInfosAnomaliesByImmeuble $parameters)
  {
    return $this->__soapCall('GetInfosAnomaliesByImmeuble', array($parameters));
  }

  /**
   * 
   * @param GetInfosDepannagesByImmeuble $parameters
   * @access public
   * @return GetInfosDepannagesByImmeubleResponse
   */
  public function GetInfosDepannagesByImmeuble(GetInfosDepannagesByImmeuble $parameters)
  {
    return $this->__soapCall('GetInfosDepannagesByImmeuble', array($parameters));
  }

  /**
   * 
   * @param GetDetailsDepannage $parameters
   * @access public
   * @return GetDetailsDepannageResponse
   */
  public function GetDetailsDepannage(GetDetailsDepannage $parameters)
  {
    return $this->__soapCall('GetDetailsDepannage', array($parameters));
  }

  /**
   * 
   * @param GetUsersBigData $parameters
   * @access public
   * @return GetUsersBigDataResponse
   */
  public function GetUsersBigData(GetUsersBigData $parameters)
  {
    return $this->__soapCall('GetUsersBigData', array($parameters));
  }

  /**
   * 
   * @param GetFile $parameters
   * @access public
   * @return GetFileResponse
   */
  public function GetFile(GetFile $parameters)
  {
    return $this->__soapCall('GetFile', array($parameters));
  }

  /**
   * 
   * @param CheckTicketsInterEnabled $parameters
   * @access public
   * @return CheckTicketsInterEnabledResponse
   */
  public function CheckTicketsInterEnabled(CheckTicketsInterEnabled $parameters)
  {
    return $this->__soapCall('CheckTicketsInterEnabled', array($parameters));
  }

  /**
   * 
   * @param GetNbTicketsInterByLogement $parameters
   * @access public
   * @return GetNbTicketsInterByLogementResponse
   */
  public function GetNbTicketsInterByLogement(GetNbTicketsInterByLogement $parameters)
  {
    return $this->__soapCall('GetNbTicketsInterByLogement', array($parameters));
  }

  /**
   * 
   * @param GetTicketInterInit $parameters
   * @access public
   * @return GetTicketInterInitResponse
   */
  public function GetTicketInterInit(GetTicketInterInit $parameters)
  {
    return $this->__soapCall('GetTicketInterInit', array($parameters));
  }

  /**
   * 
   * @param SetTicketStatus $parameters
   * @access public
   * @return SetTicketStatusResponse
   */
  public function SetTicketStatus(SetTicketStatus $parameters)
  {
    return $this->__soapCall('SetTicketStatus', array($parameters));
  }

  /**
   * 
   * @param CreateTicketInter $parameters
   * @access public
   * @return CreateTicketInterResponse
   */
  public function CreateTicketInter(CreateTicketInter $parameters)
  {
    return $this->__soapCall('CreateTicketInter', array($parameters));
  }

  /**
   * 
   * @param GetTicketsIntersUser $parameters
   * @access public
   * @return GetTicketsIntersUserResponse
   */
  public function GetTicketsIntersUser(GetTicketsIntersUser $parameters)
  {
    return $this->__soapCall('GetTicketsIntersUser', array($parameters));
  }

  /**
   * 
   * @param GetNbTicketsIntersUser $parameters
   * @access public
   * @return GetNbTicketsIntersUserResponse
   */
  public function GetNbTicketsIntersUser(GetNbTicketsIntersUser $parameters)
  {
    return $this->__soapCall('GetNbTicketsIntersUser', array($parameters));
  }

  /**
   * 
   * @param SetSeuilConso $parameters
   * @access public
   * @return SetSeuilConsoResponse
   */
  public function SetSeuilConso(SetSeuilConso $parameters)
  {
    return $this->__soapCall('SetSeuilConso', array($parameters));
  }

  /**
   * 
   * @param getCase $parameters
   * @access public
   * @return getCaseResponse
   */
  public function getCase(getCase $parameters)
  {
    return $this->__soapCall('getCase', array($parameters));
  }

  /**
   * 
   * @param getFactures $parameters
   * @access public
   * @return getFacturesResponse
   */
  public function getFactures(getFactures $parameters)
  {
    return $this->__soapCall('getFactures', array($parameters));
  }

  /**
   * 
   * @param getOccupants4Chgt $parameters
   * @access public
   * @return getOccupants4ChgtResponse
   */
  public function getOccupants4Chgt(getOccupants4Chgt $parameters)
  {
    return $this->__soapCall('getOccupants4Chgt', array($parameters));
  }

  /**
   * 
   * @param setOccupants4Chgt $parameters
   * @access public
   * @return setOccupants4ChgtResponse
   */
  public function setOccupants4Chgt(setOccupants4Chgt $parameters)
  {
    return $this->__soapCall('setOccupants4Chgt', array($parameters));
  }

  /**
   * 
   * @param getOccupants4Chgt4LER $parameters
   * @access public
   * @return getOccupants4Chgt4LERResponse
   */
  public function getOccupants4Chgt4LER(getOccupants4Chgt4LER $parameters)
  {
    return $this->__soapCall('getOccupants4Chgt4LER', array($parameters));
  }

  /**
   * 
   * @param setOccupants4Chgt4LER $parameters
   * @access public
   * @return setOccupants4Chgt4LERResponse
   */
  public function setOccupants4Chgt4LER(setOccupants4Chgt4LER $parameters)
  {
    return $this->__soapCall('setOccupants4Chgt4LER', array($parameters));
  }

  /**
   * 
   * @param setReleveOccupant $parameters
   * @access public
   * @return setReleveOccupantResponse
   */
  public function setReleveOccupant(setReleveOccupant $parameters)
  {
    return $this->__soapCall('setReleveOccupant', array($parameters));
  }

  /**
   * 
   * @param GetSousTraitants $parameters
   * @access public
   * @return GetSousTraitantsResponse
   */
  public function GetSousTraitants(GetSousTraitants $parameters)
  {
    return $this->__soapCall('GetSousTraitants', array($parameters));
  }

  /**
   * 
   * @param GetStatOccupants $parameters
   * @access public
   * @return GetStatOccupantsResponse
   */
  public function GetStatOccupants(GetStatOccupants $parameters)
  {
    return $this->__soapCall('GetStatOccupants', array($parameters));
  }

  /**
   * 
   * @param GetStatOccupants2 $parameters
   * @access public
   * @return GetStatOccupants2Response
   */
  public function GetStatOccupants2(GetStatOccupants2 $parameters)
  {
    return $this->__soapCall('GetStatOccupants2', array($parameters));
  }

  /**
   * 
   * @param GetStatOccupantsGraph $parameters
   * @access public
   * @return GetStatOccupantsGraphResponse
   */
  public function GetStatOccupantsGraph(GetStatOccupantsGraph $parameters)
  {
    return $this->__soapCall('GetStatOccupantsGraph', array($parameters));
  }

  /**
   * 
   * @param GetStatClient $parameters
   * @access public
   * @return GetStatClientResponse
   */
  public function GetStatClient(GetStatClient $parameters)
  {
    return $this->__soapCall('GetStatClient', array($parameters));
  }

  /**
   * 
   * @param ResetPassword $parameters
   * @access public
   * @return ResetPasswordResponse
   */
  public function ResetPassword(ResetPassword $parameters)
  {
    return $this->__soapCall('ResetPassword', array($parameters));
  }

  /**
   * 
   * @param GetResetTokenIDValidation $parameters
   * @access public
   * @return GetResetTokenIDValidationResponse
   */
  public function GetResetTokenIDValidation(GetResetTokenIDValidation $parameters)
  {
    return $this->__soapCall('GetResetTokenIDValidation', array($parameters));
  }

  /**
   * 
   * @param UpdateExpirationDateOccupants $parameters
   * @access public
   * @return UpdateExpirationDateOccupantsResponse
   */
  public function UpdateExpirationDateOccupants(UpdateExpirationDateOccupants $parameters)
  {
    return $this->__soapCall('UpdateExpirationDateOccupants', array($parameters));
  }

  /**
   * 
   * @param InsertReportToken $parameters
   * @access public
   * @return InsertReportTokenResponse
   */
  public function InsertReportToken(InsertReportToken $parameters)
  {
    return $this->__soapCall('InsertReportToken', array($parameters));
  }

  /**
   * 
   * @param GetReportByToken $parameters
   * @access public
   * @return GetReportByTokenResponse
   */
  public function GetReportByToken(GetReportByToken $parameters)
  {
    return $this->__soapCall('GetReportByToken', array($parameters));
  }

}
