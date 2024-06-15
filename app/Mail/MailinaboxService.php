<?php

namespace App\Mail;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class MailinaboxService
{
    protected $client;
    protected $baseUri;
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->baseUri = env('MAILINABOX_BASE_URI', 'https://mail.hadathah.org');
        $this->username = env('MAILINABOX_USERNAME', 'admin-app@hadathah.org');
        $this->password = env('MAILINABOX_PASSWORD', 'Askar@1984');

        $this->client = new Client([
            'base_uri' => $this->baseUri,
            'auth' => [$this->username, $this->password],
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);
    }

    public function addUser($email, $password)
    {
        try {
            $response = $this->client->post('/admin/mail/users/add', [
                'form_params' => [
                    'email' => $email,
                    'password' => $password
                ]
            ]);

            return $response->getStatusCode() === 200;
        } catch (RequestException $e) {
            // Handle error
            return false;
        }
    }
}