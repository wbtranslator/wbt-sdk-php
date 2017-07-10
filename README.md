# Translator PHP SDK
### Examples
Get all translations
```
use \WebTranslator\WebTranslator;

$translator = new WebTranslator(TRANSLATOR_API_KEY);
$result = $translator->translations()->all();
```

Other examples can viewed in folder ./examples/ 