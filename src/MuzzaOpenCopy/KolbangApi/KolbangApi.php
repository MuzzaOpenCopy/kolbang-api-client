<?php
/**
 * Created by PhpStorm.
 * User: muzza
 * Date: 20/02/16
 * Time: 11:02 AM
 */

namespace MuzzaOpenCopy\KolbangApi;

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;

class KolbangApi
{
    /**
     * @var string The default base URL.
     */
    const DEFAULT_BASE_URL = 'http://kolbang.app/api/v1';

    /**
     * Create a new GuzzleClient configured to query the postcodes.io API.
     *
     * @param string $baseUrl The base URL to use.
     *
     * @return GuzzleClient A new GuzzleClient.
     */
    public function create($baseUrl = self::DEFAULT_BASE_URL)
    {
        return new GuzzleClient(new Client(), $this->getServiceDescription($baseUrl));
    }

    /**
     * Get the service description.
     *
     * @param string $baseUrl The base URL.
     *
     * @return GuzzleServiceDescription The service description.
     */
    protected function getServiceDescription($baseUrl)
    {
        return new Description(
            array(
                'baseUrl' => $baseUrl,
                'operations' => array(
                    'cinemas' => array(
                        'uri' => 'cinemas',
                        'httpMethod' => 'GET',
                        'responseModel' => 'getResponse',
                        'parameters' => array()
                    ),
                    'cinema' => array(
                        'uri' => 'cinemas/{cinema}',
                        'httpMethod' => 'GET',
                        'responseModel' => 'getResponse',
                        'parameters' => array(
                            'cinema' => array(
                                'location' => 'uri',
                                'description' => 'The cinema to retrieve details about.',
                                'required' => true
                            )
                        )
                    ),
                    'cinemaevents' => array(
                        'uri' => 'cinemas/{cinema}/events',
                        'httpMethod' => 'GET',
                        'responseModel' => 'getResponse',
                        'parameters' => array(
                            'cinema' => array(
                                'location' => 'uri',
                                'description' => 'The cinema to retrieve event details about.',
                                'required' => true
                            )
                        )
                    ),
//                    'events' => array(
//                        'uri' => 'events',
//                        'httpMethod' => 'GET',
//                        'responseModel' => 'getResponse',
//                        'parameters' => array()
//                    ),
                    'event' => array(
                        'uri' => 'events/{event}',
                        'httpMethod' => 'GET',
                        'responseModel' => 'getResponse',
                        'parameters' => array(
                            'event' => array(
                                'location' => 'uri',
                                'description' => 'The event to retrieve details about.',
                                'required' => true
                            )
                        )
                    ),
                    'films' => array(
                        'uri' => 'films',
                        'httpMethod' => 'GET',
                        'responseModel' => 'getResponse',
                        'parameters' => array()
                    ),
                    'film' => array(
                        'uri' => 'films/{film}',
                        'httpMethod' => 'GET',
                        'responseModel' => 'getResponse',
                        'parameters' => array(
                            'film' => array(
                                'location' => 'uri',
                                'description' => 'The film to retrieve details about.',
                                'required' => true
                            )
                        )
                    ),
                    'filmevents' => array(
                        'uri' => 'films/{film}/events',
                        'httpMethod' => 'GET',
                        'responseModel' => 'getResponse',
                        'parameters' => array(
                            'film' => array(
                                'location' => 'uri',
                                'description' => 'The film to retrieve event details about.',
                                'required' => true
                            )
                        )
                    )
                ),
                'models' => array(
                    'getResponse' => array(
                        'type' => 'object',
                        'properties' => array(
                            'statusCode' => array(
                                'location' => 'statusCode'
                            )
                        ),
                        'additionalProperties' => array(
                            'location' => 'json'
                        )
                    )
                )
            )
        );
    }
}