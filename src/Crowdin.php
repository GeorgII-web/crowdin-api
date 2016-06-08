<?php
/**
 * Crowdin API implementation in PHP.
 *
 * @copyright  Copyright (C) 2016 Nikolai Plath (elkuku)
 * @license    GNU General Public License version 2 or later
 */

namespace ElKuKu\Crowdin;

use GuzzleHttp\Client as HttpClient;

/**
 * Class for interacting with Crowdin.
 *
 * @property-read  Package\Directory    $directory    Crowdin API object for the Directory package.
 * @property-read  Package\File         $file         Crowdin API object for the File package.
 * @property-read  Package\Language     $language     Crowdin API object for the Language package.
 * @property-read  Package\Memory       $memory       Crowdin API object for the Memory package.
 * @property-read  Package\Translation  $translation  Crowdin API object for the Translation package.
 *
 * @since  1.0
 */
class Crowdin
{
	/**
	 * @var string
	 */
	protected $projectId;

	/**
	 * @var string
	 */
	protected $apiKey;

	/**
	 * @var HttpClient
	 */
	protected $httpClient;

	/**
	 * Constructor.
	 *
	 * @param   string      $projectId  The project ID.
	 * @param   string      $apiKey     The API key
	 * @param   string      $baseUri    The base URI
	 * @param   HttpClient  $client     The HTTP client object.
	 *
	 * @since    1.0
	 */
	public function __construct($projectId, $apiKey, $baseUri = 'http://api.crowdin.net/api/', HttpClient $client = null)
	{
		$this->projectId = $projectId;
		$this->apiKey = $apiKey;

		$this->httpClient  = isset($client) ? $client : new HttpClient(['base_uri' => $baseUri]);
	}

	/**
	 * Magic method to lazily create API objects.
	 *
	 * @param   string  $name  Name of property to retrieve
	 *
	 * @return  Object
	 *
	 * @since   1.0
	 * @throws  \InvalidArgumentException If $name is not a valid sub class.
	 */
	public function __get($name)
	{
		$class = 'ElKuKu\\Crowdin\\Package\\' . ucfirst($name);

		if (class_exists($class))
		{
			if (false === isset($this->$name))
			{
				$this->$name = new $class($this->projectId, $this->apiKey, $this->httpClient);
			}

			return $this->$name;
		}

		throw new \InvalidArgumentException(sprintf('Argument %s produced an invalid class name: %s', $name, $class));
	}
}
