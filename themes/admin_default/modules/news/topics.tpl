<!-- BEGIN: main -->
<div id="module_show_list">
	{TOPIC_LIST}
</div>
<br />
<a id="edit"></a>
<!-- BEGIN: error -->
<div class="quote">
	<blockquote class="error">
		<span>{ERROR}</span>
	</blockquote>
</div>
<!-- END: error -->
<form action="{NV_BASE_ADMINURL}index.php" method="post">
	<input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" />
	<input type="hidden" name="{NV_OP_VARIABLE}" value="{OP}" />
	<input type="hidden" name="topicid" value="{DATA.topicid}" />
	<input name="savecat" type="hidden" value="1" />
	<table class="tab1">
		<caption>{LANG.add_topic}</caption>
		<tfoot>
			<tr>
				<td class="center" colspan="2"><input name="submit1" type="submit" value="{LANG.save}" /></td>
			</tr>
		</tfoot>
		<tbody>
			<tr>
				<td class="right"><strong>{LANG.name}: </strong></td>
				<td><input style="width: 650px" name="title" id="idtitle" type="text" value="{DATA.title}" maxlength="255" /></td>
			</tr>
			<tr>
				<td class="right"><strong>{LANG.alias}: </strong></td>
				<td><input style="width: 600px" name="alias" id="idalias" type="text" value="{DATA.alias}" maxlength="255" /> &nbsp; <i class="icon-refresh icon-large" onclick="get_alias('topics', {DATA.topicid});"></i></td>
			</tr>
			<tr>
				<td class="right"><strong>{LANG.content_homeimg}:</strong></td>
				<td><input style="width: 550px" type="text" name="homeimg" id="homeimg" value="{DATA.image}" /> <input type="button" value="Browse server" name="selectimg" /></td>
			</tr>
			<tr>
				<td class="right"><strong>{LANG.keywords}: </strong></td>
				<td><input style="width: 650px" name="keywords" type="text" value="{DATA.keywords}" maxlength="255" /></td>
			</tr>
			<tr>
				<td class="right top">
				<br />
				<strong>{LANG.description}</strong></td>
				<td><textarea style="width: 650px" name="description" cols="100" rows="5">{DATA.description}</textarea></td>
			</tr>
		</tbody>
	</table>
	<br />
</form>
<!-- BEGIN: getalias -->
<script type="text/javascript">
	$("#idtitle").change(function() {
		get_alias('topics', '{DATA.topicid}');
	});
</script>
<!-- END: getalias -->

<script type="text/javascript">
	$("input[name=selectimg]").click(function() {
		var area = "homeimg";
		var path = "{UPLOADS_DIR}";
		var currentpath = "{UPLOADS_DIR}";
		var type = "image";
		nv_open_browse_file(script_name + "?" + nv_name_variable + "=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
		return false;
	});
</script>
<!-- END: main -->