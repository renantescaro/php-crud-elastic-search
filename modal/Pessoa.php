<?php

class Pessoa{
    private static $url = 'http://localhost:9200/catalogo/pessoas/';

    public static function get($busca=null){
        if(empty($busca)){
            return self::getTodos();
        }
        return self::getPorBusca($busca);
    }

    private static function getTodos(){
        $http = new Http(self::$url.'_search','GET');
        $pessoas = json_decode($http->retorno);
        return isset($pessoas->hits->hits) ? $pessoas->hits->hits : null;
    }

    private static function getPorBusca($busca){
        $http = new Http(self::$url.'_search?q=','GET',$busca);
        $pessoas = json_decode($http->retorno);
        return isset($pessoas->hits->hits) ? $pessoas->hits->hits : null;
    }
}