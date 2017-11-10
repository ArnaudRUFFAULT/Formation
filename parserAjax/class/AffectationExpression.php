<?php
//Une affection a la même valeur que la valeur affectée. (C'est ce qui permet de chainer a = b = c = d = 42)
class AffectationExpression extends Expression
{
    private $m_varName;
    private $m_val;
    
    public function __construct($varName, Expression $val)
    {
        $this->m_varName = $varName;
        $this->m_val = $val;
    }
    
    public function Evaluate()
    {
        $val = $this->m_val->Evaluate();
        
        Variables::set($this->m_varName, $val);
        return $val;
    }
}