<?php

class PostReview extends MBaseAction {

    public function call($parameters){

        if( isset($_POST['Review']) ){

            $review = new Review();
            $review->isNewModel();
            $review->setAttributes($_POST['Review']);

            $errors = [];
            if( !isset($_POST['Review']['rating']) )
                array_push($errors, 'rating');

            if( !isset($_POST['Review']['email']) )
                array_push($errors, 'email');

            if( !isset($_POST['g-recaptcha-response']) || !$this->checkCaptcha($_POST['g-recaptcha-response']) )
                array_push($errors, 'recaptcha');

            if( count($errors) > 0 )
                exit(json_encode([
                    'errors' => $errors
                ]));

            else if( $review->save())
                exit(json_encode('success'));
        }
    }


    public function checkCaptcha($response){
        $data = [
            'secret'    => '6LcHWTUUAAAAAPrs5Zg985JBgvqF2_BRg_86qkKu',
            'response'  => $response,
            'remoteip'  => $_SERVER['REMOTE_ADDR']
        ];

        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?".http_build_query($data));
        $obj = json_decode($response);

        return $obj->success;
    }


    public function setupAPIRequest($url, $jsonData = []){

        $headers = [
            'Content-Type: application/json',
            'Accept: application/json'
        ];

        $ch = curl_init($url);

        $jsonDataEncoded = json_encode($jsonData);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

        // Pass TRUE or 1 if you want to wait for and catch the response against the request made
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        return $ch;

    }

}