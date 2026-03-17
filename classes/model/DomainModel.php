<?php
    class DomainModel{
        private $key = '072dee999ac1a7931c205814c97cb1f4d1261559c0f6cd15f2a7b27701954b8d';
        private $url = 'https://api.internship.mintyconnect.nl';

        public function searchDomains($domains): array{
            $url = $this->url.'/domains/search';
            $context_options = array (
                'http' => array (
                    "header" => [
                    "Authorization: Basic " . $this->key,
                    "Content-Type: application/json"
                ],
                "method" => "POST",
                "content" => json_encode($domains)
                )
            );

            $context = stream_context_create($context_options);
            $response = file_get_contents($url, false, $context);
            return json_decode($response, true);
        }
    }
?>