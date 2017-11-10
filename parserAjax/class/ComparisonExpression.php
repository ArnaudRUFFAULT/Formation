<?php
class ComparisonExpression extends Expression
{
	const COMP_EQU = 0;
    const COMP_INF = 1;
    const COMP_SUP = 2;
    const COMP_INF_EQU = 3;
    const COMP_SUP_EQU = 4;

    private $m_comparison;
    private $m_left;
    private $m_right;
    
    //$comparison is one of the constants
    public function __construct($comparison, Expression $left, Expression $right)
    {
        if(!($comparison >= self::COMP_EQU && $comparison <= self::COMP_SUP_EQU))
        {
            throw new Exception('Unknown comparison type ' . $comparison, 500);
        }
        $this->m_comparison = $comparison;
        $this->m_left = $left;
        $this->m_right = $right;
    }

    public function Evaluate()
    {
    	return $this->Compare() ? 1 : 0;
    }
    
    private function Compare()
    {
        $leftVal = $this->m_left->Evaluate();
        $rightVal = $this->m_right->Evaluate();

        switch($this->m_comparison)
        {
        case self::COMP_EQU:
                return $leftVal == $rightVal;
        case self::COMP_SUP:
                return $leftVal > $rightVal;
        case self::COMP_INF:
                return $leftVal < $rightVal;
        case self::COMP_SUP_EQU:
                return $leftVal >= $rightVal;
        case self::COMP_INF_EQU:
                return $leftVal <= $rightVal;
        }
    }

    public static function GetCompType($symbol)
    {
        $result = 0;
        switch($symbol)
        {
        case '>=':
            ++$result;
        case '<=':
            ++$result;
        case '>':
            ++$result;
        case '<':
            ++$result;
        case '=':
            return $result;

        default:
            return false;
        }
    }
}