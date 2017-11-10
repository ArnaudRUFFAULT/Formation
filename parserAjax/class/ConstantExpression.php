<?php
class ConstantExpression extends Expression
{
    private $m_val;
    
    public function __construct($val)
    {
        $this->m_val = $val;
    }
    
    public function Evaluate()
    {
        return $this->m_val;
    }
}