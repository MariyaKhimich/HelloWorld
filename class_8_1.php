<?php
class Appartment
{
    private $count_of_room;
	private $square;
	private $flat;
	public $count_of_tenants;//количество жильцов
	private $count_of_balcony;
	private $type_of_heating;	
	private $heating_counter;//показания счетчика тепла
	private $rate_of_heating_m;//тариф на тепло c м2
	private $rate_of_heating_gc;//тариф на тепло за гигакаллорию
	private $rate_of_electricity;//тариф на электроенергию
	private $rate_of_cold_water;//тариф на холодную воду
	private $rate_of_hot_water;//тариф на горячую воду
	private $electricity_counter;//показания электросчетчика
	public $bill_heating;//счет за тепло
	public $bill_electricity;//счет за электроенергию
	public $bill_cold_water;//счет за холодную воду
	public $bill_hot_water;//счет за горячую воду
	public $bill;//общий счет
	
	function Appartment($cor, $s, $fl, $cot,
	$cob, $toh, $hc ,$roht,
	$rohgc, $roe, $rocw, $roww, 
	$ec) {
		$this->count_of_room=$cor;//1
		$this->square=$s;//2
		$this->flat=$fl;//3
		$this->count_of_tenants=$cot;//4
		$this->count_of_balcony=$cob;//5
		$this->type_of_heating=$toh;//6
		$this->heating_counter=$hc;//7
		$this->rate_of_heating_m=$roht;//8
		$this->rate_of_heating_gc=$rohgc;//9
		$this->rate_of_electricity=$roe;//10
		$this->rate_of_cold_water=$rocw;//11
		$this->rate_of_hot_water=$roww;//12
		$this->electricity_counter=$ec;//13
		$this->set_bill_heating();
		$this->set_bill_electricity();
		$this->set_bill_cold_water();
		$this->set_bill_hot_water();
		$this->set_bill();
		
		
		
	}
	
	public function set_bill_heating() {
		if ($this->type_of_heating=="tariff") 
		$this->bill_heating=$this->square*$this->rate_of_heating_m;
		
		
		else if ($this->type_of_heating=="counter")
		$this->bill_heating=$this->heating_counter*$this->rate_of_heating_gc;
	}
	
	public function get_bill_heating() {
		return $this->bill_heating;
		
	}
	
	public function set_bill_electricity() {
		$this->bill_electricity=$this->electricity_counter*$this->rate_of_electricity;	
	}
	
	public function get_bill_electricity() {
		return $this->bill_electricity;
	}
	
	public function set_bill_cold_water() {
		$this->bill_cold_water=$this->count_of_tenants*$this->rate_of_cold_water;
		
	}
	
	public function get_bill_cold_water() {
		return $this->bill_cold_water;
	}
	
	public function set_bill_hot_water() {
		$this->bill_hot_water=$this->count_of_tenants*$this->rate_of_hot_water;
	}
	
	public function get_bill_hot_water() {
		return $this->bill_hot_water;
	}
	
	public function set_bill() {
		$this->bill=$this->bill_heating+$this->bill_electricity+$this->bill_cold_water+$this->bill_hot_water;		
	}
	
	public function get_bill() {
		return $this->bill;
	}
	
	public function increase_tenant() {
		$this->count_of_tenants++;
	}
	
	public function reduce_tenant() {
		$this->count_of_tenants--;
	}
	
	public function get_count_of_tenants() {
		return $this->count_of_tenants;
	}
	
	public function get_information() {
		return $this->count_of_room."<br>".$this->square."<br>".$this->flat."<br>".$this->count_of_tenants
		."<br>".$this->count_of_balcony."<br>".
		$this->type_of_heating."<br>";	
	}
}
class House{
	public $house;
	public $bill_sum;
	private $count_of_flats;
	private $count_of_entrances;
	private $norm_electricity_on_flat;
	public $bill_electricity;
	public $square_prehouse;
	private $norm_of_tax;
	public $tax;
	
	
	function __construct($a,$b,$c,$d,$e){
		$this->count_of_flats=$a;
		$this->count_of_entrances=$b;
		$this->norm_electricity_on_flat=$c;
		$this->get_bill_electricity_on_entrances();
		$this->square_prehouse=$d;
		$this->norm_of_tax=$e;
		$this->get_tax();
		$this->get_information();
		$this->get_bill_sum();
		
	}
	
	public function set_house($m) {
	$this->house[]=$m;
	$this->get_bill_sum();
	}
	
	public function get_house() {
	static $s="";
	for ($i=0;$i<(count($this->house));$i++)
	{
	$s.=$this->house[$i]->get_information()." ";
	}
	return $s;
	}
	
