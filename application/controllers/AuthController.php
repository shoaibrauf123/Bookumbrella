<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        echo 'AuthController';
	}

public function token(){

        $jwt = new JWT();
        $jwtsecretkey = "mysecretwordshere";

        $data = array(

             'user_id'=>10,
            'email' => 'hassan@gmail.com',
            'user_type' => 'seller',



        );

        $token = $jwt->encode($data, $jwtsecretkey, 'HS2S6');
        echo $token;
}


public function decode_token(){

        $token = $this->uri->segment(3);

    $jwt = new JWT();
    $jwtsecretkey = "mysecretwordshere";

    $decoded_token = $jwt->decode($token, $jwtsecretkey, 'HS2S6');
    echo $token;


        echo '<pre>';
        print_r($decoded_token);


        $token1 = $jwt->jsonEncode($decoded_token);
        echo $token1;

}


}
