# PHPStan Symfony Rules

## Description
This package provides custom PHPStan rules for Symfony projects to enforce better coding practices by preventing the use of debugging and execution-halting functions such as:

- `var_dump()`
- `dump()`
- `dd()`
- `die()`
- `exit()`

## Installation

Require the package via Composer:

```bash
composer require --dev marek-d-lis/phpstan-symfony-rules
```

## Configuration

Include the package's rules in your `phpstan.neon` configuration file:

```neon
includes:
  - vendor/marek-d-lis/phpstan-symfony-rules/extension.neon
```

## Rules

### 1. NoDumpRule
- Prevents the use of `var_dump()` and `dump()`.
- Example violation:
  ```php
  var_dump($data); // ❌ Not allowed
  dump($data); // ❌ Not allowed
  ```

### 2. NoDieRule
- Prevents the use of `die()`, `exit()`, and `dd()`.
- Example violation:
  ```php
  die("Fatal error"); // ❌ Not allowed
  exit(1); // ❌ Not allowed
  dd($data); // ❌ Not allowed
  ```

## License

This project is licensed under the MIT License. See the `LICENSE` file for details.

## Author

Marek D. Lis - [Website](https://marekdlis.pl)

