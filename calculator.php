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
	
	public static function cardLevel ($cardType, $cards) 
	{	
	
		//$cardCountKey = array_search($cards, $$arrCardType); //not used yet
		$arrayCardLevels = self::cardTypeArrays($cardType, $cards);

		foreach (self::$$arrayCardLevels as $key => $val)
		{
			if (($val - $cards) <= 0) $cardArrTmp = array($key=>$val); 
		}
		
		end($cardArrTmp);
		$newCardLevel = key($cardArrTmp);
				
		return $newCardLevel;
		
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
}

//echo $cards::cardLevel($_POST['cardType'], $_POST['cardCount']);
  

