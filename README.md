# SpecificClassCollection

## Installation

Just execute:

```
composer require mangelsnc/specific-class-collection
```

## Description

This abstract class allows you to create collections of a specific class.

Have you ever seen something like this in Java?

```java
public String join (ArrayList<String> collection) {
    String joinedString = '';
    
    for (String temp : collection) {
        joinedString.concat(temp);
    }
    
    return joinedString;
}
```

It's very useful to have a collection that ensures all the objects contained on it are of some specific class.

PHP lacks of something like that, and we are forced to make unelegant code like this:

```php
<?php

namespace Solid\ApplicationService;

use Solid\ApplicationService\ValidatorRules\IdentityNumberValidatorRuleInterface;

class IdentityNumberValidator
{
    private $validators;
    
    public function __construct($validators = [])
    {
        foreach ($validators as $validator) {
            if ($validator instanceof IdentityNumberValidatorRuleInterface) {
                $this->validators[$validator->getClassName()] = $validator;
            }
        }
    }
    
    // more code
}
```

In this case we want to pass to the constructor a collection of validators, but there's no
an easy way to do it in PHP, so, we perform a validation of the type in the same constructor.

This is not elegant, but moreover, it can make these validator not work if there's no item implementing the desired 
interface in the array passed to the constructor.


With collections, the old constructor can be refactored as this:

```php
<?php

namespace Solid\ApplicationService;

use Solid\ApplicationService\ValidatorRules\IdentityNumberValidatorRuleCollection;
use Solid\ApplicationService\ValidatorRules\IdentityNumberValidatorRuleInterface;

class IdentityNumberValidator
{
    private $validators;
    
    public function __construct(IdentityNumberValidatorRuleCollection $validators)
    {
        foreach ($validators as $validator) {
            $this->validators[$validator->getClassName()] = $validator;
        }
    }
    
    // more code
}
```

Leaving a clean constructor and delegating the validation of the types to the correct place.

**Note:** The collections can be iterated as an array or if you prefer, you can call the method `getElements` the get the array.

### Create a collection class
With this little helper, create a specific collection class is easy as this:

```php
<?php

namespace Solid\ApplicationService\ValidatorRules;

use SpecificClassCollection\SpecificClassCollection;
use Solid\ApplicationService\ValidatorRules\IdentityNumberValidatorRuleInterface;

class IdentityNumberValidatorRuleCollection extends SpecificClassCollection
{

    protected function getValidClassName()
    {
        return IdentityNumberValidatorRuleInterface::class;
    }
}
```

### Manipulate the collection


Add elements to a collection:

```php
$collection = new IdentityNumberValidatorRuleCollection();
$collection->add($rule);
$collection->add($rule);

```

Get the number of elements inside the collection:

```php
$collection->count();
```

Reset the collection content:

```php
$collection->clear();
```
