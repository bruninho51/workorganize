<?php
    namespace model;

    use \model\DB;

    abstract class AbstractModel
    {
        
        protected $DB;
        
        protected function __construct(){
            $this->DB = DB::rescue();
            
        }
        
        public function select($campos = '*'){
            $this->DB->select($this->tabela, $campos);
        }
        public function update($campos, $valores){
            $this->DB->update($this->tabela, $campos, $valores);
        }
        public function insert($campos, $valores){
            $this->DB->insert($this->tabela, $campos, $valores);
        }
        public function where($campo, $operador, $valor){
            $this->DB->where($this->tabela, $campo, $operador, $valor);
        }
        public function whereIn($campo, $valores){
            $this->DB->whereIn($this->tabela, $campo, $valores);
        }
        public function clear(){
            $this->DB->clear();
        }
        public function groupBy($campo){
            $this->DB->groupBy(null, $campo);
        }
        public function orderBy($campo, $ordenacao = "ASC"){
            $this->DB->orderBy(null, $campo, $ordenacao);
        }
        public function sql(){
            return $this->DB->sql();
        }
        
        public function execute($sql = false){
            return $this->DB->execute($sql);
        }
        
    }
    
?>