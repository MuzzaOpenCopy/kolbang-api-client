<?php
/** force commit */
use MuzzaOpenCopy\KolbangApi\KolbangApi;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Subscriber\Mock;

class KolbangTest extends PHPUnit_Framework_TestCase {

    /**
     * @var string Test base URL.
     */
    const BASE_URL = 'http://kolbang.app/api/v1/';

    /**#@+
     * @var string A valid film id.
     */
    const VALID_FILMID = 1;
    /**#@-*/

    /**
     * @var string A valid cinema id.
     */
    const VALID_CINEMAID = 1;

    /**
     * @var string A valid event id.
     */
    const VALID_EVENTID = 1;

    /**
     * @varMuzzaOpenCopy\KolbangApi\KolbangApi The ClientFactory.
     */
    protected $clientFactory;

    /**
     * @var GuzzleHttp\Command\Guzzle\GuzzleClient A client, created by the factory.
     */
    protected $client;

    /**
     * Set up.
     */
    public function setUp()
    {
        $responseArray = [];

        $this->clientFactory = new KolbangApi();
        $this->client = $this->clientFactory->create(self::BASE_URL);

        $mockResponse = new \GuzzleHttp\Subscriber\Mock([
            new GuzzleHttp\Message\Response(200, [], GuzzleHttp\Stream\Stream::factory(json_encode($responseArray)))
        ]);
        $guzzle = $this->client->getHttpClient();
        $guzzle->getEmitter()->attach($mockResponse);
    }

    /** @test */
    public function factory_create_method_returns_instanceOf_client()
    {
        $this->assertInstanceOf('GuzzleHttp\Command\Guzzle\GuzzleClient', $this->client);
    }

        /**
         * testClientHasCommand
         *
         * @param string $commandName The command name.
         * @param array $commandArguments The command arguments.
         *
         * @dataProvider getCommandNamesWithArguments
         */
        public function testClientHasCommand($commandName, array $commandArguments)
    {
        $response = $this->client->$commandName($commandArguments);

        $this->assertEquals(200, $response['statusCode']);
    }

        /**
         * Get an array of command names with arguments.
         *
         * @return array An array, each element an array containing a command name and its arguments.
         */
        public function getCommandNamesWithArguments()
    {
        return array(
            array('cinema', array('cinema' => self::VALID_CINEMAID)),
            array('cinemas', array()),
            array('cinemaevents', array('cinema' => self::VALID_CINEMAID)),
            //array('events', array()),
            array('event', array('event' => self::VALID_EVENTID)),
            array('films', array()),
            array('film', array('film' => self::VALID_FILMID)),
            array('filmevents', array('film' => self::VALID_FILMID))
        );
    }

}