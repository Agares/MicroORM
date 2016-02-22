<?php
declare(strict_types = 1);

require_once __DIR__.'/../vendor/autoload.php';

// this initialisation might look complex, but remember that it's done only once - in your DI container
$pdo = new \PDO('sqlite::memory:');
$databaseAdapter = new \Agares\MicroORM\PDODbAdapter($pdo);
$entityMapper = new \Agares\MicroORM\EntityMapper();
$queryAdapter = new \Agares\MicroORM\QueryAdapter($databaseAdapter, $entityMapper);
$entityDefinitionCreator = new \Agares\MicroORM\EntityDefinitionCreator();

// let's create some data!
$queryAdapter->executeCommand('CREATE TABLE people (firstname TEXT, lastname TEXT, age INT)');
$people = [
    ['Jeff', 'Lebowski', 30],
    ['Bunny', 'Lebowski', 25],
    ['The', 'Dude', 50]
];

foreach($people as $person) {
    $parameters = array(
        ':firstname' => $person[0],
        ':lastname' => $person[1],
        ':age' => $person[2]
    );
    $queryAdapter->executeCommand('INSERT INTO people VALUES(:firstname, :lastname, :age)', $parameters);
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

    /**
     * @var int
     */
    private $age;

    /**
     * This constructor will not be called by MicroORM.
     *
     * @param string $firstname
     * @param string $lastname
     * @param int $age
     */
    public function __construct(string $firstname, string $lastname, int $age)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->age = $age;
    }

    public function getFirstname() : string
    {
        return $this->firstname;
    }

    public function getLastname() : string
    {
        return $this->lastname;
    }

    public function getAge() : int
    {
        return $this->age;
    }
}

// And now we can query the DB
// The types of properties will be inferred from getters
$people = $queryAdapter->executeQuery('SELECT firstname, lastname, age FROM people', $entityDefinitionCreator->create(Person::class));

foreach($people as $person) {
    /** @var Person $person */
    printf('%s %s (age %d)%s', $person->getFirstname(), $person->getLastname(), $person->getAge(), PHP_EOL);
}