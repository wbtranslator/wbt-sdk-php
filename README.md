# Translator PHP SDK
### Examples
Get all translations
```
$translator = new \Translator\Translator('PROJECT_API_KEY');
$result = $translator->all();
```
Send abstraction
```
$translation = new \Translator\Translation();
$translation->setAbstractName('test_abstract_name');
$translation->setOriginalValue('Hello!');
$translation->setComment('Comment to abstraction');
$translation->addGroup(new \Translator\Group('category_adv'));

$translator = new \Translator\Translator('PROJECT_API_KEY');
$translator->send(new \Translator\Collection([$translation]));
```

Other examples can viewed in folder ./examples/ 