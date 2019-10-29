<?php /** @noinspection PhpComposerExtensionStubsInspection */


namespace App\DataAccess;


class DataCurl
{
        public function requestUrl($url) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_HEADER => false,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_SSL_VERIFYPEER => false,
                )
            );

            $response = curl_exec($curl);

            $err = curl_error($curl);

            curl_close($curl);

            return $response;
        }
}