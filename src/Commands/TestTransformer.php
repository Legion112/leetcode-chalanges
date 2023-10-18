<?php

namespace App\Commands;

use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('transform')]
class TestTransformer extends Command
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $file = realpath('./input.txt');
        $output->writeln("Reading input file($file)");
        $resource = fopen($file, 'r');
        $caseName = trim(fgets($resource), "\n");
        $caseName = $this->toCamelCase($caseName);
        $output->writeln("Case name: $caseName");
        $functions = array_map(fn($v) => trim($v, '"'), explode(',', trim(fgets($resource), "[]\n")));

        $className = $functions[0];
        $testClassName = $className . 'GenerateTest';
        $testClass = (new ClassType($testClassName))->setExtends(TestCase::class);
        $calls = array_slice($functions, 1, preserve_keys: true);
        $output->writeln("Classname: $className");

        $callArguments = array_map([$this, 'mapArgument'], array_map(fn($v) => substr($v, 1, -1), explode(',', substr(fgets($resource), 1, -2))));
        $expectedReturnValues = array_map([$this, 'mapReturnValue'], explode(',', trim(substr(fgets($resource), 1, -1))));
        $output->write("Function calls: ");
        foreach ($callArguments as $callId => $arguments) {
            $output->writeln(sprintf("%s(%s) = %s", $functions[$callId], implode(',', $arguments), $expectedReturnValues[$callId] === null ? 'null' : $expectedReturnValues[$callId]));
        }

        $testCase = $testClass->addMethod($caseName)->setReturnType('void')->addAttribute(Test::class);
        $testCase->addBody(sprintf('$s = new %s();%s', $className, "\n"));
        foreach($calls as $callId => $function) {
            $testCase->addBody(
                "self::assertSame({$expectedReturnValues[$callId]},"
                . sprintf('$s->%s(%s)', $function, implode(', ', $callArguments[$callId]))
                . ');'
            );
        }


        $phpFile = new PhpFile();
        $phpFile->setStrictTypes();
        $namespace = new PhpNamespace('Tests');
        $namespace->addUse(Test::class);
        $namespace->addUse(TestCase::class);
        $namespace->addUse("App\\$className");
        $namespace->add($testClass);
        $phpFile->addNamespace($namespace);
        $output->writeln($phpFile);

        $outputPath = "./tests/$testClassName.php";
        file_put_contents($outputPath, $phpFile);


        $output->writeln("Generate file: $outputPath");

        fclose($resource);
        return self::SUCCESS;
    }

    public function mapArgument(string $v): array
    {
        if ($v === '') {
            return [];
        }
        if (is_numeric($v)) {
            return [intval($v)];
        }
        throw  new RuntimeException("No support for type: $v");
    }
    public function mapReturnValue(string $v):mixed
    {
//        if ($v === 'null') {
//            return null;
//        }
        return $v;
    }

    public function toCamelCase(string $string):string
    {
        $strings = explode(' ', $string);
        return strtolower(reset($strings)) . implode('', array_map('ucwords', array_slice($strings, 1)));
    }

    protected function configure()
    {
    }
}