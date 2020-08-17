<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta title="habilitar, deshabilitar combos según selección en otro combo">
 
	<script>
		function habilitar(value)
		{
			if(value=="1" || value==true)
			{
				// habilitamos
				document.getElementById("segundo").disabled=false;
			}else if(value=="2" || value==false){
				// deshabilitamos
				document.getElementById("segundo").disabled=true;
			}
		}
	</script>
</head>
 
<body>
<form>
	<h1>habilitar, deshabilitar combos según selección en otro combo</h1>
	<div>
		<select name="primero" id="primero" onchange="habilitar(this.value);">
			<option value='0'>selecciona</option>
			<option value='1'>habilitar el segundo</option>
			<option value='2'>deshabilitar el segundo</option>
		</select>
	</div>
	<div>
		<select name="segundo" id="segundo">
			<option value='1'>seleccion 1</option>
			<option value='2'>seleccion 2</option>
		</select>
	</div>
</form>
</body>
</html>
