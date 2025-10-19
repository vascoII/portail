# Système de Logging et de Gestion des Exceptions

Ce document explique le système complet de logging et de gestion des exceptions implémenté dans l'application.

## Vue d'ensemble

Le système fournit :

- **Logging structuré** à travers toutes les couches (Domain, Infrastructure, Application, HTTP)
- **Gestion centralisée des exceptions** avec mapping automatique vers les réponses HTTP
- **Suivi des requêtes** avec des IDs uniques pour la corrélation
- **Monitoring des performances** avec suivi du temps de réponse
- **Fonctionnalités de sécurité** incluant la limitation de débit et les en-têtes de sécurité
- **Sanitisation des données** pour empêcher la fuite d'informations sensibles

## Architecture

### Hiérarchie des Exceptions

```
Exception (base PHP)
├── DomainException (abstraite)
│   ├── BusinessRuleException
│   └── ValidationException
├── InfrastructureException (abstraite)
│   ├── SoapException (abstraite)
│   │   ├── SoapTransportException
│   │   └── SoapBusinessException
│   ├── RedisException
│   └── JwtException
├── ApplicationException (abstraite)
│   ├── UseCaseException
│   └── ServiceException
└── HttpException (abstraite)
    ├── AuthenticationException (401)
    ├── AuthorizationException (403)
    ├── BadRequestException (400)
    └── InternalServerErrorException (500)
```

### Canaux de Logging

Le système utilise plusieurs canaux Monolog pour différents usages :

- **`http`** - Logging des requêtes/réponses HTTP
- **`application`** - Logging des UseCase et de la logique métier
- **`soap`** - Appels aux services SOAP externes
- **`transformer`** - Logging des transformations de données
- **`security`** - Événements d'authentification et d'autorisation

## Composants

### Écouteurs d'Événements HTTP

#### 1. GlobalExceptionListener

- **Objectif** : Gestion centralisée des exceptions
- **Fonctionnalités** :
  - Capture toutes les exceptions de n'importe quelle couche
  - Les mappe vers les exceptions HTTP appropriées
  - Génère des réponses API standardisées
  - Log les exceptions aux niveaux appropriés
  - Gère le comportement spécifique à l'environnement

#### 2. RequestIdListener

- **Objectif** : Suivi et corrélation des requêtes
- **Fonctionnalités** :
  - Génère des IDs de requête uniques pour chaque requête API
  - Ajoute l'ID de requête aux en-têtes de réponse
  - Permet le traçage des requêtes à travers l'application

#### 3. CorsListener

- **Objectif** : Gestion CORS
- **Fonctionnalités** :
  - Gère les requêtes OPTIONS de prévol
  - Ajoute les en-têtes CORS à toutes les réponses
  - Origines, méthodes et en-têtes autorisés configurables

#### 4. SecurityHeadersListener

- **Objectif** : En-têtes de sécurité
- **Fonctionnalités** :
  - Ajoute des en-têtes de sécurité complets
  - Politiques de sécurité configurables
  - En-têtes spécifiques HTTPS

#### 5. RateLimitListener

- **Objectif** : Limitation de débit
- **Fonctionnalités** :
  - Implémente une limitation de débit basique pour les endpoints API
  - Limites configurables par endpoint
  - Limitation basée sur l'utilisateur et l'IP

#### 6. RequestValidationListener

- **Objectif** : Validation des requêtes
- **Fonctionnalités** :
  - Valide les limites de taille des requêtes
  - Valide les types de contenu
  - Valide le format JSON

#### 7. ResponseTimeListener

- **Objectif** : Monitoring des performances
- **Fonctionnalités** :
  - Mesure le temps de traitement des requêtes
  - Log les requêtes lentes
  - Ajoute les en-têtes de temps de réponse

### Processeurs de Logger

#### 1. RequestIdProcessor

- **Objectif** : Ajoute l'ID de requête à tous les enregistrements de log
- **Fonctionnalités** :
  - Fonctionne avec RequestIdListener
  - Ajoute l'ID de requête au contexte de log pour la corrélation

