# TOC

Basic:
    - Introduction
        An introduction to what HTML Table Generator is

    - Why Table Generator
        Why the library was created, who it is for, its advantages, what it solves, why it's unique, why it should be used etc

    - Features
        A summary of what it contains such as adapter, middleware etc

    - Installation
        How to manage the library using composer

    - Example
        Code samples and output of the html table structure

Table Structure
    - Layout
        Explains the basic layout of an html table, each element, how many the can be, the child type the accept and how many of the child can be accepted

    - Classes
        Explains the classes version of the layout elements, hence Tr object is a reference to <tr/> element

    - Collection
        Explain classes which can be multiple. E.g for classes like tr that can be multiple under tbody, Tbody class uses TrCollection to manage each tr

    - Cells
        A cell represents a single td or th block

    - Usage / Examples
        How to use the classes. e.g $table->addTbody(...), $tbody->addTr(...) etc

Adapter
    - Fundamentals
        Explain adapter and how it works

    - Pagination
        Explain how pagination can be implemented with adapter to split table files

    - Custom Adapter
        Explain how custom adapter can be created

HtmlTableGenerator
    - Fundamentals
        Explain that this uses adapter to build the an html table. creating one header row, multiple table body and one footer is enabled.

    - Adapter restriction
        Explain that adapter provides fixed value based on fixed information from database, csv, json etc and the limitation brings us to using middleware

    - Using Middleware
        Explain how the use of middleware to to update information

Middleware
    - Fundamentals
        Explain middleware and usage

    - Examples
        Give examples of middleware usage

References:
    - Components:
        A component is a class representation of an element in the table. 
        They implement the TableComponentInterface (which also implements the RenderableInterface). 
        Available components include:

            - Table
            - Col
            - Td
            - Th
            - Tr
            - Caption
            - ColGroup
            - Thead
            - Tbody
            - Tfoot

        All components have the following methods:

            - TableComponentInterface::getParameters(): ParamterBag
            - RenderableInterface::setAttributes(Attributes $attributes): static;
            - RenderableInterface::getAttributes(): Attributes;
            - RenderableInterface::createElement(): ElementInterface;
            - RenderableInterface::render(?int $indent): string;
            - RenderableInterface::__toString(): string;

        All component class __construct accepts an optional array or Attributes instance, with the exception of ArbitraryDataInterface which accept 
        an optional data in 1st parameter and then array or Attributes instance as second. E.g

        new Tr([
            'class' => 'tr-class',
        ])

        new Td('Value', [
            'class' => 'td-class',
        ])
        
        Arbitrary data components are components that does not have a fixed type of accepted data. 
        The implement ArbitraryDataInterface and can accept direct input from the user. 
        This includes:

            - Caption
            - Th
            - Td

        They have the following methods:

            - ArbitraryDataInterface::getData(): mixed;
            - ArbitraryDataInterface::setData(mixed $data): static;

        Cell Component represents a single block in the table and implements the CellInterface. These includes:

            - Th
            - Td

    - Collection:
        Available Collections include:

            - CellCollection
            - ColCollection
            - ColGroupCollection
            - TbodyCollection
            - TrCollection

        All collections implements the CollectionInterface and have the methods:

            - CollectionInterface::toArray(): array<Component>
            - CollectionInterface::isEmpty(): bool
            - CollectionInterface::count(): int
            - CollectionInterface::sort(callable $callback): static
            - CollectionInterface::clear(): int|bool

        Each method have specific method related to them but follow the same pattern as below:
        
            - ComponentCollection::add(Component $entity): static
            - ComponentCollection::get(int $index): ?Component
            - ComponentCollection::has(Component $entity): bool
            - ComponentCollection::remove(int|Component $entity): static
            - ComponentCollection::indexOf(Component $entity): int|bool
        
        "Component" in this case represents the table entity. E.g

            TrCollection::add(Tr $tr): static
            TbodyCollection::add(Tbody $tbody): static

    - Adapters:
        Avaiable adapters include
            CsvArrayAdapter:
                Processes Csv-Like data
            AssocArrayAdapter:
                Processes assoc array
            MysqliResultAdapter:
                ...

    - HtmlTableGenerator:
        This is the base class for generating table. It has the following methods:

            - __toString()
            - getTable(): Table
            - render(): string
            - getPaginator(): Paginator
            - setTfootEnabled(bool $enabled): static
            - isTfootEnabled(): bool
            - getAdapter(): AdapterInterface
            - setMiddleware(?MiddlewareInterface $middleware): static
            - getMiddleware(): MiddlewareInterface
            - final regenerate(null|array|Attributes $attributes = null): static

How to:
    How to add extra cells
    How to update a cells
    How to add action buttons
    Example of custom Json Adapter
    How to add table pagination
    How to add table search filter
    How to create table wrapper
    How to apply colspan
    How to create compactible email table