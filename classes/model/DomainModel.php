<?php
    class DomainModel{
        public function searchDomains($domains): array{
            $url = 'https://api.internship.mintyconnect.nl/domains/search';
            $key = 'Authorization: Basic 072dee999ac1a7931c205814c97cb1f4d1261559c0f6cd15f2a7b27701954b8d';
            $context_options = array (
                'http' => array (
                    'method' => 'POST',
                    'header'=> $key."\r\n"."Content-type: application/json\r\n",
                    'content' => json_encode($domains) //API only accepts JSON, hence why the encoding a PHP array into valid JSON

                )
            );

            $context = stream_context_create($context_options);
            $response = file_get_contents($url, false, $context);
            return json_decode($response, true); //Decoding JSON back into valid PHP so we can play with it again
        }
    }
?>