 <div id="content">
	
	<div id="leftcol"><img src="/images/checklist.png"></div>
	
	<div id="rightcol">
	
		
		<ul>
		 
		<li class="row">
			<img class="rowpic" src="/images/checklist_search.png" width="80"/>
			<form id="checklist_search" action="" >
			<label>Checklist Name</label><input type="text" /><br/>
			<label>Establish Date</label><input type="text" /><br/>
			<label>Version</label><input type="text" /><br/>
			<label>Create By</label><input type="text" /><br/>
			<label>Status</label><input type="text" /> 
			<input type="submit" id="createchecklistbtn" value="search" class="button"/>
			</form>
			 
		</li>
		</ul>
		<div class="clear"></div>
	
		<div id="contentresult">
		<table id="checklist_table">
			<tr class="checklist_table_header">
				<th width="20">id</th>
				<th width="280">Check List Name</th>
				<th width="100">Establish Date</th>
				<th width="20">Version</th>
				<th width="50">Create By</th>
				<th width="30">View</th>
				<th width="30">Delete</th>
				<th width="30">Copy to</th> 
			</tr>
			<tr class="checklist_table_content">
				<td>1</td>
				<td>checklist1</td>
				<td>2010-06-24</td>
				<td>001</td>
				<td>qadmin</td>
				<td><input type="button" value="view"></td>
				<td><input type="button" value="delete"></td>
				<td><input type="button" value="copy_to"></td>
			</tr>
			<tr class="checklist_table_content">
				<td>2</td>
				<td>checklist2</td>
				<td>2010-06-24</td>
				<td>001</td>
				<td>qadmin</td>
				<td><input type="button" value="view"></td>
				<td><input type="button" value="delete"></td>
				<td><input type="button" value="copy_to"></td>
			</tr>
		</table>	
		</div>
	 
	</div>

	
	
</div>