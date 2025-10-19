<?php

declare(strict_types=1);

/**
 * Script to generate unit tests for all UseCase classes
 * This script automatically creates test files for UseCase classes following the established patterns
 */

require_once __DIR__ . '/../vendor/autoload.php';

class UseCaseTestGenerator
{
  private string $srcPath;
  private string $testPath;
  private array $useCaseDirectories = [
    'Operator',
    'Occupant',
    'Ticket',
    'Logement',
    'Immeuble',
    'Security',
    'Document',
    'Facture',
    'GestionParc',
    'Ticketing',
    'ReportToken',
    'TableauBordClient',
    'Search'
  ];

  public function __construct()
  {
    $this->srcPath = __DIR__ . '/../src/Application/UseCase';
    $this->testPath = __DIR__ . '/../tests/Unit/Application/UseCase';
  }

  public function generateAllTests(): void
  {
    echo "🚀 Starting UseCase test generation...\n\n";

    foreach ($this->useCaseDirectories as $directory) {
      $this->generateTestsForDirectory($directory);
    }

    echo "\n✅ All UseCase tests generated successfully!\n";
  }

  private function generateTestsForDirectory(string $directory): void
  {
    $srcDir = $this->srcPath . '/' . $directory;
    $testDir = $this->testPath . '/' . $directory;

    if (!is_dir($srcDir)) {
      echo "⚠️  Directory $srcDir does not exist, skipping...\n";
      return;
    }

    // Create test directory if it doesn't exist
    if (!is_dir($testDir)) {
      mkdir($testDir, 0755, true);
    }

    $files = glob($srcDir . '/*.php');

    foreach ($files as $file) {
      $className = basename($file, '.php');
      $this->generateTestForUseCase($directory, $className, $file);
    }
  }

  private function generateTestForUseCase(string $directory, string $className, string $filePath): void
  {
    $testClassName = $className . 'Test';
    $testFilePath = $this->testPath . '/' . $directory . '/' . $testClassName . '.php';

    // Skip if test already exists
    if (file_exists($testFilePath)) {
      echo "⏭️  Test for $className already exists, skipping...\n";
      return;
    }

    $useCaseContent = file_get_contents($filePath);
    $testContent = $this->generateTestContent($directory, $className, $useCaseContent);

    file_put_contents($testFilePath, $testContent);
    echo "✅ Generated test for $className\n";
  }

  private function generateTestContent(string $directory, string $className, string $useCaseContent): string
  {
    // Extract namespace and class information
    $namespace = "App\\Tests\\Unit\\Application\\UseCase\\$directory";
    $useCaseNamespace = "App\\Application\\UseCase\\$directory";

    // Extract constructor parameters and method signature
    preg_match('/public function __construct\(\s*(.*?)\s*\)/', $useCaseContent, $constructorMatches);
    preg_match('/public function execute\((.*?)\)/', $useCaseContent, $executeMatches);

    $constructorParams = $constructorMatches[1] ?? '';
    $executeParams = $executeMatches[1] ?? '';

    // Extract data provider interface
    preg_match('/private readonly (\w+DataProviderInterface)/', $constructorParams, $dataProviderMatches);
    $dataProviderInterface = $dataProviderMatches[1] ?? 'DataProviderInterface';

    // Extract input and output DTOs
    preg_match('/use App\\Application\\Dto\\Input\\([^;]+);/', $useCaseContent, $inputDtoMatches);
    preg_match('/use App\\Application\\Dto\\Output\\([^;]+);/', $useCaseContent, $outputDtoMatches);

    $inputDtoClass = $this->extractClassName($inputDtoMatches[0] ?? '');
    $outputDtoClass = $this->extractClassName($outputDtoMatches[0] ?? '');

    // Generate test content
    $testContent = "<?php\n\n";
    $testContent .= "declare(strict_types=1);\n\n";
    $testContent .= "namespace $namespace;\n\n";
    $testContent .= "use $useCaseNamespace\\$className;\n";

    if ($inputDtoClass) {
      $testContent .= "use App\\Application\\Dto\\Input\\$inputDtoClass;\n";
    }
    if ($outputDtoClass) {
      $testContent .= "use App\\Application\\Dto\\Output\\$outputDtoClass;\n";
    }

    $testContent .= "use App\\Application\\Service\\DataProvider\\$dataProviderInterface;\n";
    $testContent .= "use App\\Tests\\Unit\\Application\\UseCase\\BaseUseCaseTest;\n";
    $testContent .= "use Mockery;\n\n";

    $testContent .= "class $testClassName extends BaseUseCaseTest\n";
    $testContent .= "{\n";
    $testContent .= "    private $dataProviderInterface \$dataProvider;\n";
    $testContent .= "    private $className \$useCase;\n\n";

    $testContent .= "    protected function setUp(): void\n";
    $testContent .= "    {\n";
    $testContent .= "        parent::setUp();\n";
    $testContent .= "        \$this->dataProvider = \$this->createDataProviderMock($dataProviderInterface::class);\n";
    $testContent .= "        \$this->useCase = new $className(\$this->dataProvider);\n";
    $testContent .= "    }\n\n";

    // Generate test methods
    $testContent .= $this->generateTestMethods($className, $inputDtoClass, $outputDtoClass, $dataProviderInterface);

    $testContent .= "}\n";

    return $testContent;
  }

