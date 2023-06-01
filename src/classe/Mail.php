<?php

namespace App\classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = 'c78d81f3de6701f12d599d9e9ca40bd1';
    private $api_key_secret = '8de19066d0b4e83ff2580ef9ff2516fc';

    public function send($to_email, $to_name, $subject, $name, $firstname, $id, $email)
    {
        $mj = new Client($this->api_key, $this->api_key_secret,true,['version' => 'v3.1']);

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "timothee.p@divali.fr",
                        'Name' => "Stellantis"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name,
                        ]
                    ],
                    'TemplateID' => 4793251,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'name' => $name,
                        'firstname' => $firstname,
                        'id' => $id,
                        'email' => $email,
                    ]
                ]
            ]
        ];
        $mj->post(Resources::$Email, ['body' => $body]);

    }
    public function sendRe($to_email, $to_name, $subject, $name)
    {
        $mj = new Client($this->api_key, $this->api_key_secret,true,['version' => 'v3.1']);

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "timothee.p@divali.fr",
                        'Name' => "Stellantis"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name,
                        ]
                    ],
                    'TemplateID' => 4730572,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'name' => $name,
                    ]
                ]
            ]
        ];
        $mj->post(Resources::$Email, ['body' => $body]);

    }
}