<?php


namespace app\components;

use yii\base\BaseObject;
use yii\httpclient\Client;

class FnsApiComponent extends BaseObject
{
    public $baseUrl;
    public function checkSelfemployed($inn, \DateTime $requestDate)
    {
        $client = new Client([
            'baseUrl' => $this->baseUrl,
            'requestConfig' => [
                'format' => Client::FORMAT_JSON
            ],
            'responseConfig' => [
                'format' => Client::FORMAT_JSON
            ],
        ]);

        $response = $client->post('taxpayer_status', ['inn' => $inn, 'requestDate' => $requestDate->format('Y-m-d')])->send();

        return $response->data;

    }
}