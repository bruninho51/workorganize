<?php
    namespace interfaces;

    interface iModel
    {
        private $table;
        private $campos;
        protected $DB;
        
        public function select($campos = '*');
        public function update();
        public function insert();
        //public function delete();
        public function where($campo, $operador, $valor);
        public function whereIn($campo, $valores);
        public function clear();
        public function groupBy($campo);
        public function orderBy($campo, $ordenacao = "ASC");
        public function sql();
        public function execute();
        
        
    }



?>