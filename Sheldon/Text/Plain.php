<?php
/**
 *@Author Sheldon Kemper
 *@Copyright Sheldon Kemper 2013
 *
 *@File A less simple approch to the typical Hello World 
 *     
 */
namespace Sheldon\Text;

class Plain {

protected $word = '';//The word will be stored here.
private $regularExp = '/^([A-Za-z0-9!?\.,\s]+ ?)*$/'; //Match letters from a alphabet.
public $match=array();


	/**
	 *@Method setWord.
	 *@Param $what:String.
	 *@Return NULL.
	 */
	public function setWord ($text) {
	  if (is_string($text)) {
	    $this->word = $text;
	  }else {
	    throw new Exception ('Not a sting.');
	  };
	}
	
	/**
	 *@Method getWord
	 *@Param NULL
	 *@Return unvalidated word.
	 *
	 */
	public function getWord () {
	  return $this->word;
	}
	public function getValidWord() {
		return $this->validate();
	}
	

	
	/**
	 *TODO
	 */
	private function sanitise () {
	  //@TODO
	}
	
	/**
	 *@Comment Params are optional if passed to setWord method.
	 *@Method private validate.
	 *@Param optional regEx:RegExp, word:String.
	 *@Return match:String.
	 */
	private function validate ($regEx=null, $word=null) {
		$regEx=($regEx==null?$this->regularExp:$regEx);
		$word=($word==null?$this->word:$word);

	  if (preg_match($regEx, $word,$this->match)) {
	  	return $this->match[0];
    
	  } else {
        throw new Exception ('Not valid alphabet.');
	  }
	}
	
}//End Class


