<?php
switch($_GET['action']){
    case('getdata'):
        //exit( "http://api.pse.tools/api/stock/v2/".$_GET['symbol'] );
        //step1
        $cSession = curl_init(); 
        //step2
        $url = "http://api.pse.tools/api/stock/v2/".$_GET['symbol'].'?ts='.time();
        curl_setopt($cSession,CURLOPT_URL,$url);
        curl_setopt($cSession,CURLOPT_HEADER, 0);
        curl_setopt($cSession,CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
        curl_setopt($cSession,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($cSession,CURLOPT_FRESH_CONNECT, 1);
        
        //step3
        $result=curl_exec($cSession);
        //step4
        curl_close($cSession);
        //step5
        //echo $result;
        
        $test = json_decode($result);
        //$test = getTargets($test);
        //echo json_encode($test);
        
        $stock = new Stock($test, 20000);
        echo json_encode($stock);
        //var_dump($test);
        //echo "<pre>",print_r($stock);
        
        //$homepage = file_get_contents($url);
        //$homepage = json_decode($homepage);
        //echo "<pre>",print_r($homepage);
    break;
    default:
        echo "Invalid Request";
}


class Stock
{
    function __construct($dataObj, $bp=0)
    {
        if( is_object($dataObj) ){
            foreach($dataObj as $fld => $val){
                $this->{$fld} = $val;
            }
        }
        
        $this->setBuyPower($bp);
        $this->getBoardLot();
        $this->getMaxShares();
        $this->getCostToBuy();
        $this->getTargetGain();
    }
    
    private function setBuyPower($bp)
    {
        if(isset($bp)){
            $this->buypower = !empty($bp)? $bp*1:0; 
        }
        
    }
    
    private function getBoardLot()
    {
        switch($this->last){
            case($this->last>=0.0001 && $this->last<=0.0099):
                $this->boardlot = 1000000*1; break;
            case($this->last>=0.0100 && $this->last<=0.0490):
                $this->boardlot = 100000*1; break;
            case($this->last>=0.0500 && $this->last<=0.4950):
                $this->boardlot = 10000*1; break;
            case($this->last>=0.5000 && $this->last<=4.9900):
                $this->boardlot = 1000*1; break;
            case($this->last>=5.0000 && $this->last<=49.9500):
                $this->boardlot = 100*1; break;
            case($this->last>=50.0000 && $this->last<=999.5000):
                $blot = 10*1; break;
            case$this->boardlot($this->last>=1000.0000):
                $this->boardlot = 5*1; break;
            default:
                $this->boardlot = 'Invalid'; break;
        }
    }
    
    
    
    private function getMaxShares()
    {   
        $tmpCost = $tmpBlot = $fCostm = $fStock = $ctr = 0;
        while($tmpCost<=$this->buypower){
            $tmpCost+= $this->last*$this->boardlot;
            $tmpBlot+= ($this->boardlot)*1;
            if($tmpCost<=$this->buypower){
                $this->gross = $tmpCost;
                $this->shares = $tmpBlot;
                //$this->gross.' - '.$this->shares;
            }
            $ctr++;
        }
    }
    
    private function getCostToBuy()
    {
        //buy commission
        $this->buy_comm = $this->gross*0.0025;
        $this->buy_comm = ($this->buy_comm>=20)? 20 : $this->buy_comm;
        
        //buy vat
        $this->buy_vat = sprintf("%01.2f", ($this->buy_comm*12)/100);
        
        //buy transac fee
        $this->buy_transfee = sprintf("%01.2f", $this->gross*0.00005);
        
        //sccp
        $this->buy_sccp = sprintf("%01.2f", $this->gross*0.0001);
        
        //total buy charge
        $this->buy_charge = $this->buy_comm + $this->buy_vat + $this->buy_transfee + $this->buy_sccp;
        $this->buy_percent_gross = sprintf("%01.2f", ($this->buy_charge/$this->gross)*100);
        
        $this->average_price = sprintf("%01.2f", ($this->gross+$this->buy_charge)/$shares);
        $this->average_cost = sprintf("%01.2f", ($this->gross+$this->buy_charge));
    }
    
    public function getTargetGain($arrPrice=array())
    {
        if( empty($arrPrice) ){
            $arrPrice[] = $this->high;
            $arrPrice[] = $this->yearhigh;
        }
        
        foreach($arrPrice as $i => $price)
        {
            //Gross Transaction Amount
            $gross = $this->shares * $price;
            
            //Less: Broker’s Commission 
            $comm = $gross*0.0025;
            $comm = ($comm>=20)? 20 : $comm;
            
            //Less: VAT on Broker’s Commission:
            $vat = sprintf("%01.2f", ($comm*12)/100);
            
            //Less:SCCP Fee
            $sccp = sprintf("%01.2f", $gross*0.0001);
            
            //Less: PSE Transaction Fee
            $transfee = sprintf("%01.2f", $gross*0.00005);
            
            //Less: Stock Transaction Tax
            $transtax = sprintf("%01.2f", $gross*0.005);
            
            $this->sell[$i]['price'] = sprintf("%01.2f", $price);
            $this->sell[$i]['sellcost'] = (((($gross-$comm)-$vat)-$sccp)-$transfee)-$transtax;
            $this->sell[$i]['sellgain'] = sprintf("%01.2f", $this->sell[$i]['sellcost']-$this->average_cost);
            
        }
    }
}

function getBoardLot($price){
    //$price = isset($_GET['price'])? str_replace('-', '.', $_GET['price']) : 
    //var formatter = new Intl.NumberFormat('en-US');
    switch($price){
        case($price>=0.0001 && $price<=0.0099):
            $blot = 1000000*1;
            break;
        case($price>=0.0100 && $price<=0.0490):
            $blot = 100000*1;
            break;
        case($price>=0.0500 && $price<=0.4950):
            $blot = 10000*1;
            break;
        case($price>=0.5000 && $price<=4.9900):
            $blot = 1000*1;
            break;
        case($price>=5.0000 && $price<=49.9500):
            $blot = 100*1;
            break;
        case($price>=50.0000 && $price<=999.5000):
            $blot = 10*1;
            break;
        case($price>=1000.0000):
            $blot = 5*1;
            break;
        default:
            $blot = 'Invalid';
            break;
    }
    return $blot;
}

function getTargets($symObjData)
{
    $bp = 20000;
    $symObjData->boardlot = getBoardLot($symObjData->last);
    
    //share cost
    $shareCost = getPriceCost($symObjData->last, $symObjData->boardlot, $bp);
    $symObjData->shares = $shareCost['shares'];
    $symObjData->gross = $shareCost['gross'];
    $tmpAvg = getAvg($symObjData->last, $symObjData->shares);
    
    /*
    if(isset($tmpAvg['avgPrice'])){
        $symObjData->averageprice = $tmpAvg['avgPrice'];
    }
    
    if(isset($tmpAvg['avgCost'])){
        $symObjData->averagecost = $tmpAvg['avgCost'];
    }*/
    
    foreach($tmpAvg as $key => $value){
        $symObjData->{$key} = $value;
    }
    $symObjData->bid_ask = [];
    
    /*
    //target 1
    $shareCost = getPriceCost($symObjData->high, $symObjData->boardlot, $bp);
    $symObjData->target1 = $symObjData->high;
    $tmpGain = $symObjData->cost - $shareCost['cost'];
    $symObjData->gain1 = sprintf("%01.4f", $tmpGain1);
    
    //target 1
    $shareCost = getPriceCost($symObjData->average, $symObjData->boardlot, $bp);
    $symObjData->target2 = $symObjData->average;
    $tmpGain = $symObjData->cost - $shareCost['cost'];
    $symObjData->gain2 = sprintf("%01.4f", $tmpGain);
    */
    return $symObjData;
}

function getAvg($price, $shares){
    $ret = array();
    if( isset($price) && isset($shares) ){
        $gross = ($price*$shares);
        $ret['commission'] = $gross*0.0025;
        $ret['commission'] = ($ret['commission']>=20)? 20 : $ret['commission'];
        $ret['vat'] = sprintf("%01.2f", ($ret['commission']*12)/100);
        $ret['transacfee'] = sprintf("%01.2f", $gross*0.00005);
        $ret['sccp'] = sprintf("%01.2f", $gross*0.0001);
        
        $ret['total_charge'] =  $ret['commission']+$ret['vat']+$ret['transacfee']+$ret['sccp'];
        $ret['percent_of_gross'] = sprintf("%01.2f", ($ret['total_charge']/$gross)*100);
        $ret['average_price'] = sprintf("%01.2f", ($gross+$ret['total_charge'])/$shares);
        $ret['average_cost'] = sprintf("%01.2f", ($gross+$ret['total_charge']));
        
        //sell
        $ret['transactax'] = sprintf("%01.2f", $gross*0.005);
        
        
    }
    return $ret;
}

function getPriceCost($price, $blot, $bp, $isAvg=false){  
    //========================================================================
    //commission = ((price*shares)*0.0025)<20 ? 20 : (price*shares)*0.0025;
    //commission = (price*shares)*0.0025;
    //commission = (commission<20)? 20 : commission;
    
    //sccp = (price*shares)*0.0001;
    
    //buyCharge = sum(commission+sccp);
    //$avgPrice = price+(buyCharge/shares);
    //========================================================================
    
    //========================================================================
    //transacFee = (price*shares)*0.00005;
    //avgCost = (shares*avgPrice)-(transacFee/shares);
    
    //========================================================================
    
    $tmpCost = $tmpBlot = $fCostm = $fStock = $ctr = 0;
    while($tmpCost<=$bp){
        $tmpCost+= $price*$blot;
        $tmpBlot+= ($blot)*1;
        if($tmpCost<=$bp){
            
            $fCost = $tmpCost;
            $fStock = $tmpBlot;
            //echo $ctr.'. '.$fCost.' - '.$fStock.'<br>';
            //console.log(ctr+'cost :'+tmpCost+' blot'+tmpBlot);
        }
        $ctr++;
    }
    return array('gross'=>$fCost, 'shares'=>$fStock);
}

?>