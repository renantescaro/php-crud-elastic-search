<?php

class Pessoa{
    private static $url = 'http://localhost:9200/catalogo/pessoas/';

    public static function get(string $busca=null, string $filtro=null){
        if(empty($busca)){
            return self::getTodos();
        }
        return self::getPorBusca($busca,$filtro);
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

    /**
     * responsavel por realizar buscas
     * @param  $busca  termo a ser buscado
     * @param  $filtro campo em que sera feito a busca
     * @return object pessoa do elastic
     */
    private static function getPorBusca(string $busca,string $filtro=null){

        $filtroBusca = $filtro == 'tudo' ? '' : $filtro.':';
        $urlBusca    = self::$url.'_search?q='.$filtroBusca;

        $http    = new Http($urlBusca,'GET',$busca);
        $pessoas = json_decode($http->retorno);
        return isset($pessoas->hits->hits) ? $pessoas->hits->hits : null;
    }

    /**
     * responsavel por inserir / atualizar registro
     * @param $pessoa array
     * @param $id passado em caso de atualização
     */
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