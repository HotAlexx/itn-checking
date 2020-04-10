<?php


namespace app\components;

use yii\base\BaseObject;
use yii\httpclient\Client;

class FnsApiComponent extends BaseObject
{
    public $baseUrl;
    public function checkSelfemployed($itnCode)
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

        $response = $client->post('taxpayer_status', ['inn' => "556862479879", 'requestDate' => "2020-01-01"])->send();
        return $response->data;

    }
}