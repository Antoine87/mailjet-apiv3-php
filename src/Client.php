<?php

declare(strict_types=1);

namespace Mailjet;

class Client
{
    public const WRAPPER_VERSION = 'v2.0';

    private $apikey;
    private $apisecret;
    private $apitoken;


    //private $version = Config::MAIN_VERSION;
    //private $url = Config::MAIN_URL;
    //private $secure = Config::SECURED;
    private $call = true;
    private $settings = [];
    private $changed = false;

    private $smsResources = [
        'send',
        'sms',
        'sms-send'
    ];
    private $dataAction = [
        'csverror/text:csv',
        'csvdata/text:plain',
        'JSONError/application:json/LAST'
    ];

    public function __construct($key, $secret = false, $call = true, array $settings = [])
    {
        $this->setAuthentication($key, $secret, $call, $settings);
    }

    private function setAuthentication($key, $secret, $call, $settings)
    {
        $isBasicAuth = $this->isBasicAuthentication($key, $secret);
        if ($isBasicAuth) {
            $this->apikey = $key;
            $this->apisecret = $secret;
        } else {
            $this->apitoken = $key;
            // $this->version = Config::SMS_VERSION;
        }
//        $this->initSettings($call, $settings);
//        $this->setSettings();
    }

    private function call2($method, $resource, $action, $args)
    {
        $args = array_merge(
            [
                'id' => '',
                'actionid' => '',
                'filters' => [],
                'body' => $method == 'GET' ? null : '{}',
            ],
            array_change_key_case($args)
        );

//        $url = $this->buildURL($resource, $action, $args['id'], $args['actionid']);

        $contentType = ($action == 'csvdata/text:plain' || $action == 'csverror/text:csv')
            ? 'text/plain'
            : 'application/json';

        $isBasicAuth = $this->isBasicAuthentication($this->apikey, $this->apisecret);
        $auth = $isBasicAuth ? [$this->apikey, $this->apisecret] : [$this->apitoken];

//        $request = new Request(
//            $auth,
//            $method,
//            $args['filters'],
//            $args['body'],
//            $contentType
//        );
//        return $request->call($this->call);
    }

    private function getApiUrl()
    {
//        $h = $this->secure === true ? 'https' : 'http';
//        return sprintf('%s://%s/%s/', $h, $this->url, $this->version);
    }

    /**
     * Checks that both parameters are strings, which means
     * that basic authentication will be required
     *
     * @param string $key
     * @param string $secret
     *
     * @return boolean flag
     */
    private function isBasicAuthentication($key, $secret)
    {
        if (!empty($key) && !empty($secret)) {
            return true;
        }
        return false;
    }
}
