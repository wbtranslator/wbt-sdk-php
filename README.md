# WBTranslator PHP SDK
### Examples
Get all translations
```php
define('WBT_API_KEY', '*****YOUR_PROJECT_API_KEY*****');

$config = new \WBTranslator\Sdk\Config();
$config->setApiKey(WBT_API_KEY);

$sdk = new \WBTranslator\Sdk\WBTranslatorSdk($config);
$result = $sdk->translations()->all();
```

Other examples can viewed in folder ./examples/ 