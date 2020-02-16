<?php

namespace Javleds\RedspiraApi;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Arr;
use Javleds\RedspiraApi\Contract\HttpClientInterface;
use Exception;
use Psr\Http\Message\ResponseInterface;

class HttpClient implements HttpClientInterface
{
    /** @var ClientInterface */
    protected $client;

    public function __construct(string $baseUrl)
    {
        $this->client = new Client([
            'base_uri' => $baseUrl,
        ]);
    }

    /**
     * @return array|string
     * @throws Exception
     */
    public function get(string $endpoint, array $params = [], array $options = [])
    {
        $response = $this->client->get($endpoint, $this->prepareData($params, $options));
        return $this->buildResponse($response);
    }

    /**
     * @return array|string
     * @throws Exception
     */
    public function post(string $endpoint, array $params = [], array $options = [])
    {
        $response = $this->client->post($endpoint, $this->prepareData($params, $options));
        return $this->buildResponse($response);
    }

    private function prepareData(array $params = [], array $options = []): array
    {
        $data = [];

        if (config('redspira.debug_requests', false)) {
            $data['debug'] = true;
        }

        if (Arr::get($options, 'content_type') === "json") {
            $data['json'] = $params;
        } else {
            $data['query'] = http_build_query($params);
        }

        return array_merge($data, $options);
    }

    /**
     * @return array|string
     * @throws Exception
     */
    private function buildResponse(ResponseInterface $response)
    {
        $contentType = $this->getContentType($response->getHeader('content-type'));
        switch ($contentType) {
            case 'application/json':
                return json_decode($response->getBody()->getContents());
            case 'text/plain; charset=UTF-8':
                $content = $response->getBody()->getContents();
                return json_decode(trim($content));
            default:
                return $response->getBody()->getContents();
        }
    }

    /**
     * @param array|string $contentType
     *
     * @return string
     * @throws Exception
     */
    private function getContentType($contentType)
    {
        if (is_string($contentType)) {
            return $contentType;
        }

        if (count($contentType) === 0) {
            throw new Exception(
                'The request does not have a valid content-type header'
            );
        }

        return $contentType[0];
    }
}