<html>
<head>
	<title>Grams Calculation</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<table class="inputTable table table-dark table-bordered table-striped " style="width: 50%;">
		<tr>
			<th scope="col">Type</th>
			<th scope="col">Compound.</th>
			<th  scope="col">Coefficiant</th>
			<th  scope="col">Molar Mass</th>
			<th  scope="col">Moles</th>
			<th  scope="col">wight(gm)</th>
		</tr>
		<tr id="i1" for="1">
			<td rowspan="10"><input id="addInput" class="form-control" value="+" style="background: #111; color:white; font-size: 20px" type="button" >
				<input id="removeInput" class="form-control" value="-" style="background: #111; color:white; font-size: 20px" type="button" >
			</td>
			<td class="Compound"><input value="Co(NO3)2" class="form-control" type="text" ></td>
			<td class="Coeff"><input value="9" class="form-control" type="number" ></td>
			<td class="MolarMass"><input value="182.93832" class="form-control" type="number"></td>
			<td class="elm Moles"><input value="" class="form-control" type="number"></td>
			<td class="elm Wight"><input value="" class="form-control" type="number"></td>
		</tr>
		<tr id="i2" for="2">

			<td class="Compound"><input value="Fe(NO3)3" class="form-control" type="text" ></td>
			<td class="Coeff"><input value="18" class="form-control" type="number" ></td>
			<td class="MolarMass"><input value="241.86248" class="form-control" type="number"></td>
			<td class="elm Moles"><input value="" class="form-control" type="number"></td>
			<td class="elm Wight"><input value="" class="form-control" type="number"></td>
		</tr>
		<tr id="i3" for="3">
			<td class="Compound"><input value="C6H8O7" class="form-control" type="text" ></td>
			<td class="Coeff"><input value="20" class="form-control" type="number" ></td>
			<td class="MolarMass"><input value="192.12352" class="form-control" type="number"></td>
			<td class="elm Moles"><input value="" class="form-control" type="number"></td>
			<td class="elm Wight"><input value="" class="form-control" type="number"></td>
		</tr>

	</table>
	<table class="outputTable table table-dark table-bordered table-striped " style="width: 50%;">
		<tr>
			<th scope="col">Type</th>
			<th scope="col">Compound.</th>
			<th  scope="col">Coefficiant</th>
			<th  scope="col">Molar Mass</th>
			<th  scope="col">Moles</th>
			<th  scope="col">wight(gm)</th>
		</tr>
		<tr id="o1" for="1">
			<td rowspan="10"><input id="addOutput" class="form-control" value="+" style="background: #111; color:white; font-size: 20px" type="button" >
				<input id="removeOutput" class="form-control" value="-" style="background: #111; color:white; font-size: 20px" type="button" >
			</td>
			<td class="Compound"><input value="CoFe2O4" class="form-control" type="text" ></td>
			<td class="Coeff"><input value="9" class="form-control" type="number" ></td>
			<td class="MolarMass"><input value="234.620795" class="form-control" type="number"></td>
			<td class="elm Moles"><input value="" class="form-control" type="number"></td>
			<td class="elm Wight"><input value="" class="form-control" type="number"></td>
		</tr>
		<tr id="o2" for="2">

			<td class="Compound"><input value="CO2" class="form-control" type="text" ></td>
			<td class="Coeff"><input value="120" class="form-control" type="number" ></td>
			<td class="MolarMass"><input value="44.0095" class="form-control" type="number"></td>
			<td class="elm Moles"><input value="" class="form-control" type="number"></td>
			<td class="elm Wight"><input value="" class="form-control" type="number"></td>
		</tr>
		<tr id="o3" for="3">
			<td class="Compound"><input value="H2O" class="form-control" type="text" ></td>
			<td class="Coeff"><input value="80" class="form-control" type="number" ></td>
			<td class="MolarMass"><input value="18.01528" class="form-control" type="number"></td>
			<td class="elm Moles"><input value="" class="form-control" type="number"></td>
			<td class="elm Wight"><input value="" class="form-control" type="number"></td>
		</tr>
		<tr id="o4" for="4">
			<td class="Compound"><input value="N2" class="form-control" type="text" ></td>
			<td class="Coeff"><input value="36" class="form-control" type="number" ></td>
			<td class="MolarMass"><input value="28.0134" class="form-control" type="number"></td>
			<td class="elm Moles"><input value="" class="form-control" type="number"></td>
			<td class="elm Wight"><input value="" class="form-control" type="number"></td>
		</tr>

	</table>
	<div id="equation"></div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).on('click','#addInput',function(){
	var no= parseInt($('.inputTable > tbody >tr:last-child').attr('for'))+1;
	$('.inputTable > tbody:last-child').append('<tr id="i'+no+'" for="'+no+'" ><td class="Compound"><input class="form-control" type="text" ></td><td class="Coeff"><input class="form-control" type="text" ></td><td class="MolarMass"><input class="form-control" type="text"></td><td class="elm Moles"><input class="form-control" type="text"></td><td class="elm Wight"><input class="form-control" type="text"></td></tr>');
	});
	$(document).on('click','#removeInput',function(){
		$('.inputTable > tbody >tr:last-child').remove();
	});
	$(document).on('click','#addOutput',function(){
		var no= parseInt($('.inputTable > tbody >tr:last-child').attr('for'))+1;
		$('.outputTable > tbody:last-child').append('<tr id="i'+no+'" for="'+no+'" ><td class="Compound"><input class="form-control" type="text" ></td><td class="Coeff"><input class="form-control" type="text" ></td><td class="MolarMass"><input class="form-control" type="text"></td><td class="elm Moles"><input class="form-control" type="text"></td><td class="elm Wight"><input class="form-control" type="text"></td></tr>');
	});
	$(document).on('click','#removeOutput',function(){
		$('.outputTable > tbody >tr:last-child').remove();
	});
	$(document).on('keyup','.elm input',function(){
		if($(this).parent().hasClass("Moles")){
		var moleFraction=parseFloat($(this).val())/parseFloat($(this).parent().parent().find(".Coeff input").val());
		}else if($(this).parent().hasClass("Wight")){
		var moleFraction=parseFloat($(this).val())/parseFloat($(this).parent().parent().find(".MolarMass input").val())/parseFloat($(this).parent().parent().find(".Coeff input").val());
		}
		$(".Moles>input").each(function () {
			$(this).val(parseFloat($(this).parent().parent().find(".Coeff input").val())*moleFraction);
		});
		$(".Wight>input").each(function () {
			$(this).val(parseFloat($(this).parent().parent().find(".MolarMass input").val())*$(this).parent().parent().find(".Moles input").val());
		});
	});
	$(document).ready(function(){
		$(".inputTable .Compound").each(function(key ,value){
			if(key>0){
				$("#equation").append(" + ");
			}
			$("#equation").append('<i style="color:blue;">'+$(this).parent().find('.Coeff input').val()+" </i>");
			$("#equation").append($(this).find('input').val());
			
		});
		$("#equation").append("=");
		$(".outputTable .Compound").each(function(key ,value){
			if(key>0){
				$("#equation").append(" + ");
			}
		$("#equation").append('<i style="color:blue;">'+$(this).parent().find('.Coeff input').val()+" </i>");
		$("#equation").append($(this).find('input').val());
			
		});
	});
</script>
</html>