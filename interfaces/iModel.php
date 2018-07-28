<?php
    namespace interfaces;

    interface iModel
    {  
        public function select($campos = '*');
        public function update($campos, $valores);
        public function insert($campos, $valores);
        //public function delete();
        public function where($campo, $operador, $valor);
        public function whereTable($tabela, $campo, $operador, $valor);
        public function whereIn($campo, $valores);
        public function clear();
        public function groupBy($campo);
        public function orderBy($campo, $ordenacao = "ASC");
        public function sql();
        public function execute();
        
        
    }
