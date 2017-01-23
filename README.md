# NotificationBundle
### Installation:
```
composer require akaradech/notifybundle
```

Add this line to app/AppKernel.php

```PHP
$bundles = [
  ....
  new Akaradech\NotificationBundle\NotificationBundle()
];
```

Include routing.yml to app/config/routing.yml
```yml
app:
    resource: "@NotificationBundle/Resources/config/routing.yml"
```
### Have fun :)
