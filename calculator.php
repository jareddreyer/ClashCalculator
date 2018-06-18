<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class cardLevelCalculator 
{
	public static $common, $rare, $epic, $legendary, $cardTypes;

	public function __construct()
	{
		include_once "levels.php"; //get card levels		
	}
	
	public static function cardLevel ($cardType, $cards, $cardTypeLevels) 
	{	
		/**
		* Definition of variables
		* =========================================
		* @var <array> self::$$arrayCardLevels - list of card type levels and card values 	
		* @param $cardType <string> = type of card, e.g. rare, common, etc
		* @param $cardTypeLevels <string> = level of your card currently.
		* @param $cards = current amount of cards you have.
		* @return <string> - level
		*
		*/

		$arrayCardLevels = self::cardTypeArrays($cardType, $cards);		
		self::$$arrayCardLevels = array_slice(self::$$arrayCardLevels, $cardTypeLevels-1, null, true); //start from specific card level.
		
		foreach (self::$$arrayCardLevels as $key => $val)
		{	
			$cards = $cards - $val;
			
			if($cards >= 0)
			{
				$cardArrTmp = array($key=>$cards);		
			} else {
				break;
			}

		}
				
		return $cardArrTmp;
		
	}

	/**
	* returns back the keys (levels) of selected card type
	* @param $cardType <string>
	*
	*/
	public static function getCardTypeLevels ($cardType)
	{
		$cardTypeLevels = self::cardTypeArrays($cardType);

		return $cardTypeLevels;
		
	}

	public static function cardTypeArrays ($cardType) {
		/*
		 * Definition of variables
		 * =========================================
		 * $cardType = type of card, e.g. rare, common, etc
		 * $cardlevel = level of your card currently.
		 * $cards = current amount of cards you have.
		 * $cardlevelCount = how many cards you need to upgrade
		*/

		//get array by values		
		$cardTypeKey = array_search($cardType, self::$cardTypes);
		
		$variableArrayName = 'cardTypes['.$cardTypeKey.']';

		$arrayName  = substr($variableArrayName,0,strpos($variableArrayName,'['));
		$arrayIndex = preg_replace('/[^\d\s]/', '',$variableArrayName);
				
		$arrCardLevels = self::${$arrayName}[$arrayIndex];

		return $arrCardLevels;
	}
}

$cards = new cardLevelCalculator();

if(isset( $_POST['cardType'] ) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{

	$cardTypeLevels = $cards::getCardTypeLevels($_POST['cardType']);

	foreach ($cards::$$cardTypeLevels as $key => $value) {
		echo '<option value="'.$key.'">Level '.$key . '</option>';
	}
} else {
	$newCardLevel =  $cards::cardLevel($_POST['cardType'], $_POST['cardCount'], $_POST['cardTypeLevels']);
	$key = key($newCardLevel);
	echo "level ". $key . ", \n";
	echo $newCardLevel[$key] . " cards left over ";
}


  

