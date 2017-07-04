# Translator PHP SDK
### Examples
Get all translations
```
$apiKey = 'PROJECT_API_KEY';
$translator = new \Translator\Translator($apiKey);
$result = $translator->all();
```
Send abstraction
```
$apiKey = 'PROJECT_API_KEY';

$group = new \Translator\Group('category_adv');

$translator = new \Translator\Translator();

$translation = new \Translator\Translation();
$translation->setAbstractName('test_abstract_name');
$translation->setOriginalValue('Hello!');
$translation->setComment('Comment to abstraction');
$translation->addGroup($group);

$collection = new \Translator\Collection();
$collection->add($translation);

$result = $translator->send($collection);
```

Other examples can viewed in folder ./examples/ 