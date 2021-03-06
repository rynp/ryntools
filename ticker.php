<?php
function gz_get_contents($path){
    $file = @gzopen($path, 'rb', false);
    if($file) {
        $data = '';
        while (!gzeof($file)) {
            $data .= gzread($file, 1024);
        }
        gzclose($file);
    }
    return $data;
}

function checkStockExists($symbol, $arrayObj){
    if(is_array($arrayObj)){
        foreach($arrayObj as $obj){
            if($obj->symbol==$symbol){
                return $obj;
            }
        }
    }
    return false;
}

$stockData = gz_get_contents("http://api.pse.tools/api/stocks?ts='".time());
$stockData = json_decode($stockData);

/*
$test = checkStockExists('2GO',$stockData->data);
foreach($test as $txt => $val){
    echo $txt. ' == '.$val.'<br>'; 
}
//echo "<pre>",print_r($stockData);
echo "<pre>",print_r($test);
exit;*/
//$stock = new Stock($test, 20000);
//echo json_encode($stock);

$ticker['Banks'][] = 'AUB';
$ticker['Banks'][] = 'BDO';
$ticker['Banks'][] = 'BKR';
$ticker['Banks'][] = 'BLFI';
$ticker['Banks'][] = 'BPI';
$ticker['Banks'][] = 'CHIB';
$ticker['Banks'][] = 'EW';
$ticker['Banks'][] = 'I';
$ticker['Banks'][] = 'MBT';
$ticker['Banks'][] = 'NRCP';
$ticker['Banks'][] = 'PBB';
$ticker['Banks'][] = 'PBC';
$ticker['Banks'][] = 'PNB';
$ticker['Banks'][] = 'PSE';
$ticker['Banks'][] = 'PTC';
$ticker['Banks'][] = 'RCB';
$ticker['Banks'][] = 'SECB';
$ticker['Banks'][] = 'UBP';
$ticker['Banks'][] = 'V';
$ticker['Commercial'][] = '2GO';
$ticker['Commercial'][] = 'ABG';
$ticker['Commercial'][] = 'ABS';
$ticker['Commercial'][] = 'ACR';
$ticker['Commercial'][] = 'AP';
$ticker['Commercial'][] = 'CA';
$ticker['Commercial'][] = 'CEB';
$ticker['Commercial'][] = 'CHP';
$ticker['Commercial'][] = 'CIP';
$ticker['Commercial'][] = 'CROWN';
$ticker['Commercial'][] = 'DAVIN';
$ticker['Commercial'][] = 'DMC';
$ticker['Commercial'][] = 'EDC';
$ticker['Commercial'][] = 'EEI';
$ticker['Commercial'][] = 'EURO';
$ticker['Commercial'][] = 'FGEN';
$ticker['Commercial'][] = 'GMA7';
$ticker['Commercial'][] = 'HLCM';
$ticker['Commercial'][] = 'ICT';
$ticker['Commercial'][] = 'IMI';
$ticker['Commercial'][] = 'ION';
$ticker['Commercial'][] = 'MER';
$ticker['Commercial'][] = 'MVC';
$ticker['Commercial'][] = 'MWC';
$ticker['Commercial'][] = 'MWIDE';
$ticker['Commercial'][] = 'PCOR';
$ticker['Commercial'][] = 'PHEN';
$ticker['Commercial'][] = 'PHN';
$ticker['Commercial'][] = 'PNX';
$ticker['Commercial'][] = 'PPC';
$ticker['Commercial'][] = 'ROX';
$ticker['Commercial'][] = 'SCC';
$ticker['Commercial'][] = 'SHLPH';
$ticker['Commercial'][] = 'SPC';
$ticker['Commercial'][] = 'SSP';
$ticker['Commercial'][] = 'T';
$ticker['Commercial'][] = 'TECH';
$ticker['Commercial'][] = 'UNI';
$ticker['Commercial'][] = 'VUL';
$ticker['Commercial'][] = 'VVT';
$ticker['Conglomerates'][] = 'AAA';
$ticker['Conglomerates'][] = 'ABA';
$ticker['Conglomerates'][] = 'AC';
$ticker['Conglomerates'][] = 'AEV';
$ticker['Conglomerates'][] = 'ANS';
$ticker['Conglomerates'][] = 'APO';
$ticker['Conglomerates'][] = 'ATN';
$ticker['Conglomerates'][] = 'COSCO';
$ticker['Conglomerates'][] = 'FDC';
$ticker['Conglomerates'][] = 'FJP';
$ticker['Conglomerates'][] = 'FPH';
$ticker['Conglomerates'][] = 'GTCAP';
$ticker['Conglomerates'][] = 'HI';
$ticker['Conglomerates'][] = 'JGS';
$ticker['Conglomerates'][] = 'JOH';
$ticker['Conglomerates'][] = 'LPZ';
$ticker['Conglomerates'][] = 'LTG';
$ticker['Conglomerates'][] = 'MGH';
$ticker['Conglomerates'][] = 'MJIC';
$ticker['Conglomerates'][] = 'MPI';
$ticker['Conglomerates'][] = 'PA';
$ticker['Conglomerates'][] = 'POPI';
$ticker['Conglomerates'][] = 'REG';
$ticker['Conglomerates'][] = 'SGI';
$ticker['Conglomerates'][] = 'SGP';
$ticker['Conglomerates'][] = 'SM';
$ticker['Conglomerates'][] = 'TFHI';
$ticker['Consumer'][] = 'AGI';
$ticker['Consumer'][] = 'ANI';
$ticker['Consumer'][] = 'CAT';
$ticker['Consumer'][] = 'CIC';
$ticker['Consumer'][] = 'CNPF';
$ticker['Consumer'][] = 'DMPL';
$ticker['Consumer'][] = 'DNL';
$ticker['Consumer'][] = 'EMP';
$ticker['Consumer'][] = 'FOOD';
$ticker['Consumer'][] = 'GSMI';
$ticker['Consumer'][] = 'JFC';
$ticker['Consumer'][] = 'LFM';
$ticker['Consumer'][] = 'MACAY';
$ticker['Consumer'][] = 'MAXS';
$ticker['Consumer'][] = 'MRSGI';
$ticker['Consumer'][] = 'PF';
$ticker['Consumer'][] = 'PGOLD';
$ticker['Consumer'][] = 'PIP';
$ticker['Consumer'][] = 'PIZZA';
$ticker['Consumer'][] = 'RCI';
$ticker['Consumer'][] = 'RFM';
$ticker['Consumer'][] = 'RRHI';
$ticker['Consumer'][] = 'SEVN';
$ticker['Consumer'][] = 'SFI';
$ticker['Consumer'][] = 'SMC';
$ticker['Consumer'][] = 'SSI';
$ticker['Consumer'][] = 'URC';
$ticker['Consumer'][] = 'VITA';
$ticker['Consumer'][] = 'VMC';
$ticker['Consumer'][] = 'WLCON';
$ticker['Insurance'][] = 'MFC';
$ticker['Insurance'][] = 'SLF';
$ticker['Mining'][] = 'AB';
$ticker['Mining'][] = 'APX';
$ticker['Mining'][] = 'AR';
$ticker['Mining'][] = 'AT';
$ticker['Mining'][] = 'COAL';
$ticker['Mining'][] = 'CPM';
$ticker['Mining'][] = 'DIZ';
$ticker['Mining'][] = 'FNI';
$ticker['Mining'][] = 'LC';
$ticker['Mining'][] = 'MA';
$ticker['Mining'][] = 'MAB';
$ticker['Mining'][] = 'MARC';
$ticker['Mining'][] = 'NI';
$ticker['Mining'][] = 'NIKL';
$ticker['Mining'][] = 'OPM';
$ticker['Mining'][] = 'ORE';
$ticker['Mining'][] = 'OV';
$ticker['Mining'][] = 'PERC';
$ticker['Mining'][] = 'PX';
$ticker['Mining'][] = 'PXP';
$ticker['Mining'][] = 'UPM';
$ticker['Property'][] = 'ALCO';
$ticker['Property'][] = 'ALHI';
$ticker['Property'][] = 'ALI';
$ticker['Property'][] = 'ARA';
$ticker['Property'][] = 'BEL';
$ticker['Property'][] = 'BRN';
$ticker['Property'][] = 'CDC';
$ticker['Property'][] = 'CEI';
$ticker['Property'][] = 'CHI';
$ticker['Property'][] = 'CPG';
$ticker['Property'][] = 'CPV';
$ticker['Property'][] = 'CYBR';
$ticker['Property'][] = 'DD';
$ticker['Property'][] = 'ELI';
$ticker['Property'][] = 'FLI';
$ticker['Property'][] = 'GERI';
$ticker['Property'][] = 'HOUSE';
$ticker['Property'][] = 'IRC';
$ticker['Property'][] = 'KEP';
$ticker['Property'][] = 'LAN';
$ticker['Property'][] = 'MEG';
$ticker['Property'][] = 'MRC';
$ticker['Property'][] = 'PRMX';
$ticker['Property'][] = 'RLC';
$ticker['Property'][] = 'RLT';
$ticker['Property'][] = 'ROCK';
$ticker['Property'][] = 'SHNG';
$ticker['Property'][] = 'SLI';
$ticker['Property'][] = 'SMPH';
$ticker['Property'][] = 'STR';
$ticker['Property'][] = 'SUN';
$ticker['Property'][] = 'VLL';
$ticker['Services'][] = 'APC';
$ticker['Services'][] = 'APL';
$ticker['Services'][] = 'ATI';
$ticker['Services'][] = 'BLOOM';
$ticker['Services'][] = 'CEU';
$ticker['Services'][] = 'DFNN';
$ticker['Services'][] = 'DWC';
$ticker['Services'][] = 'FEU';
$ticker['Services'][] = 'HVN';
$ticker['Services'][] = 'IMP';
$ticker['Services'][] = 'IPM';
$ticker['Services'][] = 'IPO';
$ticker['Services'][] = 'ISM';
$ticker['Services'][] = 'LBC';
$ticker['Services'][] = 'LOTO';
$ticker['Services'][] = 'LR';
$ticker['Services'][] = 'MAC';
$ticker['Services'][] = 'MB';
$ticker['Services'][] = 'MBC';
$ticker['Services'][] = 'MJC';
$ticker['Services'][] = 'MRP';
$ticker['Services'][] = 'NOW';
$ticker['Services'][] = 'PAL';
$ticker['Services'][] = 'PAX';
$ticker['Services'][] = 'PHA';
$ticker['Services'][] = 'PHC';
$ticker['Services'][] = 'PLC';
$ticker['Services'][] = 'PORT';
$ticker['Services'][] = 'PRC';
$ticker['Services'][] = 'RWM';
$ticker['Services'][] = 'SBS';
$ticker['Services'][] = 'STI';
$ticker['Services'][] = 'TUGS';
$ticker['Services'][] = 'WEB';
$ticker['Services'][] = 'WPI';
$ticker['Telecoms'][] = 'GLO';
$ticker['Telecoms'][] = 'TEL';
$ticker['Selected'][] = 'ACE';
$ticker['Selected'][] = 'AGF';
$ticker['Selected'][] = 'BC';
$ticker['Selected'][] = 'BH';
$ticker['Selected'][] = 'BMM';
$ticker['Selected'][] = 'CSB';
$ticker['Selected'][] = 'ECP';
$ticker['Selected'][] = 'FAF';
$ticker['Selected'][] = 'FFI';
$ticker['Selected'][] = 'FYN';
$ticker['Selected'][] = 'GPH';
$ticker['Selected'][] = 'JAS';
$ticker['Selected'][] = 'KPH';
$ticker['Selected'][] = 'LSC';
$ticker['Selected'][] = 'MAH';
$ticker['Selected'][] = 'MED';
$ticker['Selected'][] = 'MG';
$ticker['Selected'][] = 'NXGEN';
$ticker['Selected'][] = 'OPMB';
$ticker['Selected'][] = 'PCP';
$ticker['Selected'][] = 'PMPC';
$ticker['Selected'][] = 'PMT';
$ticker['Selected'][] = 'PNC';
$ticker['Selected'][] = 'PRIM';
$ticker['Selected'][] = 'PTT';
$ticker['Selected'][] = 'SOC';
$ticker['Selected'][] = 'SPM';
$ticker['Selected'][] = 'SRDC';
$ticker['Selected'][] = 'STN';
$ticker['Selected'][] = 'TBGI';
$ticker['Selected'][] = 'TFC';

