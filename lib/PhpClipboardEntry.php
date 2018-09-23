<?php
/*
* BIBLIOTECA DE FORMULÁRIOS
*
* REPRESENTA UM CAMPO DE FORMULÁRIO DA BIBLIOTECA PhpClipboard
* 
*
* AUTOR: BRUNO MENDES PIMENTA
*/
namespace lib;
use model\DB;
class PhpClipboardEntry
{
    private $idCampo;
    private $label;
    private $tipo;
    private $opt;
    private $descricao;
    private $name;
    private $wrap;
    private $wrapAll;
    private $wrapInner;
    private $class;

    public function __construct($campo)
    {
        if ($this->checkIfParametersExistAndInject($campo)) {
            $nonNullPropertiesChecked = $this->verifyNotNullProperties();
        } else {
            throw new PhpClipboardException("2");
        }

        if (!$nonNullPropertiesChecked) {
            throw new PhpClipboardException("3");
        }

        $this->wrap      = array('start' => '', 'end' => '');
        $this->wrapAll   = array('start' => '', 'end' => '');
        $this->wrapInner = array('start' => '', 'end' => '');
        $this->class = array();

        return true;

    }

    public function __get($property)
    {
        $propertyOfClass = get_class_vars('/lib/PhpClipboardEntry');

        $propertyRestrict = array_search($property, $this->getRestrictProperties());
        $propertyExists = array_search($property, $propertyOfClass);

        if (!$propertyRestrict && $propertyExists) {
            return $this->$property;
        } else {
            throw new PhpClipboardException("4");
        }
    }

    private function wrapInsert($wrap, $propertyWrap)
    {
        if (!empty($wrap)) {
            $wrapArray = explode('><', $wrap);

            $this->$propertyWrap['start'] = $wrapArray[0].'>'.PHP_EOL;
            $this->$propertyWrap['end'] = '<'.$wrapArray[1].PHP_EOL;
        } else {
            throw new PhpClipboardException("5");
        }

        return true;
    }

    public function wrap($wrap)
    {
        return $this->wrapInsert($wrap, 'wrap');
    }

    public function wrapAll($wrap)
    {
        return $this->wrapInsert($wrap, 'wrapAll');
    }

    public function wrapInner($wrap)
    {
        return $this->wrapInsert($wrap, 'wrapInner');
    }
    
    public function setClass($class)
    {
        $this->class[] = $class;
        return $this;
    }

    public function show()
    {
        $entry = "";

        switch ($this->tipo) {

            case 'select':
                $entry = $this->select();            
            break;

            default:
                $entry = $this->input();
            break;
        }
        
        echo $entry;
    }

    public function label()
    {
        $label = "<label for='{$this->name}'>{$this->label}:</label>";

        echo $label;
    }

    private function input()
    {
        $class = "";
        if (!empty($this->class)) {
            $class = implode(' ', $this->class);
        }
        
        $entry = "<input name='{$this->name}' class='{$class}' type='{$this->tipo}'>";   

        return $entry;
    }

    private function select()
    {
        $db = DB::rescue();
        $optString = "";
        
        $opts = $db->execute($this->opt);
        if ($opts) {
            while ($opt = $opts->fetch_assoc()) {
                $optString .= <<< HEREDOC
                    {$this->wrapAll['start']}
                        "<option value='{$opt['value']}'>{$opt['label']}</option>"
                    {$this->wrapAll['end']}
HEREDOC;
            }
            
        } else {
            throw new PhpClipboardException("6");
        }
        
        $class = "";
        if (!empty($this->class)) {
            $class = implode(' ', $this->class);
        }
        
        $entry = <<< HEREDOC
            {$this->wrap['start']}
                <select name='{$this->name}' class='{$class}'>
                    {$this->wrapInner['start']}
                        {$optString}
                    {$this->wrapInner['end']}
                </select>
            {$this->wrap['end']}
HEREDOC;

        return $entry;
    }

    private function getRestrictProperties()
    {
        return
        $restrictProperties = array(
            "wrap",
            "wrapAll",
            "wrapInner"
        );
    }

    private function verifyNotNullProperties()
    {
        if (is_null($this->idCampo)) 
            return false;
        if (is_null($this->label))
            return false;
        if (is_null($this->tipo))
            return false;
        if (is_null($this->descricao))
            return false;
        if (is_null($this->name))
            return false;
        return true;
    }   
    
    private function properties($withPrivate = false)
    {
        $propertiesName = array();
        $reflector = new \ReflectionClass('\\lib\\PhpClipboardEntry');
        $properties = $reflector->getProperties();
        foreach ($properties as $property) {
            if ($property->isPrivate() && !$withPrivate) {
                    continue;
            }
            
            $propertiesName[] = $property->getName();
                
                
        }
        return $propertiesName;
    }
    
    public function checkIfParametersExistAndInject($campo)
    {
        $propertyOfClass = $this->properties(true);
        if (in_array("idCampo", $propertyOfClass)) {
            $this->idCampo = $campo['idCampo'];
        }
        if (in_array("label", $propertyOfClass)) {
            $this->label = $campo['label'];
        }
        if (in_array("tipo", $propertyOfClass)) { 
            $this->tipo = $campo['tipo'];
        }
        if (in_array("opt", $propertyOfClass)) {
            $this->opt = $campo['opt'];
        }
        if (in_array("descricao", $propertyOfClass)) {
            $this->descricao = $campo['descricao'];
        }
        if (in_array("name", $propertyOfClass)) {
            $this->name = $campo['name'];
        }

        return true;
    }


}