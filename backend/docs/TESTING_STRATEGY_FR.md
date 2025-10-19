# 🧪 Stratégie de Tests pour Backend Clean Architecture

## Vue d'ensemble

Ce document décrit la stratégie de tests complète pour notre backend clean architecture. La stratégie suit l'approche de la pyramide de tests avec un focus sur des tests maintenables, fiables et rapides.

## 🏗️ Structure de la Pyramide de Tests

```
    🔺 Tests E2E (Peu)
   🔺🔺 Tests d'Intégration (Quelques)
  🔺🔺🔺 Tests Unitaires (Beaucoup)
```

## 1. Tests Unitaires (Priorité #1)

### Quoi Tester

- **Use Cases** - Validation de la logique métier
- **DTOs** - Validation et transformation des données
- **Transformers** - Logique de mapping des données
- **Hydrators** - Sérialisation requête/réponse
- **Validators** - Règles de validation des entrées

### Structure des Répertoires

```
tests/Unit/
├── Application/
│   ├── UseCase/
│   │   ├── Security/
│   │   │   ├── LoginUseCaseTest.php
│   │   │   ├── LoginFromParamUseCaseTest.php
│   │   │   ├── ResetPasswordUseCaseTest.php
│   │   │   └── UpdatePasswordUseCaseTest.php
│   │   ├── Operator/
│   │   │   ├── GetOperatorStatUseCaseTest.php
│   │   │   ├── CreateOperationImmeubleUseCaseTest.php
│   │   │   └── PatchOperatorImmeubleUseCaseTest.php
│   │   ├── Parc/
│   │   │   ├── GetParcUseCaseTest.php
│   │   │   ├── ListParcInterventionsUseCaseTest.php
│   │   │   └── GetParcIndicatorsUseCaseTest.php
│   │   └── Occupant/
│   │       ├── GetOccupantReleveEauUseCaseTest.php
│   │       ├── GetOccupantReleveNoteUseCaseTest.php
│   │       └── GetOccupantInterventionUseCaseTest.php
│   ├── Dto/
│   │   ├── Input/
│   │   │   ├── Security/LoginInputDtoTest.php
│   │   │   └── Shared/GetByIdIntInputDtoTest.php
│   │   └── Output/
│   │       ├── Security/LoginOutputDtoTest.php
│   │       └── Shared/SuccessOutputDtoTest.php
│   └── Service/
│       └── Transformer/
│           ├── SecurityTransformerTest.php
│           ├── OperatorTransformerTest.php
│           └── ParcTransformerTest.php
└── Infrastructure/
    ├── Service/
    │   ├── Hydrator/
    │   │   ├── SecurityHydratorTest.php
    │   │   └── OperatorHydratorTest.php
    │   └── Transformer/
    │       ├── SecurityTransformerTest.php
    │       └── OperatorTransformerTest.php
    └── Factory/
        └── Operator/
            └── OperatorInputFactoryTest.php
```

### Principes Clés

- Mocker toutes les dépendances
- Tester une classe à la fois
- Se concentrer sur la logique métier
- Viser 80-90% de couverture

### Exemple de Test Unitaire

```php
<?php

namespace Tests\Unit\Application\UseCase\Security;

use App\Application\UseCase\Security\LoginUseCase;
use App\Application\Service\DataProvider\SecurityDataProviderInterface;
use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use PHPUnit\Framework\TestCase;
use Mockery;

class LoginUseCaseTest extends TestCase
{
    private SecurityDataProviderInterface $dataProvider;
    private LoginUseCase $useCase;

    protected function setUp(): void
    {
        $this->dataProvider = Mockery::mock(SecurityDataProviderInterface::class);
        $this->useCase = new LoginUseCase($this->dataProvider);
    }

    public function testExecuteReturnsLoginOutputDto(): void
    {
        // Arrange
        $inputDto = new LoginInputDto('test@example.com', 'password');
        $expectedOutput = new LoginOutputDto(/* ... */);

        $this->dataProvider
            ->shouldReceive('loginService')
            ->with($inputDto)
            ->once()
            ->andReturn($expectedOutput);

        // Act
        $result = $this->useCase->execute($inputDto);

        // Assert
        $this->assertInstanceOf(LoginOutputDto::class, $result);
        $this->assertEquals($expectedOutput, $result);
    }
}
```

