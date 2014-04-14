Coding Guidelines
=====

html
-----

### Order of attributes in &lt;input&gt;

1. type
2. name
3. id
4. class
5. data
6. style


php
-----

### Class

``` php
class UpperCamel
{
	// properties and methods
}
```

### Method / Function

``` php
class Klass
{
	public function lowerCamel ()
	{
		// do some work
	}
}

function lowerCamelCase ($some, $args)
{
	// do some work
}
```

### Property / Local variable

``` php
class Klass
{
	public $lowerCase;

	public function someMethod ()
	{
		$someLocalVariable = null;
	}
}
```
