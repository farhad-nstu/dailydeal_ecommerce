<form action="{{route('thisisfunctionaction')}}" method="post">
	@csrf
	<select name="setting">
		<option value="1">On</option>
		<option value="0">Off</option>
	</select>
	<input type="submit" value="Save">
</form>