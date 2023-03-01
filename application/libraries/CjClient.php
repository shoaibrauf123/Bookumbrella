<?php

class CjClient {
    public $domain = "https://%s.api.cj.com/%s/%s";

    /**
     * Curl handle
     *
     * @var resource
     */
    protected $curl;

    /**
     * API Key for authenticating requests
     *
     * @var string
     */
    protected $api_key;

    /**
     * The Commission Junction API CjClient is completely self contained with it's own API key.
     * The cURL resource used for the actual querying can be overidden in the contstructor for
     * testing or performance tweaks, or via the setCurl() method.
     *
     * @param string $api_key API Key
     * @param null|resource $curl Manually provided cURL handle
     */
    public function __construct($api_key, $curl = null) {
        $this->api_key = $api_key;
        if ($curl) $this->setCurl($curl);
    }

    public function test(){
        return 'client working fine';
    }
    
    /**
     * Convenience method to access Product Catalog Search Service
     * 
     * @param array $parameters GET request parameters to be appended to the url
     * @return array Commission Junction API response, converted to a PHP array
     * @throws Exception on cURL failure or http status code greater than or equal to 400
     */
    public function productSearch(array $parameters = array()) {
        return $this->api("product-search", "product-search", $parameters);
    }
    
    /**
     * Convenience method to access Link Search Service
     * 
     * @param array $parameters GET request parameters to be appended to the url
     * @return array Commission Junction API response, converted to a PHP array
     * @throws Exception on cURL failure or http status code greater than or equal to 400
     */
    public function linkSearch(array $parameters = array()) {
        return $this->api("linksearch", "link-search", $parameters);
    }
    
    /**
     * Convenience method to access Publisher Lookup Service
     * 
     * @param array $parameters GET request parameters to be appended to the url
     * @return array Commission Junction API response, converted to a PHP array
     * @throws Exception on cURL failure or http status code greater than or equal to 400
     */
    public function publisherLookup(array $parameters = array()) {
        return $this->api("publisher-lookup", "joined-publisher-lookup", $parameters);
    }
    
    /**
     * Convenience method to access Commission Detail Service
     * 
     * @param array $parameters GET request parameters to be appended to the url
     * @return array Commission Junction API response, converted to a PHP array
     * @throws Exception on cURL failure or http status code greater than or equal to 400
     */
    private function commissionDetailLookup(array $parameters = array()) {
        throw new Exception("Not implemented");
    }
    
    /**
     * Convenience method to access Advertiser Lookup
     * 
     * @param array $parameters GET request parameters to be appended to the url
     * @return array Commission Junction API response, converted to a PHP array
     * @throws Exception on cURL failure or http status code greater than or equal to 400
     */
    public function advertiserLookup(array $parameters = array()) {
        return $this->api("advertiser-lookup", "joined-publisher-lookup", $parameters, 'v3');
    }
    
    /**
     * Convenience method to access Support Services
     * 
     * @param string $resource The specific support service resource (e.g. 'languages')
     * @param array $parameters GET request parameters to be appended to the url
     * @return array Commission Junction API response, converted to a PHP array
     * @throws Exception on cURL failure or http status code greater than or equal to 400
     */
    public function supportLookup($resource, array $parameters = array()) {
        return $this->api("support-services", $resource, $parameters);
    }

    /**
     * Generic method to fire API requests at Commission Junctions servers
     * 
     * @param string $subdomain The subomdain portion of the REST API url
     * @param string $resource The resource portion of the REST API url (e.g. /v2/RESOURCE)
     * @param array $parameters GET request parameters to be appended to the url
     * @param string $version The version portion of the REST API url, defaults to v2
     * @return array Commission Junction API response, converted to a PHP array
     * @throws Exception on cURL failure or http status code greater than or equal to 400
     */
    public function api($subdomain, $resource, array $parameters = array(), $version = 'v2') {
        $ch = $this->getCurl();
        $url = sprintf($this->domain, $subdomain, $version, $resource);
        
        if (!empty($parameters))
            $url .= "?" . http_build_query($parameters);

        curl_setopt_array($ch, array(
            CURLOPT_URL  => $url,
            CURLOPT_HTTPHEADER => array(
                'Accept: application/xml',
                'Authorization: ' . $this->api_key,
            )
        ));

        $body = curl_exec($ch);

        $errno = curl_errno($ch);
        if ($errno !== 0) {
            throw new Exception(sprintf("Error connecting to CommissionJunction: [%s] %s", $errno, curl_error($ch)), $errno);
        }
        
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_status >= 400) {
            throw new Exception(sprintf("CommissionJunction Error [%s] %s", $http_status, strip_tags($body)), $http_status);
        }
        
        return json_decode(json_encode((array)simplexml_load_string($body)), true);
    }

    /**
     * @param resource $curl
     */
    public function setCurl($curl) {
        $this->curl = $curl;
    }

    /**
     * @return resource
     */
    public function getCurl() {
        if (!is_resource($this->curl)) {
            $this->curl = curl_init();

//            // Default
//            curl_setopt_array($this->curl, array(
//                CURLOPT_SSL_VERIFYPEER => false,
//                CURLOPT_SSL_VERIFYHOST => 2,
//                CURLOPT_FOLLOWLOCATION => false,
//                CURLOPT_MAXREDIRS      => 1,
//                CURLOPT_RETURNTRANSFER => true,
//                CURLOPT_CONNECTTIMEOUT => 10,
//                CURLOPT_TIMEOUT        => 30,
//            ));

            // Customized
            curl_setopt_array($this->curl, array(
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_MAXREDIRS      => 1,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CONNECTTIMEOUT => 0,
                CURLOPT_TIMEOUT        => 0,
            ));
        }

        return $this->curl;
    }

}