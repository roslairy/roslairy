<?php
namespace App;
use GuzzleHttp\Client;

class BaiduPusher{

    protected $urls;

    public function __construct(){
        $this->urls = [];
    }

    public function addUrl($url){
        $this->urls[] = $url;
    }

    public function push(){
        $body = "";
        foreach ($this->urls as $url){
            $body .= $url;
            $body .= "\n";
        }

        $client = new Client([
                'base_uri' => 'http://data.zz.baidu.com/urls?site=www.roslairy.me&token=sF4GM37UyICbZ98F',
                'timeout'  => 5.0,
        ]);
        $response = $client->request('POST', '/urls', [
            'body' => $body,
            'query' => "site=www.roslairy.me&token=sF4GM37UyICbZ98F"
        ]);

        return $response;
    }
}