#### 2. UserContextProcessor

- **Objectif** : Ajoute le contexte utilisateur aux enregistrements de log
- **Fonctionnalités** :
  - Ajoute les informations de l'utilisateur authentifié
  - Inclut l'ID utilisateur, nom d'utilisateur et ID client

#### 3. SensitiveDataProcessor

- **Objectif** : Nettoie les données sensibles des logs
- **Fonctionnalités** :
  - Masque les mots de passe, tokens et autres données sensibles
  - Empêche la fuite d'informations sensibles dans les logs

#### 4. ExceptionContextProcessor

- **Objectif** : Ajoute le contexte d'exception structuré
- **Fonctionnalités** :
  - Enrichit les enregistrements de log avec les métadonnées d'exception
  - Ajoute les codes d'erreur, composants et opérations
  - Fournit des informations de retry pour les exceptions d'infrastructure

### Abonné de Logging HTTP

#### HttpLoggingSubscriber

- **Objectif** : Logging détaillé des requêtes/réponses HTTP
- **Fonctionnalités** :
  - Log les détails des requêtes avec les payloads
  - Log les détails des réponses pour les erreurs
  - S'intègre avec les autres écouteurs
  - Fournit un logging HTTP complet

## Configuration

### Configuration des Services

Tous les composants sont configurés dans `config/services.yaml` :

```yaml
# Écouteurs d'Événements HTTP
App\Http\EventListener\GlobalExceptionListener:
  tags: ["kernel.event_subscriber"]
  arguments:
    $logger: "@monolog.logger.application"

App\Http\EventListener\RequestIdListener:
  tags: ["kernel.event_subscriber"]

App\Http\EventListener\CorsListener:
  tags: ["kernel.event_subscriber"]
  arguments:
    $allowedOrigins: ["*"]
    $allowedMethods: ["GET", "POST", "PUT", "DELETE", "OPTIONS"]
    $allowedHeaders: ["Content-Type", "Authorization", "X-Request-ID"]

# Processeurs de Logger
App\Infrastructure\Logger\Processor\RequestIdProcessor:
  tags: ["monolog.processor"]

App\Infrastructure\Logger\Processor\UserContextProcessor:
  tags: ["monolog.processor"]

App\Infrastructure\Logger\Processor\SensitiveDataProcessor:
  tags: ["monolog.processor"]

App\Infrastructure\Logger\Processor\ExceptionContextProcessor:
  tags: ["monolog.processor"]
```

### Configuration Monolog

Le système utilise le logging structuré avec le format JSON :

```yaml
monolog:
  channels: ["http", "application", "soap", "transformer", "security"]

  handlers:
    http:
      type: stream
      path: "%kernel.logs_dir%/http.log"
      level: info
      channels: ["http"]
      formatter: monolog.formatter.json

    application:
      type: stream
      path: "%kernel.logs_dir%/application.log"
      level: debug
      channels: ["application"]
      formatter: monolog.formatter.json
```

## Exemples d'Utilisation

### Gestion des Exceptions

```php
// Dans UseCase
try {
    $result = $this->soapService->call($method, $request);
} catch (SoapTransportException $e) {
    // Automatiquement mappé vers InternalServerErrorException (500)
    throw $e;
}

// Dans Action
if (!$request->request->has('email')) {
    throw BadRequestException::missingField('email');
}
```

### Logging

```php
// Dans UseCase
$this->logger->info('Tentative de connexion utilisateur', [
    'username' => $username,
    'client_ip' => $request->getClientIp(),
]);

// Dans Service SOAP
$this->soapLogger->warning('Appel SOAP échoué', [
    'service' => 'SecuritySoap',
    'operation' => 'login',
    'error' => $exception->getMessage(),
]);
```

### Réponses API

Toutes les exceptions sont automatiquement converties en réponses API standardisées :

```json
{
  "success": false,
  "error": {
    "code": "AUTHENTICATION_FAILED",
    "message": "Le token d'authentification a expiré",
    "status_code": 401
  },
  "request_id": "20241201-abc12345-def67890"
}
```

