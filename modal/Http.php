<?php

//set_time_limit(500);

class Http{
    public $retorno;
    public $code;

    function __construct(string $url,string $metodo='GET',$parametros=null,$ssl=true){
        $ch = curl_init();

        switch($metodo){
            case 'POST':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                break;
            case 'PUT':
                curl_setopt($ch, CURLOPT_POSTFIELDS, $parametros);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($parametros)]
                );
                break;
            case 'GET':
                $url .= $parametros != null ? curl_escape($ch,$parametros) : '';
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        }

        // define a url
        curl_setopt($ch, CURLOPT_URL, $url);

        // -F Definir corpo, como multipart/form-data:
        if(!empty($parametros) && $metodo!='GET'){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $parametros);
        }

        // -u
        // Definir o usuário/senha do HTTP Basic Authentication:
        // curl_setopt($ch, CURLOPT_USERPWD, 'username'.':'.'senha');

        if($ssl==false){
            // -k
            // Desligar a verificação do TLS (não é recomendado usar isto para FALSE!):
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        $this->retorno = curl_exec($ch);
        $this->code    = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    }
}