## 2. Tests d'Intégration (Priorité #2)

### Quoi Tester

- Implémentations **DataProvider**
- Intégrations **DataSource** SOAP
- Interactions **Base de données** (si applicable)
- Opérations **Cache**
- Flux **Authentification**

### Structure des Répertoires

```
tests/Integration/
├── Service/
│   ├── DataProvider/
│   │   ├── SecurityDataProviderTest.php
│   │   ├── OperatorDataProviderTest.php
│   │   └── ParcDataProviderTest.php
│   └── DataSource/
│       ├── SecuritySoapTest.php
│       ├── OperatorSoapTest.php
│       └── ParcSoapTest.php
└── Http/
    └── Action/
        ├── Security/
        │   ├── LoginActionTest.php
        │   └── ResetPasswordActionTest.php
        ├── Operator/
        │   ├── GetOperatorStatActionTest.php
        │   └── CreateOperationImmeubleActionTest.php
        └── Parc/
            ├── GetParcActionTest.php
            └── ListParcInterventionsActionTest.php
```

### Principes Clés

- Utiliser les implémentations réelles avec les dépendances externes mockées
- Tester le flux de données entre les couches
- Utiliser des bases de données/APIs de test quand possible

### Exemple de Test d'Intégration

```php
<?php

namespace Tests\Integration\Service\DataProvider;

use App\Infrastructure\Service\DataProvider\SecurityDataProvider;
use App\Application\Service\DataSource\SecurityDataSourceInterface;
use App\Application\Service\Transformer\SecurityTransformerInterface;
use App\Application\Dto\Input\Security\LoginInputDto;
use PHPUnit\Framework\TestCase;
use Mockery;

class SecurityDataProviderTest extends TestCase
{
    private SecurityDataSourceInterface $dataSource;
    private SecurityTransformerInterface $transformer;
    private SecurityDataProvider $dataProvider;

    protected function setUp(): void
    {
        $this->dataSource = Mockery::mock(SecurityDataSourceInterface::class);
        $this->transformer = Mockery::mock(SecurityTransformerInterface::class);
        $this->dataProvider = new SecurityDataProvider($this->dataSource, $this->transformer);
    }

    public function testLoginServiceIntegratesCorrectly(): void
    {
        // Arrange
        $inputDto = new LoginInputDto('test@example.com', 'password');
        $rawData = (object) ['User' => [], 'SessionID' => '123'];
        $expectedOutput = new LoginOutputDto(/* ... */);

        $this->dataSource
            ->shouldReceive('fetchLogin')
            ->with($inputDto)
            ->once()
            ->andReturn($rawData);

        $this->transformer
            ->shouldReceive('transformLogin')
            ->with($rawData)
            ->once()
            ->andReturn($expectedOutput);

        // Act
        $result = $this->dataProvider->loginService($inputDto);

        // Assert
        $this->assertEquals($expectedOutput, $result);
    }
}
```

## 3. Tests End-to-End (Priorité #3)

### Quoi Tester

- **Workflows API complets**
- **Flux d'authentification**
- **Scénarios métier critiques**

### Structure des Répertoires

```
tests/E2E/
├── Security/
│   ├── LoginFlowTest.php
│   ├── PasswordResetFlowTest.php
│   └── UpdatePasswordFlowTest.php
├── Operator/
│   ├── OperatorManagementFlowTest.php
│   ├── OperatorImmeubleOperationsTest.php
│   └── OperatorStatsFlowTest.php
├── Parc/
│   ├── ParcDataRetrievalTest.php
│   └── ParcIndicatorsFlowTest.php
└── Occupant/
    ├── OccupantReleveFlowTest.php
    └── OccupantInterventionFlowTest.php
```

### Exemple de Test E2E

```php
<?php

namespace Tests\E2E\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LoginFlowTest extends WebTestCase
{
    public function testCompleteLoginFlow(): void
    {
        $client = static::createClient();

        // Tester l'endpoint de connexion
        $client->request('POST', '/security/login', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'email' => 'test@example.com',
            'password' => 'password123'
        ]));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('token', $responseData);
        $this->assertArrayHasKey('user', $responseData);
    }
}
```

## 4. Outils & Framework de Tests

