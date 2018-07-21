<?php
    namespace model;

    use config;

    class CRUD
    {
        private $query;
        //CLÁUSULAS
        private $where;
        private $groupBy;
        private $orderBy;
        private $join;
        
        public function __get($propriedade)
        {
            return $this->$propriedade;
        }
        
        private function __set($propriedade, $valor)
        {
            $this->$propriedade = $valor;
            
        }
        
        public static function build()
        {
            return new \model\CRUD();
            
        }
        
        public function coalesce($campo, $valorPadrao){
            
        }
        
        public function insert($tabela, $campos, $valores){
            if( is_array($campos) && is_array($valores) ){
                $strCampos = implode(',',$campos);
                
                array_walk_recursive($valores, function(&$v){
                    $v = "'{$v}'";
                });
                
                $strValores = implode(',',$valores);

                $this->query = "INSERT INTO {$tabela}({$strCampos}) VALUES({$strValores})";
            }else{
                throw new \Exception("Os parâmetros campos e valores devem ser arrays.");
            }
            
        }
        
        public function update($tabela, $campos, $valores){
            if( gettype($tabela) == 'string' && is_array($campos) && is_array($valores) && count($campos) == count($valores) ){
                for($i=0;$i<count($campos);$i++){
                    
                    if( $i == (count($campos) -1 ) ){
                        $strUpdate .= "{$campos[$i]} = {$valores[$i]} ";
                    }else{
                        $strUpdate .= "{$campos[$i]} = {$valores[$i]}, ";
                    }
                    
                }
                
                $this->query = "UPDATE {$tabela} SET {$strUpdate} ";
            }else{
                throw new \Exception("Parâmetro com tipo inválido encontrado.");
            }
        }
        public function select($tabela, $campos = '*'){
            if( gettype($tabela) == 'string' && (is_array($campos) || gettype($campos) == 'string' ) ){
                if( is_array($campos) ){
                    $strCampos = implode(',',$campos);    
                }else{
                    $strCampos = $campos;
                }
                
                $this->query = "SELECT {$strCampos} FROM {$tabela}";
                
            }else{
                throw new \Exception("Parâmetro com tipo inválido encontrado. Os parâmetros devem ser arrays.");
            }
            
        }
        public function where($tabela, $campo, $operador, $valor){
            if( gettype($valor) == 'string' && gettype($tabela) == 'string' && gettype($campo) == "string" ){
                if( count($this->where) >= 1 ){
                    $sql = " AND {$tabela}.{$campo} {$operador} {$valor}"; 
                }else{
                    $sql = " WHERE {$tabela}.{$campo} {$operador} {$valor}";    
                }
                $this->where[] = $sql;
            }else{
                throw new \Exception("Parâmetro com tipo inválido encontrado.");
            }
        }
        public function whereIn($tabela, $campo, $valores){
            if( is_array($valores) && gettype($tabela) == 'string' && gettype($campo) == "string" ){ 
                
                foreach( $valores as $valor ){
                    $strValores .= "'{$valor}', ";
                }
                
                $strValores = substr($strValores, 0, $strValores.length-2);
                
                if( count($this->whereIn) > 1 ){
                    $sql = "AND {$tabela}.{$campo} IN({$strValores})"; 
                }else{
                    $sql = "WHERE {$tabela}.{$campo} IN({$strValores})";    
                }
                $this->where[] = $sql;
            }else{
                throw new \Exception("Parâmetro com tipo inválido encontrado.");
            }
            
        }
        public function groupBy($tabela = null, $campo){
            if( gettype($campo) == 'string' ){
                if( $tabela == null ){
                    $sql = " GROUP BY {$campo}";    
                }else{
                    $sql = " GROUP BY {$tabela}.{$campo}";
                }
                
                $this->groupBy[] = $sql;    
            }else{
                throw new \Exception("O parâmetro campo deve ser uma string.");
            }
            
        }
        public function orderBy($tabela = null, $campo, $ordenacao = 'ASC'){
            if( gettype($campo == 'string') ){
                if( $tabela == null ){
                    $sql = " ORDER BY {$campo} {$ordenacao}";    
                }else{
                    $sql = " ORDER BY {$tabela}.{$campo} {$ordenacao}";
                }
                
                $this->orderBy[] = $sql;    
            }else{
                throw new \Exception("O parâmetro campo deve receber uma string.");
            }
            
        }
        public function innerJoin($tabela1, $campo1, $tabela2, $campo2){
            if( gettype($tabela1) == 'string' &&
                gettype($campo1) == 'string' &&
                gettype($tabela2) == 'string' && gettype($campo2) == 'string'  ){
                    
                $sql = "JOIN {$tabela1}
                        ON {$tabela1}.{$campo1} = {$tabela2}.{$campo2}";
                $this->join[] = $sql;
            }else{
                throw new \Exception("Parâmetro com tipo inválido encontrado.");
            }
            
            
        }
        public function outerJoin(){
            
        }
        public function leftJoin(){
            
        }
        public function naturalJoin(){
            
        }
        
        public function clear(){
            $this->query = "";
            $this->where = array();
            $this->groupBy = array();
            $this->orderBy = array();
            $this->join = array();
            return true;
        }
        
        public function sql(){
            if( $this->query ){
                $sql = "{$this->query} ";

                if( $this->join ){
                    $joins = "";
                    foreach( $this->join as $join ){
                        $joins = "{$join} ";
                    }

                    $sql .= $joins;
                }

                if( $this->where ){
                    $wheres = "";
                    foreach( $this->where as $where ){
                        $wheres .= "{$where }";
                    }

                    $sql .= $wheres;
                }

                if( $this->groupBy ){
                    $groupBys = "";
                    foreach( $this->groupBy as $groupBy ){
                        $groupBys = "{$groupBy} ";
                    }

                    $sql .= $groupBys;
                }

                if( $this->orderBy ){
                    $orderBys = "";
                    foreach( $this->orderBy as $orderBy ){
                        $orderBys = "{$orderBy} ";
                    }

                    $sql .= $orderBys;

                }
                return $sql;  
            }else{
                
                return false;
            }
            
            
        }
        
    }


?>