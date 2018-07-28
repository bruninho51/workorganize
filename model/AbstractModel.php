<?php
    namespace model;

    use \model\DB;

    abstract class AbstractModel implements \interfaces\iModel
    {
        
        protected $DB;
        protected $CRUD;
        protected $tabela;
        
        protected function __construct(){
            $this->DB = DB::rescue();
            $this->CRUD = new CRUD();
            
        }
        
        public function select($campos = '*'){
            $this->CRUD->select($this->tabela, $campos);
        }
        public function update($campos, $valores){
            $this->CRUD->update($this->tabela, $campos, $valores);
        }
        public function insert($campos, $valores){
            $this->CRUD->insert($this->tabela, $campos, $valores);
        }
        public function where($campo, $operador, $valor){
            $this->CRUD->where($this->tabela, $campo, $operador, $valor);
        }
        public function whereTable($tabela, $campo, $operador, $valor){
            $this->CRUD->where($tabela, $campo, $operador, $valor);
        }
        public function whereIn($campo, $valores){
            $this->CRUD->whereIn($this->tabela, $campo, $valores);
        }
        public function clear(){
            $this->CRUD->clear();
        }
        public function groupBy($campo){
            $this->CRUD->groupBy(null, $campo);
        }
        public function orderBy($campo, $ordenacao = "ASC"){
            $this->CRUD->orderBy(null, $campo, $ordenacao);
        }
        public function sql(){
            return $this->CRUD->sql();
        }
        
        public function execute($sql = false){
            if( $sql && gettype($sql) === 'string' ){
                return $this->DB->execute($sql);
                
            }else{ //$sql vale falso
                return $this->DB->execute($this->CRUD);
            }
            
        }
        
        public function innerJoin($tabela1, $campo1, $tabela2, $campo2)
        {
            $this->CRUD->innerJoin($tabela1, $campo1, $tabela2, $campo2);
        }
        
    }
    
?>