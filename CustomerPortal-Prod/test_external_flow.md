# Test du flux externe d'accès aux documents d'intervention

## Description du flux implémenté

Le flux externe permet aux utilisateurs d'accéder à leurs documents d'intervention via un lien email sans nécessiter de connexion.

## Routes créées

1. **GET/POST `/interventions/{pkUser}`** - Formulaire de saisie d'email
2. **GET `/interventions/list`** - Liste des documents
3. **GET `/interventions/details/{id}`** - Détails d'un document
4. **GET `/interventions/download/{id}`** - Téléchargement PDF

## Fichiers créés

### Contrôleur

- `src/Controller/ExternalController.php` - Gère toutes les actions du flux

### Service

- `src/Service/ExternalService.php` - Gère les appels SOAP et la simulation des données

### Formulaire

- `src/Form/ExternalFormType.php` - Formulaire de saisie d'email (similaire au login)

### Templates

- `templates/External/interventions_form.html.twig` - Formulaire d'email
- `templates/External/interventions_list.html.twig` - Liste des documents
- `templates/External/interventions_details.html.twig` - Détails d'un document

### Configuration

- `config/routes.yaml` - Routes ajoutées

## Méthodes SOAP ajoutées dans Client.php

1. `getDocumentsByEmail(string $email, int $pkUser)` - Récupère les documents par email
2. `generateDocumentPdf(int $documentId)` - Génère le PDF d'un document

## Flux utilisateur

1. L'utilisateur clique sur un lien email : `/interventions/123`
2. Il saisit son email dans le formulaire
3. Au POST, validation de l'email et appel SOAP
4. Si OK : redirection vers `/interventions/list` avec les documents en session
5. Si erreur : affichage du message d'erreur dans la même vue
6. Dans la liste : clic sur une ligne pour voir les détails
7. Dans les détails : bouton "Télécharger" pour générer le PDF

## Données simulées

Le service simule actuellement des données d'intervention pour le développement :

- 3 documents d'intervention avec différents statuts
- Génération de PDF simple pour les tests

## À implémenter

1. Remplacer les données simulées par les vrais appels SOAP
2. Adapter les attributs des réponses SOAP selon la structure réelle
3. Tester avec de vrais emails et pkUser

## Test rapide

Pour tester le flux :

1. Accéder à `/interventions/123`
2. Saisir un email valide
3. Vérifier la redirection vers la liste
4. Cliquer sur un document pour voir les détails
5. Tester le téléchargement PDF
