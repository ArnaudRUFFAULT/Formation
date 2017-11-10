<?php
class SyntaxParser
{
	private $m_stream;


	public function __construct(TokenStream $stream)
	{
		$this->m_stream = $stream;
	}

	/*	GRAMMAR RULES
	*/

	public function Generate()
	{
		$tree = $this->Input(0);
		if(!is_array($tree))
		{
			throw new SyntaxException("Syntax Error : " . $tree, 400);
		}

		return $tree;
	}

	/*
	Input:	Statement ';' Input
			Statement 'EOF'
	*/
	private function Input($i)
	{
		$statements = array();
		$offset = 0;
		do
		{
			$res = $this->Statement($i + $offset);
			if($res['offset'] == -1)
			{
				return $res['error'];
			}
			$offset += $res['offset'];
			$statements[] = $res['branch'];

			$tokenType = $this->m_stream->GetToken($i + $offset++)['type'];
		}
		while($tokenType == ';');

		if($tokenType != 'EOF')
		{
			return 'Unexpected token : "' . $tokenType . '" expected End of File or ";" instead';
		}

		return $statements;
	}

	/*
	Statement:	Expression '<'|'>'|'=' Expression
				Expression
	*/
	private function Statement($i)
	{
		$ret = $this->Expression($i);
		if($ret['offset'] == -1)
		{
			return $ret;
		}

		$tokenType = $this->m_stream->GetToken($i + $ret['offset'])['type'];
		if($tokenType !== '>' && $tokenType !== '<' && $tokenType !== '<=' && $tokenType !== '>=' && $tokenType !== '=')
		{
			return $ret;
		}

		$compType = ComparisonExpression::GetCompType($tokenType);
		$second = $this->Expression($i + $ret['offset'] + 1);
		if($second['offset'] == -1)
		{
			return $ret;
		}

		$ret = array('offset' => $ret['offset'] + $second['offset'] + 1, 'branch' => new ComparisonExpression($compType, $ret['branch'], $second['branch']));

		return $ret;
	}

	/*
	Expression:	Affectation
				Calculus
	*/
	private function Expression($i)
	{
		$ret = $this->Affectation($i);
		if($ret['offset'] != -1)
		{
			return $ret;
		}

		return $this->Calculus($i);
	}

	/*
	Calculus:	Calculus '+'|'-' Product
				Product
	*/
	private function Calculus($i)
	{
		$ret = $this->Product($i);
		if($ret['offset'] == -1)
		{
			return $ret;
		}

		while(($tokenType = $this->m_stream->GetToken($i + $ret['offset'])['type']) == '+' || $tokenType == '-')
		{
			$second = $this->Product($i + $ret['offset'] + 1);
			if($second['offset'] == -1)
			{
				break;
			}
			$ret = array('offset' => $ret['offset'] + $second['offset'] + 1,
				'branch' => new OperationExpression(OperationExpression::GetOpType($tokenType), $ret['branch'], $second['branch']));
		}

		return $ret;
	}

	/*
	Product:	Product '*'|'/' Atom
				Atom
	*/
	private function Product($i)
	{
		$ret = $this->Atom($i);
		if($ret['offset'] == -1)
		{
			return $ret;
		}

		while(($tokenType = $this->m_stream->GetToken($i + $ret['offset'])['type']) == '*' || $tokenType == '/')
		{
			$second = $this->Atom($i + $ret['offset'] + 1);
			if($second['offset'] == -1)
			{
				break;
			}
			$ret = array('offset' => $ret['offset'] + $second['offset'] + 1,
				'branch' => new OperationExpression(OperationExpression::GetOpType($tokenType), $ret['branch'], $second['branch']));
		}

		return $ret;
	}

	/*
	Atom:	'('Expression')'
			<Variable>
			<Constant>
	*/
	private function Atom($i)
	{
		$token = $this->m_stream->GetToken($i);
		switch ($token['type'])
		{
		case 'id':
			return array('offset' => 1, 'branch' => new VariableExpression($token['val']));
		case 'num':
			return array('offset' => 1, 'branch' => new ConstantExpression($token['val']));
		case '(':
			$ret = $this->Expression($i + 1);
			if($ret['offset'] == -1)
			{
				return $ret;
			}
			if(($tokenType = $this->m_stream->GetToken($i + 1 + $ret['offset'])['type']) != ')')
			{
				return array('offset' => -1, 'error' => 'Unexpected token "' . $tokenType . '" expected ")"');
			}
			$ret['offset'] += 2;	//Parenthesis
			return $ret;
			
		default:
			return array('offset' => -1, 'error' => 'Unexpected token "' . $token['type'] . '" expected a value');
			break;
		}
	}

	/*
	Affectation:	<Variable> '<-' Expression
	*/
	private function Affectation($i)
	{
		$var = $this->m_stream->GetToken($i);
		$operator = $this->m_stream->GetToken($i + 1);
		if($var['type'] != 'id' || $operator['type'] != '<-')
		{
			return array('offset' => -1, 'error' => 'Affectation should be in the form myVar <- (expression)');
		}

		$ret = $this->Expression($i + 2);
		if($ret['offset'] == -1)
		{
			return $ret;
		}

		return array('offset' => 2 + $ret['offset'], 'branch' => new AffectationExpression($var['val'], $ret['branch']));
	}
}