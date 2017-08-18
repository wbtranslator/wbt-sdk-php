# WBTranslator PHP SDK
### Examples
Get all translations
```php
define('WBT_API_KEY', 'ea84db77506cd5bc8586af4ec4b7a347');

$config = new \WBTranslator\Sdk\Config();
$config->setApiKey(WBT_API_KEY);

$sdk = new \WBTranslator\Sdk\WBTranslatorSdk($config);
$result = $sdk->translations()->all();
```

Other examples can viewed in folder ./examples/ 