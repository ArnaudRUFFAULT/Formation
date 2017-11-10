<?php
class VariableExpression extends Expression
{
    private $m_varName;
    
    public function __construct($varName)
    {
        $this->m_varName = $varName;
    }
    
    public function Evaluate()
    {
        return Variables::get($this->m_varName);
    }
}