<!DOCTYPE html>
<html lang="en">
<head>
	<title>Stock Calculator</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://jonmiles.github.io/bootstrap-treeview/js/bootstrap-treeview.js"></script>
	<style>
		@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800);
		
		html, body, #content { height: 98%; font-family: Open Sans; }
		#content .content, .sidenav { height: 100% }

		/* Remove the navbar's default margin-bottom and rounded borders */ 
		.navbar {
		  margin-bottom: 0;
		  border-radius: 0;
		}
		
		/* Set height of the grid so .sidenav can be 100% (adjust as needed) */
		/* .row.content {height: 450px} */
		
		/* Set gray background color and 100% height */
		.sidenav {
			/* max-height: 750px; */
			padding-top: 20px;
			background-color: #f1f1f1;
		}
		
		.ticker-menu-wrapper {
			padding-bottom: 20px;
			padding-right: 5px;
			
			
			display: block;
			max-height: 98%;
			overflow-y: auto;
			-ms-overflow-style: -ms-autohiding-scrollbar;
		}
		
		#content-container{
			padding-top: 20px;
			display: block;
			max-height: 800px;
			overflow-y: auto;
			-ms-overflow-style: -ms-autohiding-scrollbar;
		}
		
		
		
		/* Set black background color, white text and some padding * /
		footer {
			background-color: #555;
			color: white;
			padding: 15px;
			position: relative;
			width: 100%;
			/* bottom: initial; * /
		}*/
		
		/* On small screens, set height to 'auto' for sidenav and grid */
		@media screen and (max-width: 767px) {
		  .sidenav {
			height: auto;
			padding: 15px;
		  }
		  .row.content {height:auto;} 
		}
		
		/* Accordion */
		button.accordion {
			background-color: #eee;
			color: #444;
			cursor: pointer;
			padding: 18px;
			width: 100%;
			border: none;
			text-align: left;
			outline: none;
			font-size: 15px;
			transition: 0.4s;
		}
		
		button.accordion.active, button.accordion:hover {
			background-color: #ccc;
		}
		
		button.accordion:after {
			content: '\002B';
			color: #777;
			font-weight: bold;
			float: right;
			margin-left: 5px;
		}
		
		button.accordion.active:after {
			content: "\2212";
		}
		
		div.panel {
			padding: 0 18px;
			background-color: white;
			max-height: 0;
			overflow: hidden;
			transition: max-height 0.2s ease-out;
		}
		
		input.target{
			max-width: 92px;
		}
		
		th {
			text-align: center;
		}
		
		th.data-input {
			width: 8%;
		}
		
		td.align-center{
			text-align: center;
		}
		
		td.align-right{
			text-align: right;
		}
		
		
		@media only screen and (max-width: 800px) {
    
			/* Force table to not be like tables anymore */
			#no-more-tables table, 
			#no-more-tables thead, 
			#no-more-tables tbody, 
			#no-more-tables th, 
			#no-more-tables td, 
			#no-more-tables tr {
				font-family: Open Sans;
				display: block; 
			}
		 
			/* Hide table headers (but not display: none;, for accessibility) */
			#no-more-tables thead th {
				text-align: center;
			}
			
			#no-more-tables thead tr {
				position: absolute;
				top: -9999px;
				left: -9999px;
			}
		 
			#no-more-tables tr { border: 1px solid #ccc; }
		 
			#no-more-tables td { 
				/* Behave  like a "row" */
				border: none;
				border-bottom: 1px solid #eee; 
				position: relative;
				padding-left: 50%; 
				white-space: normal;
				text-align:left;
			}
		 
			#no-more-tables td:before { 
				/* Now like a table header */
				position: absolute;
				/* Top/left values mimic padding */
				top: 6px;
				left: 6px;
				width: 45%; 
				padding-right: 10px; 
				white-space: nowrap;
				text-align:left;
				font-weight: bold;
			}
		 
			/*
			Label the data
			*/
			#no-more-tables td:before { content: attr(data-title); }
		}
	</style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>                        
		</button>
		<a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
		<ul class="nav navbar-nav">
			<li class="active"><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Projects</a></li>
			<li><a href="#">Contact</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		</ul>
    </div>
  </div>
</nav>
  
<div id="content" class="container-fluid">    
	<div class="row content">
		<div class="col-sm-3 sidenav">
			<div class="ticker-menu-wrapper">
				<div id="treeview2" ></div>
			</div>
		</div>
		<div class="col-sm-9 text-left"> 
			<!-- h1>Welcome</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			
			<?php //echo "<pre>",print_r($ticker); ?> -->
			
			<div id="content-container">
				<div id="no-more-tables">
					<!-- table class="table table-condensed table-striped table-bordered table-responsive -->
					<table class="col-md-12 table-bordered table-striped table-condensed cf">
						<thead class="cf">
							<tr>
								<th>Ticker</th>
								<th >Price</th>
								<th >Boardlot</th>
								<th >Shares</th>
								<th >Cost to Buy</th>
								<th class="data-input">Target1</th>
								<th >Sale Cost1</th>
								<th >Gain/Loss1</th>
								<th class="data-input">Target2</th>
								<th >Sale Cost2</th>
								<th >Gain/Loss2</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="listContent"></tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- div class="col-sm-2 sidenav">
			<div class="well">
				<form name="dynamic-config">
				<div class="form-group">
					<label for="bp">BP:</label>
					<input type="text" class="form-control" id="bp" placeholder="Buying Power">
				</div>
				<div class="form-group">
					<label for="bp">BP:</label>
					<input type="text" class="form-control" id="bp" placeholder="Buying Power">
				</div>
				</form>
			</div>
			<div class="well">
				<p>ADS</p>
			</div>
		</div -->
	</div>
