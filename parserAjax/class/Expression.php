<?php
abstract class Expression
{
    //Returns the expression's value (numeric). May have side effects
    public abstract function Evaluate();
}