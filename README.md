## Usage

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/b/aijko/session_storage/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/b/aijko/session_storage/?branch=master)

### Inject Storage
```php
	/**
	 * @var \Aijko\SessionStorage\Storage
	 * @inject
	 */
	protected $sessionStorage;
```
####Alternative
```php
	$sessionStorage = $this->objectManager->get('Aijko\\SessionStorage\\Storage');
```


### Use it like

#### String
```php
	$this->sessionStorage->set('name', 'Julian Kleinhans');
```
#### Array
```php
	$this->sessionStorage->set('address', array(
		'street' => 'Musterstr. 87',
		'zip' => '12345'
	));
```

#### Object
```php
	$this->sessionStorage->set('address', new stdClass());
```

###Read
```php
	$this->sessionStorage->get('name');
```