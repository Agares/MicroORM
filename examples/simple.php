<?php
declare(strict_types = 1);

require_once __DIR__.'/../vendor/autoload.php';

// this initialisation might look complex, but remember that it's done only once - in your DI container
$pdo = new \PDO('sqlite::memory:');
$databaseAdapter = new \Agares\MicroORM\PDODbAdapter($pdo);
$entityMapper = new \Agares\MicroORM\EntityMapper();
$queryAdapter = new \Agares\MicroORM\QueryAdapter($databaseAdapter, $entityMapper);

// let's create some data!
$queryAdapter->executeCommand('CREATE TABLE people (firstname TEXT, lastname TEXT)');
$people = [
    ['Jeff', 'Lebowski'],
    ['Bunny', 'Lebowski'],
    ['The', 'Dude']
];

foreach($people as $person) {
    $parameters = array(
        ':firstname' => $person[0],
        ':lastname' => $person[1]
    );
    $queryAdapter->executeCommand('INSERT INTO people VALUES(:firstname, :lastname)', $parameters);
}

// time to start the real fun!
// Let's create an entity
class Person
{
    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    public function __construct(string $firstname, string $lastname)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    public function getFirstname() : string
    {
        return $this->firstname;
    }

    public function getLastname() : string
    {
        return $this->lastname;
    }
}

// And now we can query the DB
$people = $queryAdapter->executeQuery('SELECT firstname, lastname FROM people', Person::class);

foreach($people as $person) {
    /** @var Person $person */
    printf('%s %s%s', $person->getFirstname(), $person->getLastname(), PHP_EOL);
}