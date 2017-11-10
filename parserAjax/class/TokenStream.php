<?php
class TokenStream
{
    private $m_tokens;
    
    public function __construct($source)
    {
        $this->BuildTokens($source);
    }

    /**
     * @return array('type'=>string[,'val'=>mixed]) (val depends on the type)
    **/
    public function GetToken($i)
    {
        return $this->m_tokens[$i];
    }

    //*/
    private function BuildTokens($source)
    {
    	$regex = '#\\s*((?:[1-9]\\d*|0)(?:\\.\\d+)?|\w[\\w\\d]*|<-|[<>]=?|[-+*/=;()]|$)#';
    	$pos = 0;
    	do
    	{
    		$matches = array();
    		if(preg_match($regex, $source, $matches, PREG_OFFSET_CAPTURE, $pos))
    		{
    			if($matches[0][1] != $pos)	//Not found at pos
    			{
    				throw new LexicalException('"' . substr($source, $pos, $matches[0][1]) . '" is not a token', 400);
    			}
    			$pos += strlen($matches[0][0]);	//Advance pos with the number of found characters
    			$this->m_tokens[] = $this->ReadToken($matches[1][0]);	//Only use the captured part (ignore spaces)
    		}
    		else
    		{
    			throw new LexicalException("No token found", 400);
    		}
    	} while($matches[0][0] !== '');	//Until EOF
    }

    private function ReadToken($tokenStr)
    {
    	if(ctype_digit($tokenStr))
    	{
    		return array('type'=>'num', 'val'=>$tokenStr);
    	}

    	if(ctype_alnum($tokenStr))
    	{
    		return array('type'=>'id', 'val'=>$tokenStr);
    	}

    	return array('type'=>$tokenStr === '' ? 'EOF' : $tokenStr);
    }
    /*/
    private function BuildTokens($source)
    {
        $this->m_tokens = array();
        if(strlen($source) == 0)
        {
            return;
        }

        $pos = 0;
        do
        {
            $token = $this->NextToken($source, $pos);
            $this->m_tokens[] = $token;
        } while($token['type'] != 'EOF');
    }

    private function NextToken($source, &$pos)
    {
        do
        {
            if($pos >= strlen($source))
            {
                return array('type'=>'EOF');
            }
            $char = $source[$pos++];
        } while (ctype_space($char));

        if(ctype_digit($char))
        {
            while($pos < strlen($source) && ctype_digit($source[$pos]))
            {
                $char .= $source[$pos++];
            }
            
            return array('type'=>'num', 'val'=>$char);
        }
        
        if (ctype_alpha($char))
        {
            while($pos < strlen($source) && ctype_alnum($source[$pos]))
            {
                $char .= $source[$pos++];
            }
            
            return array('type'=>'id', 'val'=>$char);
        }
        
        switch($char)
        {
        case '<':
            //Special case for affectation operator
            if($pos < strlen($source) && $source[$pos] == '-')
            {
                $pos++;
                return array('type'=>'<-');
            }
            //else act the same as below (no break)
        case '>':
            if($pos < strlen($source) && $source[$pos] == '=')
            {
                $pos++;
                $char .= '=';
            }
        case '=':
        case '+':
        case '-':
        case '*':
        case '/':
        case '(':
        case ')':
        case ';':
            //These tokens are their own type
            return array('type'=>$char);

        default:
            throw new LexicalException('Unknown token : ' . $char, 400);
        }
    }
    //*/
}