  private function generateTestMethods(string $className, string $inputDtoClass, string $outputDtoClass, string $dataProviderInterface): string
  {
    $methods = [];

    // Test 1: Basic execution
    $methods[] = $this->generateBasicExecutionTest($className, $inputDtoClass, $outputDtoClass, $dataProviderInterface);

    // Test 2: Data provider call verification
    $methods[] = $this->generateDataProviderCallTest($className, $inputDtoClass, $outputDtoClass, $dataProviderInterface);

    // Test 3: Different input scenarios
    $methods[] = $this->generateDifferentInputTest($className, $inputDtoClass, $outputDtoClass, $dataProviderInterface);

    return implode("\n", $methods);
  }

  private function generateBasicExecutionTest(string $className, string $inputDtoClass, string $outputDtoClass, string $dataProviderInterface): string
  {
    $methodName = $this->getMethodNameFromClassName($className);
    $inputParam = $inputDtoClass ? 'new ' . $this->getShortClassName($inputDtoClass) . '(/* test data */)' : '';

    $test = "    public function testExecuteReturnsCorrectOutput(): void\n";
    $test .= "    {\n";
    $test .= "        // Arrange\n";

    if ($inputDtoClass) {
      $test .= "        \$inputDto = $inputParam;\n";
    }

    $test .= "        \$expectedOutput = Mockery::mock($outputDtoClass::class);\n\n";

    $test .= "        \$this->dataProvider\n";
    $test .= "            ->shouldReceive('$methodName')\n";

    if ($inputDtoClass) {
      $test .= "            ->with(\$inputDto)\n";
    } else {
      $test .= "            ->withNoArgs()\n";
    }

    $test .= "            ->once()\n";
    $test .= "            ->andReturn(\$expectedOutput);\n\n";

    $test .= "        // Act\n";

    if ($inputDtoClass) {
      $test .= "        \$result = \$this->useCase->execute(\$inputDto);\n";
    } else {
      $test .= "        \$result = \$this->useCase->execute();\n";
    }

    $test .= "\n        // Assert\n";
    $test .= "        \$this->assertInstanceOf($outputDtoClass::class, \$result);\n";
    $test .= "        \$this->assertEquals(\$expectedOutput, \$result);\n";
    $test .= "    }\n";

    return $test;
  }

  private function generateDataProviderCallTest(string $className, string $inputDtoClass, string $outputDtoClass, string $dataProviderInterface): string
  {
    $methodName = $this->getMethodNameFromClassName($className);

    $test = "    public function testExecuteCallsDataProviderWithCorrectInput(): void\n";
    $test .= "    {\n";
    $test .= "        // Arrange\n";

    if ($inputDtoClass) {
      $test .= "        \$inputDto = new " . $this->getShortClassName($inputDtoClass) . "(/* test data */);\n";
    }

    $test .= "        \$expectedOutput = Mockery::mock($outputDtoClass::class);\n\n";

    $test .= "        \$this->dataProvider\n";
    $test .= "            ->shouldReceive('$methodName')\n";

    if ($inputDtoClass) {
      $test .= "            ->with(\$inputDto)\n";
    } else {
      $test .= "            ->withNoArgs()\n";
    }

    $test .= "            ->once()\n";
    $test .= "            ->andReturn(\$expectedOutput);\n\n";

    $test .= "        // Act\n";

    if ($inputDtoClass) {
      $test .= "        \$this->useCase->execute(\$inputDto);\n";
    } else {
      $test .= "        \$this->useCase->execute();\n";
    }

    $test .= "\n        // Assert\n";
    $test .= "        \$this->assertMethodCalledOnce(\$this->dataProvider, '$methodName'";

    if ($inputDtoClass) {
      $test .= ", \$inputDto";
    }

    $test .= ");\n";
    $test .= "    }\n";

    return $test;
  }

  private function generateDifferentInputTest(string $className, string $inputDtoClass, string $outputDtoClass, string $dataProviderInterface): string
  {
    $methodName = $this->getMethodNameFromClassName($className);

    $test = "    public function testExecuteWithDifferentInput(): void\n";
    $test .= "    {\n";
    $test .= "        // Arrange\n";

    if ($inputDtoClass) {
      $test .= "        \$inputDto = new " . $this->getShortClassName($inputDtoClass) . "(/* different test data */);\n";
    }

    $test .= "        \$expectedOutput = Mockery::mock($outputDtoClass::class);\n\n";

    $test .= "        \$this->dataProvider\n";
    $test .= "            ->shouldReceive('$methodName')\n";

    if ($inputDtoClass) {
      $test .= "            ->with(\$inputDto)\n";
    } else {
      $test .= "            ->withNoArgs()\n";
    }

    $test .= "            ->once()\n";
    $test .= "            ->andReturn(\$expectedOutput);\n\n";

    $test .= "        // Act\n";

    if ($inputDtoClass) {
      $test .= "        \$result = \$this->useCase->execute(\$inputDto);\n";
    } else {
      $test .= "        \$result = \$this->useCase->execute();\n";
    }

    $test .= "\n        // Assert\n";
    $test .= "        \$this->assertInstanceOf($outputDtoClass::class, \$result);\n";
    $test .= "        \$this->assertEquals(\$expectedOutput, \$result);\n";
    $test .= "    }\n";

    return $test;
  }

  private function extractClassName(string $useStatement): string
  {
    if (empty($useStatement)) {
      return '';
    }

    preg_match('/use App\\Application\\Dto\\[^\\\\]+\\\\([^;]+);/', $useStatement, $matches);
    return $matches[1] ?? '';
  }

  private function getMethodNameFromClassName(string $className): string
  {
    // Convert PascalCase to camelCase and add 'Service' suffix
    $methodName = lcfirst($className);
    return $methodName . 'Service';
  }

  private function getShortClassName(string $fullClassName): string
  {
    $parts = explode('\\', $fullClassName);
    return end($parts);
  }
}

// Run the generator
$generator = new UseCaseTestGenerator();
$generator->generateAllTests();
