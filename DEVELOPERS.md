# Biteral PHP SDK – Developer Guide

This guide is for contributors and developers working on the Biteral PHP SDK itself.

---

## Requirements

- PHP 5.6 or higher
- Composer
- Bash, for running examples
- For running the docker PHP minimum version environment
    - Docker
    - Make

## Getting Started

```bash
git clone https://github.com/biteral-net/biteral-sdk-php.git
cd biteral-sdk-php
composer install
```

## Run tests

```bash
composer test
```

## Minimum PHP version
Because the SDK is designed to run on older servers, all code must be compatible with the minimum required PHP version.

Refer to the require section in composer.json to confirm the minimum supported version:

```json
"require": {
    "php": ">=5.6"
}
```

Avoid using PHP features introduced in newer versions unless the php requirement is updated, for example:

- typed properties `public int $value;`
- arrow functions `fn($x) => $x * 2`
- null coalescing assignment `$x ??= 0;`
- spread operator in arrays `[...$array]`
- `__serialize()` / `__unserialize()`
- Union types `int|string $value`
- Named arguments `foo(bar: 'value')`
- Constructor property promotion `public function __construct(private string $x)`
- Match expressions `match($x) { ... }`
- Throw expressions `$x ?? throw new Exception()`
- Enums
- `readonly` properties
- `never` return type

## Running tests and examples in a minimum PHP version
A dockerized environment is provided where you can SSH in to run tests and examples in a minimum PHP version.

SSH into the dockerized environment:

```bash
cd docker
```
```bash
make ssh
```

You can now run `composer test` and `bin/example <example name>` in an environment with the minimum required PHP version.

## .env examples and testing configuration file
You can create an `.env` file on the root of the repository to contain the Api key and other parameters to be used when running examples or the testing suite.

The first time you run an example, if your '.env' is not already set, you'll be asked for your API key and `.env` will be automatically created.

> ⚠️ Be sure not to commit that file into git. It's been already added to .gitignore.

You can also set a specific API base url or version in the `.env` file, if you ever need it.

Here's an example of an `.env` with all the parameters you can optionally set:

```bash
export BITERAL_API_KEY=your-api-key
export BITERAL_API_BASE_URL=https://api.biteral.net
export BITERAL_API_VERSION=1
```
