Usage:

Inject Storage

	/**
	 * @var \Aijko\SessionStorage\Storage
	 * @inject
	 */
	protected $sessionStorage;

Alternative
	$sessionStorage = $this->objectManager->get('Aijko\\SessionStorage\\Storage');

Use it like

	String:
	$this->sessionStorage->set('name', 'Julian Kleinhans');

	Array:
	$this->sessionStorage->set('address', array(
		'street' => 'Musterstr. 87',
		'zip' => '12345'
	));

	Object
	$this->sessionStorage->set('address', new stdClass());


	Read:
	$this->sessionStorage->get('name');