### Stack Recommandé

```bash
# PHPUnit pour les tests unitaires/intégration
composer require --dev phpunit/phpunit

# Pest pour des tests plus lisibles (optionnel)
composer require --dev pestphp/pest

# Mockery pour le mocking
composer require --dev mockery/mockery

# Tests HTTP
composer require --dev symfony/http-client

# Tests de base de données (si nécessaire)
composer require --dev doctrine/doctrine-fixtures-bundle
```

### Configuration PHPUnit

```xml
<!-- phpunit.xml -->
<phpunit>
    <testsuites>
        <testsuite name="Unit">
            <directory>tests/Unit</directory>
        </testsuite>
        <testsuite name="Integration">
            <directory>tests/Integration</directory>
        </testsuite>
        <testsuite name="E2E">
            <directory>tests/E2E</directory>
        </testsuite>
    </testsuites>
    <coverage>
        <include>
            <directory suffix=".php">src/Application</directory>
            <directory suffix=".php">src/Infrastructure</directory>
        </include>
        <exclude>
            <directory>src/Http</directory>
        </exclude>
    </coverage>
</phpunit>
```

## 5. Gestion des Données de Test

### Factories

```php
// tests/Factories/UserFactory.php
class UserFactory
{
    public static function create(array $attributes = []): User
    {
        return new User(
            email: $attributes['email'] ?? 'test@example.com',
            firstName: $attributes['firstName'] ?? 'John',
            lastName: $attributes['lastName'] ?? 'Doe',
            // ... autres attributs
        );
    }

    public static function createMany(int $count, array $attributes = []): array
    {
        return collect(range(1, $count))
            ->map(fn() => self::create($attributes))
            ->toArray();
    }
}
```

### Fixtures

```json
// tests/Fixtures/security_data.json
{
  "validLogin": {
    "email": "test@example.com",
    "password": "password123"
  },
  "invalidLogin": {
    "email": "invalid@example.com",
    "password": "wrongpassword"
  }
}
```

## 6. Stratégie de Mocking

### Dépendances Externes

```php
// Mocker les clients SOAP
$mockSoapClient = $this->createMock(SoapClient::class);

// Mocker Redis
$mockRedis = $this->createMock(RedisService::class);

// Mocker le service JWT
$mockJwt = $this->createMock(JwtService::class);

// Mocker le service d'authentification
$mockAuth = $this->createMock(AuthServiceInterface::class);
```

### Test du Conteneur de Services

```php
// tests/Integration/ServiceContainerTest.php
class ServiceContainerTest extends WebTestCase
{
    public function testServicesAreRegistered(): void
    {
        $container = static::getContainer();

        $this->assertTrue($container->has(SecurityDataProviderInterface::class));
        $this->assertTrue($container->has(OperatorDataProviderInterface::class));
        $this->assertTrue($container->has(ParcDataProviderInterface::class));
    }
}
```

## 7. Intégration CI/CD

### GitHub Actions

```yaml
# .github/workflows/tests.yml
name: Tests
on: [push, pull_request]

jobs:
  test:
    runs-on: ubuntu-latest

    steps:
      - uses: actions/checkout@v3

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: "8.2"
          extensions: mbstring, xml, ctype, iconv, intl, pdo_sqlite

      - name: Install dependencies
        run: composer install --prefer-dist --no-progress

      - name: Run unit tests
        run: ./vendor/bin/phpunit --testsuite=Unit --coverage-clover=coverage-unit.xml

      - name: Run integration tests
        run: ./vendor/bin/phpunit --testsuite=Integration --coverage-clover=coverage-integration.xml

      - name: Run E2E tests
        run: ./vendor/bin/phpunit --testsuite=E2E

      - name: Generate coverage report
        run: |
          ./vendor/bin/phpunit --coverage-html coverage-report

      - name: Upload coverage to Codecov
        uses: codecov/codecov-action@v3
        with:
          files: coverage-unit.xml,coverage-integration.xml
```

## 8. Bonnes Pratiques de Tests

### ✅ À Faire

