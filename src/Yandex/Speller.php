<?php namespace Yandex;

use Guzzle\Http\ClientInterface;
use Guzzle\Http\Client;

/**
 * Yandex speller api wrapper http://api.yandex.ru/speller/doc/dg/concepts/api-overview.xml
 * @class
 */
class Speller
{
	const API_ENDPOINT = 'http://speller.yandex.net/services/spellservice.json/';

	/**
	 * Available API methods
	 */
	const METHOD_CHECK_TEXT  = 'checkText';
	const METHOD_CHECK_TEXTS = 'checkTexts';

	/**
	 * @var http adapter
	 */
	protected $adapter;

	public function __construct() {
		$this->setDefaultAdapter();
	}

	/**
	 * Check text
	 *
	 * @param mixed $text
	 * @param array $options
	 * @return array
	 */
	public function check($text, $options = array()) {
		if (is_array($text)) {
			throw new \ErrorException('Sorry, array support does not implemented yet :)');
		}

		return $this->checkText($text, $options);
	}

	/**
	 * Check single text
	 *
	 * @param string $text
	 * @param array $options
	 * @return array
	 */
	public function checkText($text, $options = array()) {
		$url = static::API_ENDPOINT . static::METHOD_CHECK_TEXT . '?text=' . $text;
		return $this->adapter->get($url)->send()->json();
	}

	/**
	 * Set HTTP adapter
	 * @param Guzzle\Http\ClientInterface $adapter instance of http client
	 */
	public function setAdapter(ClientInterface $adapter) {
		$this->adapter = $adapter;
	}

	/**
	 * Set default http adapter Guzzle\Http\Client
	 */
	public function setDefaultAdapter() {
		$this->setAdapter(new Client());
	}
}
