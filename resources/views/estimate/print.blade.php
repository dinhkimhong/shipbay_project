<!DOCTYPE html>
<html>
<head>
<title>Shipbay.us</title>
<script src="{{ asset('js/JsBarcode.all.min.js')}}"></script>

<style type="text/css">
html,body{
	padding: 0;
	margin: 0;
	width: 100%;
	background: #fff;
	font-family: Arial,'Sans Serif','Time News Romain';
	font-size: 10pt;
	}

p{
	line-height: 6px;
}

table{
	width: 700px;
	margin: 0 auto;
	text-align: left;
	border-collapse: collapse;

}

th{
	padding-left: 2px;
	line-height: 16pt;
}

td{
	padding: 3px;
}


.verify{
	font-family: 'time news romain';
}

.imageAeu{width: 50px; height: 70px;}

.th {
	background-color: #ddd;
	border: 1px solid;
	text-align: center;
}

#container{
	width: 100%;
	margin: 0 auto;
	background-color: white;
}

.khm-os{ font-family: 'Time news Romain'; }

.divide{ width: 100%; margin: 0 auto; }

hr{
	width: 100%;
	margin-right: 0;
	margin-left: 0;
	padding: 0;
	margin-top: 35px;
	margin-bottom: 20px;
	border: 0 none;
	border-top: 1px dashed #322f32;
	background: none;
	height: 0;
}

.length-limit{max-height: 700px; min-width: 350px}

.line-row{
	border: 1px solid;
}
</style>

</head>
<body>
<table><td><button onclick="printContent('divide')" style="float:right; background-color: #0cb73f; color: white">Print</button></td></table>

<div id="divide">

	<div id="container">
		<div class="length-limit">
			<table>
				<tr>
					<td style="width: 140px; ">
					</td>
					<td>
						<h2 style="width: 250px"><b>REGISTRATION</b></h2>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: right;"></td>
					<td colspan="0" style="text-align: right">
						<svg width="120" height="60" class="barcode"
							  jsbarcode-value="{{$estimate->estimate_id}}"
							  jsbarcode-textmargin="0"
							  jsbarcode-margin="0"
							  jsbarcode-width="1"						    
							  jsbarcode-height="35"
							  jsbarcode-fontsize="12">
						</svg>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: right;"></td>
					<td colspan="0" style="text-align: right;padding-left: 80px;">Registration no.: {{ $estimate->estimate_id}}</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: right;"></td>
					<td colspan="0" style="text-align: right;padding-left: 80px;">Date: {{ Carbon\Carbon::parse($estimate->created_at)->format('Y-m-d') }}</td>
				</tr>				
			</table>
			<table>
				<tr>
					<th style="width: 350px;">
						<p><u>Sender:</u></p>
						<p>{{ $estimate->sender_name}}</p>
						<p style="font-weight: normal">{{ $estimate->sender_address}}</p>
						<p style="font-weight: normal">{{$estimate->sender_city }}, {{$estimate->sender_state}}, {{$estimate->sender_country}}, {{ $estimate->sender_postal_code}}</p>
					</th>
					<th >
						<p><u>Receiver:</u></p>
						<p>{{ $estimate->contact }}</p>
						<p style="font-weight: normal">{{ $estimate->shipping_address }}</p>
						<p style="font-weight: normal">{{ $estimate->address_2()}}</p>
					</th>
				</tr>
			</table>	
		
			<table>
				<thead>
					<tr>
						<th class="th" style="width: 5%">No.</th>
						<th class="th" style="width: 40%;">Item</th>
						<th class="th">Quantity</th>
						<th class="th">Price</th>
						<th class="th">Amount</th>
					</tr>
				</thead>

				<tbody>
					@foreach($estimate_detail as $key=>$detail)
					<tr>
						<td class="line-row" style="text-align: center;">
							{{ ++$key }}
						</td>
						<td class="line-row">
							{{ $detail->item}}
						</td>
						<td class="line-row" style="text-align: right;">
							{{ $detail->quantity}}
						</td>
						<td class="line-row" style="text-align: right;">
							{{ number_format($detail->price,2)}}
						</td>
						<td class="line-row unit_price" style="text-align: right;">
							{{ number_format($detail->quantity * $detail->price,2) }}
						</td>
					</tr>
					@endforeach
					<tr>
						<td colspan="4" class="line-row" style="text-align: center; font-weight: bold;">Total amount</td>
						<td class="line-row total_amount" style="text-align: right; font-weight: bold;">{{ $estimate->total_amount}}</td>
					</tr>
					<tr>
						<td colspan="4" class="line-row" style="text-align: center; font-weight: bold;">Shipping cost</td>
						<td class="line-row total_amount" style="text-align: right; font-weight: bold;">{{ $estimate->shipping_cost}}</td>
					</tr>					
				</tbody>
			</table>
			<br>
			<table>
				<tr>
					<td>Size: {{ $estimate->length}} x {{ $estimate->width}} x {{ $estimate->height}}</td>
				</tr>
				<tr>
					<td>Weight: {{ $estimate->weight}}</td>
				</tr>				<tr>
					<td>
						<b class="veriry"><u>Notice to courier:</u></b>
						<p>{{ $estimate->note}}</p>						
					</td>

				</tr>
				<tr>
					<td>Thank you for choosing Shipbay's service.</td>
				</tr>				
			</table>
		</div>
	</div>

</div>

<script src="{{ asset('js/core/jquery.min.js') }}"></script>
<script type="text/javascript">
	JsBarcode(".barcode").init();
	function printContent(el){
		var restorepage = document.body.innerHTML;
		var printcontent = document.getElementById(el).innerHTML;
		document.body.innerHTML = printcontent;
		window.print();
		document.body.innerHTML = restorepage;
		window.close();
	}

</script>

</body>
</html>