$tree = array();
foreach($ticker as $type=>$syms){
    $jsn = '';
    $jsn.='{"text": "'.$type.'", "href": "#'.$type.'", "type":"label"';
    if(is_array($syms) && !empty($syms)){
        $nds = array();
        foreach($syms as $idx => $symbol){
            $sData = checkStockExists($symbol, $stockData->data);
            if($sData){
                $stockMoreInfo = array();
                $removeInfo = array('symbol','difference');
                foreach($sData as $txt=>$val ){
                    if(!in_array($txt, $removeInfo)){
                        $stockMoreInfo[] = '{"text":"'.ucwords($txt).'", "tags":[\''.addslashes($val).'\']}';    
                    }
                }
                //echo "<pre>",print_r($stockMoreInfo);
                $nds[] = '{"text": "'.$symbol.'", "href": "#'.$symbol.'", "type":"symbol", "tags":["'.$sData->difference.'"], "nodes":['.implode(',',$stockMoreInfo).']}';
            }
        }
        $jsn.=', "nodes":['.implode(',',$nds).']';
    }
    $jsn.='}';
    $tree[] = $jsn;
}

//echo 'Ticker Count: '.count($ticker2);

$jsnMenu = '['.implode(',',$tree).']';
//echo "<pre>",print_r($jsnMenu);
?>