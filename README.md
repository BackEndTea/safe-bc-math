# Safe BC Math

## Installation

```bash
$ composer require backendtea/safe-bc-math
```

## Why this package

Casting a float to a string does not always do what you think it does.
Some locales may give unexpected results, and give a malformed string, or
the number is cast to a scientific notationm for example: `1.0E-11`. Which bcmath cant handle.
Even if you do not manually cast it to a string, the bc math functions expect strings, and will cast it themselves.

This package will throw an exception telling you what error it encountered, instead of giving a
warning `bcmath function argument is not well-formed` and returning a wrong error.

## Usage

Replace any usage of bc math functions with the `Backendtea\bc..` version.

e.g.

```diff
- bcadd($a, $b);
+ \BackEndTea\bcadd($a, $b);
```

Or even better, import the funtion:

```diff
+ use function BackEndTea\bcadd;

bcadd($a, $b);
```
