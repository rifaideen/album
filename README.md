## Description

Bunch of selfies as memorable albums.

This module allows user to add albums with description and optional album cover.
### Configuration
Open `<your-application>/protected/config/common.php` and make sure that `urlManager` is configured like the below.

```php
<?php

return [
    
    'components' => [
        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => true,
        ]
    ]
    
];
```

### Minimal Requirements

- php 5.4+
- humhub v1.0.*
 


### Status

Under Development.

__Author:__ Rifaudeen
__Author profile:__ [facebook.com/Ahamed201](https://www.facebook.com/Ahamed201)
