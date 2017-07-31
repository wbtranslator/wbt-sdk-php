# WBTranslator PHP SDK
### Examples
Get all translations
```
use \WBTranslator\WBTranslatorSdk;

$sdk = new WBTranslatorSdk(TRANSLATOR_API_KEY);
$result = $sdk->translations()->all();
```

Other examples can viewed in folder ./examples/ 