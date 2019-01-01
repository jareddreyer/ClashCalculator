<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Clash royale card level calculator
 * ===================================
 * user must input number of cards, type of card, 
 * and what level it currently is at.
 * 
 */
class cardLevelCalculator 
{
	public static $cardTypesLevels;

	public function __construct()
	{
		include_once "levels.php"; //include file holding all card levels		
	}

	/**
	 * main calculation method
	 * =========================================
	 * @param [array] self::$$arrayCardLevels - list of card type levels and card values 	
	 * @param [string] $cardType = type of card, e.g. rare, common, etc
	 * @param [string] $cardTypeLevels = level of your card currently.
	 * @param [string] $cards = current amount of cards you have.
	 * 
	 * @return [array] - level and remaining cards left over
	 *
	 */
	public static function cardLevel ($cardType, $cards, $cardTypeLevel) 
	{
		//var_dump('card details: '. $cardType . '/ ' . $cards. '/ ' . $cardTypeLevel);
		
		$arrayCardLevels = self::cardTypeLevels($cardType);		
			
			$cloneArray = $arrayCardLevels;

			foreach($arrayCardLevels as $key => $value)
			{
				if($key == $cardTypeLevel)
			    	break;

				unset($cloneArray[$key]);
			} 
//var_dump($cloneArray);
$removed = self::array_shift_associative($cloneArray);
var_dump($removed);
	

				
//var_dump($cloneArray);
				foreach ($cloneArray as $key => $val)
				{	
					$cards = $cards - $val;
						
					if($cards >= 0)
					{
						return [$key=>$cards];
							
					} else {
						break;
					}

				}	

			
			
			
		
		
	}

	/**
	 * returns shift array with keys preserved
	 * @param array $arr array variable name
	 * @return array
	 */
	public static function array_shift_associative(&$arr){
	    reset($arr);
	    $return = array(key($arr)=>current($arr));
	    unset($arr[key($arr)]);
	    return $return; 
	}

	/**
	 * returns back the keys (levels) of selected card type
	 * @param string
	 * @return array
	 */
	public static function cardTypeLevels ($cardType) 
	{		
		//get array by values		
		$variableArrayName = 'cardTypesLevels['.$cardType.']';
		$arrayName  = substr($variableArrayName,0,strpos($variableArrayName,'['));
		$arrCardLevels = self::${$arrayName}[$cardType];

		return $arrCardLevels;
	}

}

//main object call
$cards = new cardLevelCalculator();

//check if ajax request
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	//check if calling for card type levels
	if(isset( $_POST['cardType'] ) && isset( $_POST['cardCount'] ) == null && isset( $_POST['cardTypeLevels'] ) == null ) {

		foreach ($cards::cardTypeLevels($_POST['cardType']) as $key => $value) {
			if($key != 13)
			 echo '<option value="'.$key.'">Level '.$key . '</option>';
		}

	} else {
		//else this is a ajax request and make the calculation!
		$newCardLevel = $cards::cardLevel($_POST['cardType'], $_POST['cardCount'], $_POST['cardTypeLevels']);
		$key = key($newCardLevel);
		echo "level ". $key . ", ";
		echo $newCardLevel[$key] . " cards left over ";
	}	
} 


  