## Structure des Logs

### Log de Requête

```json
{
  "message": "Requête HTTP reçue",
  "context": {
    "method": "POST",
    "uri": "https://api.example.com/security/login",
    "route": "security_login",
    "client_ip": "192.168.1.100",
    "user_agent": "Mozilla/5.0...",
    "content_type": "application/json",
    "request_body_size": 45
  },
  "extra": {
    "request_id": "20241201-abc12345-def67890",
    "user_id": 1043,
    "user_name": "Demo",
    "client_id": "C00892"
  }
}
```

### Log d'Exception

```json
{
  "message": "Timeout de connexion SOAP après 30 secondes",
  "context": {
    "exception_class": "App\\Infrastructure\\Exception\\SoapTransportException",
    "http_status_code": 500,
    "error_code": "SOAP_CONNECTION_TIMEOUT",
    "service": "SecuritySoap",
    "operation": "login",
    "is_retryable": true,
    "retry_delay": 15
  },
  "extra": {
    "request_id": "20241201-abc12345-def67890",
    "exception_type": "infrastructure_exception",
    "retry_info": {
      "is_retryable": true,
      "retry_delay": 15,
      "max_retries": 1
    }
  }
}
```

## Fonctionnalités de Sécurité

### Limitation de Débit

- Limites configurables par endpoint
- Limitation basée sur l'utilisateur et l'IP
- En-têtes de limitation de débit dans les réponses

### En-têtes de Sécurité

- Content Security Policy
- HTTP Strict Transport Security
- X-Frame-Options
- X-Content-Type-Options
- Referrer Policy

### Sanitisation des Données

- Masquage automatique des données sensibles
- Patterns de clés sensibles configurables
- Sanitisation des corps de requête/réponse

## Monitoring des Performances

### Suivi du Temps de Réponse

- Mesure automatique du temps de réponse
- Détection et logging des requêtes lentes
- En-têtes de temps de réponse

### Monitoring de la Mémoire

- Suivi de l'utilisation mémoire
- Monitoring de la mémoire de pointe
- Détection des fuites mémoire

## Bonnes Pratiques

### Gestion des Exceptions

1. **Utilisez les types d'exception appropriés** pour chaque couche
2. **Fournissez des messages d'erreur significatifs** et du contexte
3. **Utilisez les méthodes factory** pour les exceptions communes
4. **Laissez l'écouteur global gérer** la génération des réponses HTTP

### Logging

1. **Utilisez le logging structuré** avec un contexte cohérent
2. **Incluez les IDs de requête** pour la corrélation
3. **Log aux niveaux appropriés** (debug, info, warning, error)
4. **Évitez de logger les données sensibles** (utilisez les processeurs)

### Performance

1. **Surveillez les requêtes lentes** et optimisez en conséquence
2. **Utilisez les niveaux de log appropriés** pour éviter l'impact sur les performances
3. **Configurez la rotation des logs** pour la production
4. **Surveillez l'utilisation mémoire** et la croissance des logs

## Dépannage

### Problèmes Courants

1. **IDs de requête manquants** : Assurez-vous que RequestIdListener est correctement configuré
2. **Logging dupliqué** : Vérifiez les priorités des écouteurs d'événements
3. **Données sensibles dans les logs** : Vérifiez la configuration de SensitiveDataProcessor
4. **Problèmes de performance** : Vérifiez les niveaux de log et les seuils de requêtes lentes

### Débogage

1. **Vérifiez les fichiers de log** dans le répertoire `var/log/`
2. **Utilisez les IDs de requête** pour tracer les requêtes à travers les services
3. **Surveillez les logs d'exception** pour les patterns d'erreur
4. **Vérifiez les logs de limitation de débit** pour les patterns d'abus

## Améliorations Futures

1. **Traçage distribué** avec OpenTelemetry
2. **Collecte de métriques** avec Prometheus
3. **Système d'alerte** pour les erreurs critiques
4. **Agrégation de logs** avec la stack ELK
5. **Profilage des performances** avec Blackfire
