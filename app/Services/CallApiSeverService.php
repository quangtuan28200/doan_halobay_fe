<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7;


class CallApiSeverService
{
    // const BASE_URL = "http://103.183.112.72:8085/";
    const BASE_URL = "http://localhost:8085/";
    // const BASE_URL = "http://103.81.87.23:8085/";

    public static function methodGet($url, $data = null, $token = null)
    {
        $url = self::BASE_URL . $url;
        $headers = [
            'Accept' => 'application/json',
        ];
        if ($token != null) {
            $headers['Authorization'] = 'Bearer ' . $token;
        }
        try {
            $client = new Client();
            $res = $client->get($url, [
                'headers' => $headers,
                'form_params' => $data
            ]);
            $data = json_decode($res->getBody());
            return $data;
        } catch (\Exception $e) {
            return $e->getCode();
        }
    }

    public static function methodPostParam($url, $data, $token = null)
    {
        $url = self::BASE_URL . $url;
        $headers = [
            'Accept' => 'application/json',
            //'Content-Type' => 'multipart/form-data',
        ];
        if ($token != null) {
            $headers['Authorization'] = 'Bearer ' . $token;
        }
        try {
            $client = new Client();
            $res = $client->post($url, [
                'headers' => $headers,
                'form_params' => $data
            ]);
            //$data = json_decode($res->getBody());
            $result = json_decode($res->getBody());
            $data = (object) [
                'status' => $res->getStatusCode(),
                'data' => $result
            ];
            return $data;
        } catch (\Exception $e) {
            $data = json_decode($e->getResponse()->getBody());
            $error = [
                'status' => $data->status,
                'message' => $data->title
            ];
            return $error;
        }
    }

    public static function methodPostJson($url, $data, $token = null)
    {
        $url = self::BASE_URL . $url;
        $headers = [
            'Accept' => 'application/json',
        ];
        if ($token != null) {
            $headers['Authorization'] = 'Bearer ' . $token;
        }
        try {
            $client = new Client();
            $res = $client->post($url, [
                'headers' => $headers,
                'json' => $data
            ]);
            $result = json_decode($res->getBody());
            $data = (object) [
                'status' => $res->getStatusCode(),
                'data' => $result
            ];
            return $data;
        } catch (\Exception $e) {
            $data = json_decode($e->getResponse()->getBody());
            $error = (object) [
                'status' => $data->status,
                'message' => $data->title
            ];
            return $error;
        }
    }

    public static function methodPut($url, $data, $token = null)
    {
        $url = self::BASE_URL . $url;
        if ($token != null) {
            $headers['Authorization'] = 'Bearer ' . $token;
        }
        try {
            $client = new Client();
            $res = $client->put($url, [
                'multipart' => $data
            ]);
            //$data = json_decode($res->getBody());
            $result = json_decode($res->getBody());
            $data = (object) [
                'status' => $res->getStatusCode(),
                'data' => $result
            ];
            return $data;
        } catch (\Exception $e) {
            $data = json_decode($e->getResponse()->getBody());
            $error = (object) [
                'status' => $data->status,
                'message' => $data->title,
                'data' => $data
            ];
            return $error;
        }
    }

    public static function methodPutJson($url, $data, $token = null)
    {
        $url = self::BASE_URL . $url;
        $headers = [
            'Accept' => 'application/json',
        ];
        if ($token != null) {
            $headers['Authorization'] = 'Bearer ' . $token;
        }
        try {
            $client = new Client();
            $res = $client->put($url, [
                'headers' => $headers,
                'json' => $data
            ]);
            //$data = json_decode($res->getBody());
            $result = json_decode($res->getBody());
            $data = (object) [
                'status' => $res->getStatusCode(),
                'data' => $result
            ];
            return $data;
        } catch (\Exception $e) {
            $data = json_decode($e->getResponse()->getBody());
            $error = (object) [
                'status' => $data->status,
                'message' => $data->title,
                'data' => $data
            ];
            return $error;
        }
    }
}