	public function get_bill_sum() {
	$this->bill_sum=0;
		for ($i=0;$i<count($this->house); $i++)
		{
		$this->bill_sum+=$this->house[$i]->get_bill();
		}
	return $this->bill_sum;
	}
	
	public function get_bill_electricity_on_entrances() {
		$this->bill_electricity=0;
		$this->bill_electricity=$this->norm_electricity_on_flat*$this->count_of_entrances*$this->count_of_flats;
	return $this->bill_electricity;
	}
	
	public function get_tax() {
		$this->tax=0;
		$this->tax=$this->square_prehouse*$this->norm_of_tax;
	return $this->tax;
	}
	
	
	public function get_information() {
		return "<br><span>Appartments : </span><br>".$this->get_house()."<br><span>The sum of utilities : </span>".$this->bill_sum.
		"<br><span>Count of flats : </span>".$this->count_of_flats."<br><span>Count_of_entrances : </span>".$this->count_of_entrances
		."<br><span>electricity bill from house : </span>".$this->bill_electricity."
		<br><span>Tax : </span>".$this->tax;	
	}
	
}
class Street{
	public $street;
	private $name;
	private $length;
	private $start;
	private $end;
	private $all_sq;
	private $norm_yardman;
	private $count_of_yardman;
	private $bill_all;
	
	function __construct($a,$b,$c,$d,$e){
		$this->norm_yardman=$a;
		$this->name=$b;
		$this->length=$c;
		$this->start=$d;
		$this->end=$e;
	}
	
	public function set_street($h) {
	$this->street[]=$h;
	$this->get_count_of_yardman();
	$this->get_bill_all();
	}
	
	public function get_count_of_yardman() {
		$this->count_of_yardman=0;
		
		for ($i=0;$i<count($this->street); $i++)
		{
		$this->all_sq+=$this->street[$i]->square_prehouse;
		}
		$this->count_of_yardman=ceil(($this->all_sq)/($this->norm_yardman));
	return $this->count_of_yardman;
	}
	
    public function get_bill_all() {
		$this->bill_all=0;
		
		for ($i=0;$i<count($this->street); $i++)
		{
		$this->bill_all+=$this->street[$i]->bill_sum;
		}
		
	return $this->bill_all;
	}
	public function get_street() {
	static $s="";
	for ($i=0;$i<(count($this->street));$i++)
	{
	$s.=$this->street[$i]->get_information()." ";
	}
	return $s;
	}
	
	public function get_information() {
		return "<br><span>Houses : </span><br>".$this->get_street()."<br><br><br><span>The name of street : </span>".$this->name.
		"<br><span>Length of street : </span>".$this->length."<br><span>The coordinates of start : </span>".$this->start
		."<br><span>The coordinates of end : </span>".$this->end."
		<br><span>Count_of_yardman : </span>".$this->count_of_yardman."
		<br><span>All payments from street : </span>".$this->bill_all;	
	}
}
class Town{
	public $town;
	private $name;
	private $year_of_appearance;
	private $parallel;
	private $meridian;
	public $budget;
	public $population;
	
	function __construct($a,$b,$c,$d){
		$this->name=$a;
		$this->year_of_appearance=$b;
		$this->parallel=$c;
		$this->meridian=$d;
	}
	
	public function set_town($m) {
		$this->town[]=$m;
		$this->get_budget();
		$this->get_population();
	}
	
	public function get_budget(){
		$this->budget=0;
		
		for ($i=0;$i<count($this->town); $i++)
		for ($j=0;$j<count($this->town[$i]->street); $j++)
		$this->budget+=$this->town[$i]->street[$j]->tax;
		
		return $this->budget;
	}
	
	public function get_population(){
		$this->population=0;
		
		for ($i=0;$i<count($this->town); $i++)
		
		for ($j=0;$j<count($this->town[$i]->street); $j++)
		
		for ($k=0;$k<count($this->town[$i]->street[$j]->house); $k++)
		
		$this->population+=$this->town[$i]->street[$j]->house[$k]->count_of_tenants;
		
		return $this->population;
	
	}
	public function get_town() {
	static $s="";
	for ($i=0;$i<(count($this->town));$i++)
	{
	$s.=$this->town[$i]->get_information()." ";
	}
	return $s;
	}
	
	public function get_information() {
		return "<br><br><br><span>The name of town : </span>".$this->name."<br><span>Streets : </span><br>".$this->get_town().
		"<br><br><br><span>Year of appearance : </span>".$this->year_of_appearance."<br><span>The parallel of town : </span>".$this->parallel
		."<br><span>The meridian of town : </span>".$this->meridian."
		<br><span>The budget : </span>".$this->budget."
		<br><span>The population : </span>".$this->population;	
	}
}
?>
