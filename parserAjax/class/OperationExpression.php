<?php
class OperationExpression extends Expression
{
    const OP_ADD = 0;
    const OP_SUB = 1;
    const OP_MUL = 2;
    const OP_DIV = 3;

    private $m_operation;
    private $m_left;
    private $m_right;
    
    //$operation is one of the constants
    public function __construct($operation, Expression $left, Expression $right)
    {
        if(!($operation >= self::OP_ADD && $operation <= self::OP_DIV))
        {
            throw new Exception('Unknown operation type ' . $operation, 500);
        }
        $this->m_operation = $operation;
        $this->m_left = $left;
        $this->m_right = $right;
    }
    
    public function Evaluate()
    {
        $leftVal = $this->m_left->Evaluate();
        $rightVal = $this->m_right->Evaluate();

        switch($this->m_operation)
        {
        case self::OP_ADD:
            return $leftVal + $rightVal;
        case self::OP_SUB:
            return $leftVal - $rightVal;
        case self::OP_MUL:
            return $leftVal * $rightVal;
        case self::OP_DIV:
            if($rightVal == 0)
            {
                throw new LogicException('Division by zero', 501);
            }
            return $leftVal / $rightVal;
        }
    }

    public static function GetOpType($symbol)
    {
        $result = 0;
        switch($symbol)
        {
        case '/':
            ++$result;
        case '*':
            ++$result;
        case '-':
            ++$result;
        case '+':
            return $result;

        default:
            return false;
        }
    }
}