<?php
declare(strict_types = 1);

require_once __DIR__.'/../vendor/autoload.php';

// initialisation
$pdo = new \PDO('sqlite::memory:');
$databaseAdapter = new \Agares\MicroORM\PDODbAdapter($pdo);
$entityDefinitionCreator = new \Agares\MicroORM\EntityDefinitionCreator(new \Agares\MicroORM\FieldNameMappers\StripGet());

// create a test table
$databaseAdapter->executeCommand('CREATE TABLE transactions (product TEXT, price TEXT, price_currency TEXT)');

// create some test data
$transactions = [
    ['Wonderful Tea', '9.99', 'GBP'],
    ['Lousy Coffee', '10', 'CZK']
];

foreach ($transactions as $transaction) {
    $parameters = array(
        ':product' => $transaction[0],
        ':price' => $transaction[1],
        ':price_currency' => $transaction[2]
    );

    $databaseAdapter->executeCommand('INSERT INTO transactions VALUES(:product, :price, :price_currency)', $parameters);
}

// define a value object
class Currency
{
    private $amount = '0';
    private $currency = 'XXX';

    public function __construct(string $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount() : string
    {
        return $this->amount;
    }

    public function getCurrency() : string
    {
        return $this->currency;
    }

    public function __toString()
    {
        return sprintf('%s %s', $this->amount, $this->currency);
    }
}

// define an entity
class Transaction
{
    private $product;
    private $price;

    public function __construct(string $product, string $price)
    {
        $this->product = $product;
        $this->price = $price;
    }

    public function getProduct() : string
    {
        return $this->product;
    }

    public function getPrice() : \Currency
    {
        return $this->price;
    }
}

// we need a custom TypeMapper for our value object
class CurrencyTypeMapper implements \Agares\MicroORM\TypeMapperInterface
{
    public function fromString(string $fieldName, array $fields)
    {
        return new Currency($fields[$fieldName], $fields[$fieldName.'_currency']);
    }
}

// let's try this:
$typeMappers = [
    'string' => new \Agares\MicroORM\TypeMappers\StringTypeMapper(),
    'int' => new \Agares\MicroORM\TypeMappers\IntegerTypeMapper(),
    'Currency' => new CurrencyTypeMapper()
];

$entityMapper = new \Agares\MicroORM\EntityMapper($typeMappers);
$queryAdapter = new \Agares\MicroORM\QueryAdapter($databaseAdapter, $entityMapper);
$transactions = $queryAdapter->executeQuery('SELECT product, price, price_currency FROM transactions', $entityDefinitionCreator->create(Transaction::class));
foreach ($transactions as $transaction) {
    /** @var Transaction $transaction */
    printf('%s (%s)%s', $transaction->getProduct(), (string) $transaction->getPrice(), PHP_EOL);
}