</div>


<div id="table-content" class="hide">
	<div class="tmp_trow">
	<tr><td class="ticker" rowspan=2>test1</td>
		<td class="price">test1</td>
		<td class="b-lot">test1</td>
		<td class="cost">test1</td>
		<td class="shares">test1</td>
		<td class="target1">test1</td>
		<td class="gain1">test1</td>
		<td class="target2">test1</td>
		<td class="gain2">test1</td>
		<td class="action">icon</td>
	</tr>
	<tr>
		<td colspan=9></td>
	</tr>
	</div>
</div>

<!-- footer id="footer" class="container-fluid text-center">
  <p>&nbsp;</p>
</footer -->

</body>
<?php require 'ticker.php'; ?>
<script type="text/javascript">
  	$(function() {
		var formatter = new Intl.NumberFormat('en-US', {
			style: 'currency',
			currency: 'PHP',
			minimumFractionDigits: 2,
			// the default value for minimumFractionDigits depends on the currency
			// and is usually already 2
		  });
		var selected = [];
		var defaultData = <?php echo $jsnMenu; ?>;
		var initSelectableTree = function() {
          return $('#treeview2').treeview({
            data: defaultData,
			showTags: true,
			levels: 1,
            onNodeSelected: function(event, node) {
				if(node.type=='symbol'){
					//alert('pasok' + jQuery.inArray( node.text, selected));
					if( $.inArray( node.text, selected)!=-1 ){
						//alert('Existing!');
					}else{
						getStockData(node.text);
						selected.push(node.text);
					}
				}
            }
          });
        };
		
        var $selectableTree = initSelectableTree();
		
		$(document).on('click', '.viewInfo', function(){
			//alert('Sorry, this action is temporary disabled!');
			$('#inforow-'+$(this).attr('infoname')).toggle('show');
		} );
		
		function getStockData(ticker){
			$.ajax({
				url: "/ajax.php?action=getdata&symbol="+ticker,
				dataType: 'json',
				xhrFields: { withCredentials: true}
				
			}).done(function(jsn) {
				var dRow = '<tr class="datarow-'+jsn.symbol+'" rowspan=2>';
				dRow += '<td class="ticker align-center">'+jsn.symbol+'</td>';
				dRow += '<td class="price align-center">'+jsn.last+'</td>';
				dRow += '<td class="b-lot align-center">'+jsn.boardlot+'</td>';
				dRow += '<td class="shares align-center">'+jsn.shares+'</td>';
				dRow += '<td class="cost align-center">'+formatter.format(jsn.average_cost)+'</td>';
				dRow += '<td class="target1 align-right"><input type="text" class="form-control target" id="target1" value="'+jsn.sell[0].price+'"></td>';
				dRow += '<td class="salecost1 align-center">'+formatter.format(jsn.sell[0].sellcost)+'</td>';
				dRow += '<td class="gain1 align-center">'+formatter.format(jsn.sell[0].sellgain)+'</td>';
				dRow += '<td class="target2 align-right"><input type="text" class="form-control target" id="target2" value="'+jsn.sell[1].price+'"></td>';
				dRow += '<td class="salecost2 align-center">'+formatter.format(jsn.sell[1].sellcost)+'</td>';
				dRow += '<td class="gain2 align-center">'+formatter.format(jsn.sell[1].sellgain)+'</td>';
				dRow += '<td class="action align-center"><a href="#" class="viewInfo" infoname="'+jsn.symbol+'"><span class="glyphicon glyphicon-zoom-in"></span></a></td>';
				dRow += '</tr>';
				dRow += '<tr class="datarow-'+jsn.symbol+'" id="inforow-'+jsn.symbol+'" style="display: none">';
				dRow += '<td colspan="12" class="align-center" ><div><iframe style="height: 384px; width: 100%"src="http://www.arzgethalm.com/8675b310-c1b8-42cb-a0b7-afd7e594e6af/index.php?api_key=9583e927-319e-47ad-ba3b-c73cfc9958a6"></iframe></div></td>';
				dRow += '<td ><div id="inforow-'+jsn.symbol+'" style="display: none"></div></td>';
				dRow += '</tr>';
				$('#listContent').prepend(dRow);
			});
		}
	});
	
	
</script>
</html>