- Tester le comportement, pas l'implémentation
- Utiliser des noms de tests descriptifs
- Suivre le pattern AAA (Arrange, Act, Assert)
- Garder les tests indépendants
- Utiliser des data providers pour plusieurs scénarios
- Mocker les dépendances externes
- Tester les cas limites et conditions d'erreur
- Utiliser des factories pour la création de données de test
- Tester une chose à la fois
- Écrire des tests avant de corriger les bugs (TDD)

### ❌ À Ne Pas Faire

- Tester les méthodes privées directement
- Tester le code du framework
- Écrire des tests qui dépendent les uns des autres
- Mocker tout (tester les vraies intégrations)
- Ignorer les scénarios d'erreur
- Écrire des tests trop complexes
- Tester les détails d'implémentation
- Ignorer les assertions dans les tests

## 9. Recommandations Spécifiques pour Notre Architecture

### Tests de Haute Priorité

1. **Use Cases de Sécurité** - L'authentification est critique
2. **Gestion des Opérateurs** - Validation de la logique métier
3. **Transformation des Données** - Assurer l'intégrité des données
4. **Intégration SOAP** - Fiabilité des APIs externes

### Objectifs de Couverture de Tests

- **Tests Unitaires** : 80-90% de couverture
- **Tests d'Intégration** : 60-70% de couverture
- **Tests E2E** : 20-30% de couverture

### Ordre d'Implémentation

1. **Commencer par les Tests Unitaires** pour les Use Cases
2. **Ajouter les Tests d'Intégration** pour les DataProviders
3. **Créer les Tests E2E** pour les flux utilisateur critiques
4. **Étendre la couverture** basée sur les priorités métier

## 10. Exécution des Tests

### Commandes

```bash
# Exécuter tous les tests
./vendor/bin/phpunit

# Exécuter une suite de tests spécifique
./vendor/bin/phpunit --testsuite=Unit
./vendor/bin/phpunit --testsuite=Integration
./vendor/bin/phpunit --testsuite=E2E

# Exécuter avec couverture
./vendor/bin/phpunit --coverage-html coverage-report

# Exécuter un test spécifique
./vendor/bin/phpunit tests/Unit/Application/UseCase/Security/LoginUseCaseTest.php

# Exécuter les tests en mode watch (si utilisation de Pest)
./vendor/bin/pest --watch
```

### Configuration de la Base de Données de Test

```bash
# Créer la base de données de test
php bin/console doctrine:database:create --env=test

# Exécuter les migrations
php bin/console doctrine:migrations:migrate --env=test

# Charger les fixtures
php bin/console doctrine:fixtures:load --env=test
```

## 11. Considérations de Performance

### Performance des Tests

- Les tests unitaires doivent s'exécuter en < 1ms chacun
- Les tests d'intégration doivent s'exécuter en < 100ms chacun
- Les tests E2E doivent s'exécuter en < 1s chacun
- La suite de tests complète doit se terminer en < 5 minutes

### Conseils d'Optimisation

- Utiliser des bases de données en mémoire pour les tests
- Mocker les appels d'API externes
- Exécuter les tests en parallèle quand possible
- Utiliser des constructeurs de données de test au lieu de fixtures pour des objets complexes

## 12. Maintenance

### Tâches Régulières

- Examiner et mettre à jour la couverture de tests mensuellement
- Refactoriser les tests quand la logique métier change
- Supprimer les tests obsolètes
- Mettre à jour les données de test et fixtures
- Surveiller la performance des tests

### Checklist de Code Review

- [ ] Les nouvelles fonctionnalités ont des tests correspondants
- [ ] Les tests suivent les conventions de nommage
- [ ] Les tests sont indépendants et isolés
- [ ] Les cas limites sont couverts
- [ ] Les scénarios d'erreur sont testés
- [ ] Les données de test sont réalistes et maintenables

---

## Démarrage Rapide

1. **Installer les dépendances :**

   ```bash
   composer require --dev phpunit/phpunit mockery/mockery
   ```

2. **Créer votre premier test :**

   ```bash
   mkdir -p tests/Unit/Application/UseCase/Security
   ```

3. **Exécuter les tests :**

   ```bash
   ./vendor/bin/phpunit
   ```

4. **Vérifier la couverture :**
   ```bash
   ./vendor/bin/phpunit --coverage-html coverage-report
   ```

Cette stratégie de tests assurera que votre backend clean architecture est robuste, maintenable et fiable ! 🚀
