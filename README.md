yii2-helpers
================

Collection of handy helpers for Yii2 websites.

## Installation

### Composer

Add extension to your `composer.json` and update your dependencies as usual, e.g. by running `composer update`
```js
{
    "require": {
        "nirvana-msu/yii2-helpers": "1.0.*@dev"
    }
}
```

##HtmlHelper

Inject arbitrary code into existing HTML structure, before or after a chosen opening/closing tag, e.g.:
```php
$html = HtmlHelper::inject($htmlToInject, $originalHtml, 'head', HTMLHelper::TAG_OPENING, HTMLHelper::POS_AFTER);
```

Convert HTML to plain text:
```php
$text = HtmlHelper::htmlToPlainText($html);
```

##MathHelper

Create a histogram with specified bins out of a given array:
 * `$values` *array*, e.g. [11, 12, 20, 25, 20.1, 33.5]
 * `$edges` *array*, e.g. [0, 10, 20, 30, 40]
 * returns *array* histogram, e.g. ['0-10' => [], '10-20' => [11,12], '20-30' => [20,25,20.1], '30-40' => [33.5]]

```php
$histogram = MathHelper::histogram($values, $edges);
```

##RbacHelper

Create role with a given name and description and add it to RBAC system:
```php
$role = RbacHelper::createRole($name, $description)
```

Create permission with a given name and description and add it to RBAC system, assigning permission to the role:
```php
$permission = RbacHelper::createChildPermission($role, $name, $description);
```

Remove rule from RBAC system by name:
```php
RbacHelper::removeRuleByName($rule->name);
```

Remove permission from RBAC system by name:
```php
RbacHelper::removePermissionByName($name)
```

Remove role from RBAC system by name:
```php
RbacHelper::removeRoleByName($name)
```

##License

Extension is released under MIT license.
