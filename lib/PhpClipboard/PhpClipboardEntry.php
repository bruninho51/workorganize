<?php
/*
* BIBLIOTECA DE FORMULÁRIOS
*
* REPRESENTA UM CAMPO DE FORMULÁRIO DA BIBLIOTECA PhpClipboard
* 
*
* AUTOR: BRUNO MENDES PIMENTA
*/
namespace lib\PhpClipboard;
use model\DB;
use lib\Call;
class PhpClipboardEntry
{
    private $idCampo;
    private $idHTML;
    private $label;
    private $tipo;
    private $opt;
    private $descricao;
    private $name;
    private $wrap;
    private $wrapAll;
    private $wrapInner;
    private $class;
    private $attrPerson;
    private $js;

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
        $this->js = array();
        $this->attrPerson = array();

        foreach ($this->getTypeEntries() as $entry) {
            $this->class[$entry] = array();
        }

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
    
    public function setClass($class, $types)
    {
        $idx = array_search($types, $this->tipo);
        if ($idx != -1) {
            $this->class[$this->tipo][] = $class;
        }

        return $this;
        
    }

    private function injectMultipleSelectConfigDefault($config, $returnJson = false)
    {
        if (!isset($config["selectAllText"])) {
            $config["selectAllText"] = "Selecionar Todos";
        }
        if (!isset($config["allSelected"])) {
            $config["allSelected"] = "Todos selecionados";
        }
        if (!isset($config["noMatchesFound"])) {
            $config["noMatchesFound"] = "Nenhuma equivalência encontrada";
        }
        if (!isset($config["countSelected"])) {
            $config["countSelected"] = "# de % selecionado";
        }
        $retorno = array(
            $config
        );
        if ($returnJson) {
            $retorno = json_encode($retorno);
            //Remove os colchetes do json
            $retorno = substr_replace($retorno,"",-1,1);
            $retorno = substr_replace($retorno,"",0,1);
        }
        return $retorno;

    }

    public function multipleSelect($config = false)
    {
        if ($this->type = 'select') {
            $this->addAttr("multiple", "multiple");
            if (!is_array($config)) {
                $config = array();
            }
            $config = $this->injectMultipleSelectConfigDefault($config,true);
            $jsMultipleSelect = "<script>$('#{$this->idHTML}').multipleSelect({$config});</script>".PHP_EOL;
            
            $this->js[] = $jsMultipleSelect;
            
        }

        return $this;
        
    }

    public function addAttr($keyAttr, $valueAttr)
    {
        $attr = $keyAttr."=\"".$valueAttr."\"";
        $this->attrPerson[] = $attr;
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
        $label = false;
        if ($this->tipo != 'hidden') {
            $label = "<label for='{$this->name}'>{$this->label}:</label>";
        }
       
        echo $label;
    }

    private function input()
    {
        $class = "";
        if (!empty($this->class)) {
            $class = implode(' ', $this->class[$this->tipo]);
        }
        
        $entry = "<input name='{$this->name}' class='{$class}' id='{$this->idHTML}' type='{$this->tipo}'>";

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
                        <option value='{$opt['value']}'>{$opt['label'] }</option>
                    {$this->wrapAll['end']}
HEREDOC;
            }
            
        } else {
            throw new PhpClipboardException("6");
        }
        
        $class = "";
        if (!empty($this->class)) {
            $class = implode(' ', $this->class[$this->tipo]);
        }

        if (!empty($this->attrPerson)) {
            $attrPerson = implode(' ', $this->attrPerson);
        }

        if (!empty($this->js)) {
            $js = implode('', $this->js);
        }
        
        $entry = <<< HEREDOC
            {$this->wrap['start']}
                <select name='{$this->name}' id='{$this->idHTML}' class='{$class}' $attrPerson>
                    {$this->wrapInner['start']}
                        {$optString}
                    {$this->wrapInner['end']}
                </select>
                {$js}
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
        $reflector = new \ReflectionClass('\\lib\\PhpClipboard\\PhpClipboardEntry');
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
        if (in_array("idHTML", $propertyOfClass)) {
            $this->idHTML = $campo['idHTML'];
        }

        return true;
    }

    private function getTypeEntries()
    {
        $typeEntries = array(
            "text",            "select",          "password",        "button",
            "checkbox",        "date",            "number",          "radio",
            "email",           "file",            "hidden",          "url",
            "time",            "week",            "color",           "datetime",
            "datetime-local",  "image",           "month",           "range",
            "reset",           "tel",
            "submit",
            "textarea"
        );

        return $typeEntries;
    }


}