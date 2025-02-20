# Table Generator

[![Latest Stable Version](https://poser.pugx.org/ucscode/html-table-generator/v/stable)](https://packagist.org/packages/ucscode/html-table-generator)
[![License](https://poser.pugx.org/ucscode/html-table-generator/license)](https://packagist.org/packages/ucscode/html-table-generator)
[![Total Downloads](https://poser.pugx.org/ucscode/html-table-generator/downloads)](https://packagist.org/packages/ucscode/html-table-generator)

Table Generator is a powerful yet flexible PHP library that allows you to create and manipulate HTML tables dynamically with minimal effort. Whether you need to generate tables from MySQL query results, CSV data, associative arrays, or any custom format, this package provides a structured and extensible way to do so.

## Features

- **Adapter System** – Convert various data structures (MySQL result, CSV, JSON, Doctrine, etc.) into tables.
- **Pagination Support** – Easily paginate large datasets using [ucscode/easy-paginator](https://github.com/ucscode/easy-paginator).
- **Middleware Customization** – Modify table rows dynamically (e.g., add action buttons, hide sensitive data).
- **Modular Components** – Each table element (thead, tbody, tr, td, etc.) is an instance, allowing for full customization.
- **Parameter Bags** – Store temporary values that affect rendering without exposing them as HTML attributes.
- **DOM Manipulation with UssElement** – Directly set attributes, classes, or IDs on table elements.

## Installation

Install via Composer:

```sh
composer require ucscode/html-table-generator
```

## Quick Example

```php
use Ucscode\HtmlComponent\TableGenerator;
use Ucscode\HtmlComponent\TableGenerator\Adapter\AssocArrayAdapter;

$data = [
    ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
    ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com']
];

$adapter = new AssocArrayAdapter($data);
$htmlTableGenerator = new TableGenerator($adapter);

echo $htmlTableGenerator->render();
```

## Table of Contents

1. [Adapters](#adapters)
2. [Pagination](#pagination)
3. [Middleware](#middleware)
4. [Table Components](#table-components)
5. [Parameter Bags](#parameter-bags)
6. [Customization](#customization)
7. [Interactive Example](#interactive-example)

## Adapters

Adapters are responsible for structuring data into an HTML table. Each adapter converts a specific data format into table rows and columns.

### Available Adapters

- **CsvArrayAdapter** – Converts a 2D array (CSV-like data) into a table.
- **AssocArrayAdapter** – Uses associative arrays where the keys become the table headers.
- **MysqliResultAdapter** – Transforms a MySQLi result object into a table.
- **DoctrineORMAdapter** – Converts Doctrine ORM result sets.
- **DoctrineDBALAdapter** – Converts Doctrine DBAL query results.

### Example: Using a MySQLi Adapter

```php
use Ucscode\HtmlComponent\TableGenerator;
use Ucscode\HtmlComponent\TableGenerator\Adapter\MysqliResultAdapter;

$mysqli = new mysqli("localhost", "user", "password", "database");
$result = $mysqli->query("SELECT id, name, email FROM users");

$adapter = new MysqliResultAdapter($result);
$htmlTableGenerator = new TableGenerator($adapter);

echo $htmlTableGenerator->render();
```

## Pagination

Pagination is integrated using [ucscode/easy-paginator](https://github.com/ucscode/easy-paginator) which allows only a subset of table rows is displayed per page.

### Example: Paginating a CSV Table

```php
use Ucscode\HtmlComponent\TableGenerator\Adapter\CsvArrayAdapter;
use Ucscode\EasyPaginator\Paginator;

$data = [...]; // Your CSV-like array data
$paginator = new Paginator(0, 10, 2); // 10 items per page, on page 2
$adapter = new CsvArrayAdapter($data, $paginator);

$htmlTableGenerator = new TableGenerator($adapter);

echo $htmlTableGenerator->render();
```

## Middleware

Middleware allows modification of table rows before rendering. This is useful when data sources cannot be directly modified (e.g., MySQL results).

### Example: Adding an "Actions" Column

```php
use Ucscode\HtmlComponent\TableGenerator\Middleware\MiddlewareInterface;
use Ucscode\HtmlComponent\TableGenerator\Component\Section\Tr;
use Ucscode\HtmlComponent\TableGenerator\Component\Td;

class ActionsMiddleware implements MiddlewareInterface 
{
    public function alterTr(Tr $tr): Tr 
    {
        $actions = new Td('<a href="#">Edit</a> | <a href="#">Delete</a>');

        $tr->addCell($actions);

        return $tr;
    }
}
```

Apply middleware when creating the table:

```php
$adapter = new MysqliResultAdapter($result);
$htmlTableGenerator = new TableGenerator($adapter, new ActionsMiddleware());

echo $htmlTableGenerator->render();
```

Alternatively, apply middleware and regenerate the table structure

```php
$htmlTableGenerator = new TableGenerator($adapter);
$htmlTableGenerator->setMiddleWare(new ActionsMiddleware())->regenerate();

echo $htmlTableGenerator->render();
```

## Table Components

Each part of the table (thead, tbody, tr, td, etc.) is an instance, allowing manipulation before rendering.

```php
$table = new Table();
$thead = new Thead();
$tr = new Tr();

$tr->addCell(new Th("ID"));
$tr->addCell(new Th("Name"));

$thead->addTr($tr);
$table->addThead($thead);

echo $table->render();
```

## Parameter Bags

Parameter Bags store metadata that neither affects table rendering nor appear in the HTML output.

```php
$tr->getParameters()->set('custom-data', 'value');
```

## Customization

Custom adapters can be created by implementing `AdapterInterface`:

```php
use Ucscode\HtmlComponent\TableGenerator\Contracts\AdapterInterface;

class CustomAdapter implements AdapterInterface 
{
    public function getTheadTr(): Tr { ... }
    public function getTbodyTrCollection(): TrCollection { ... }
    public function getPaginator(): Paginator { ... }
}
```

---

For more details, see the full documentation.

---

### License

This package is licensed under the MIT License.

### Contributing

Contributions are welcome! Feel free to open an issue or submit a pull request.

