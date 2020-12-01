<?php

class Pessoa{
    private static $url = 'http://localhost:9200/catalogo/pessoas/';

    public static function get(string $busca=null){
        if(empty($busca)){
            return self::getTodos();
        }
        return self::getPorBusca($busca);
    }

    public static function getPorId(string $id){
        $http   = new Http(self::$url.$id,'GET');
        $pessoa = json_decode($http->retorno);
        return $pessoa;
    }

    private static function getTodos(){
        $http    = new Http(self::$url.'_search','GET');
        $pessoas = json_decode($http->retorno);
        return isset($pessoas->hits->hits) ? $pessoas->hits->hits : null;
    }

    private static function getPorBusca($busca){
        $http    = new Http(self::$url.'_search?q=','GET',$busca);
        $pessoas = json_decode($http->retorno);
        return isset($pessoas->hits->hits) ? $pessoas->hits->hits : null;
    }

    public static function salvar(array $pessoa, $id=null){
        $tipo = 'POST';
        $url  = self::$url;
        if(!empty($id)){
            $tipo = 'PUT';
            $url  = self::$url.'/'.$id;
        }
        $http = new Http($url,$tipo,json_encode($pessoa));
        return $http->retorno;
    }
}