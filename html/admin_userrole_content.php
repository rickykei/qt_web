 <div id="content">
	
	<div id="leftcol"><img src="/images/checklist.png"></div>
	
	<div id="rightcol">
	
		
		<ul>
		<li class="row">
			<img class="rowpic" src="/images/checklist_create.png" width="80"/>
			<form id="user_create" action="create_new_checklist.php" >
			 
		
			<input   type="button" alt="admin_user_create_header.php?KeepThis=true&height=550&width=500&modal=true" title="" class="thickbox button" value="create"/>
			</form>
			 
		</li>
		<li class="row">
			<img class="rowpic" src="/images/checklist_search.png" width="80"/>
			<form id="user_search" action="" >
			<label>Username</label><input type="text" /><br/>
			<label>Creation Date</label><input type="text" /><br/>
			 <label>Role</label><input type="text" /><br/>
			<label>Status</label><input type="text" /> 
			<input class="button" type="submit" id="createchecklistbtn" value="search" class="button"/>
			</form>
			 
		</li>
		</ul>
		<div class="clear"></div>
	
		<div id="contentresult">
		<table id="checklist_table">
			<tr class="checklist_table_header">
				<th width=" ">Username</th>
				<th width="">Role</th>
				<th width="100">Creation Date</th>
				<th width="30">Edit</th>
				<th width="30">Delete</th>
				
			</tr>
			<tr class="checklist_table_content">
				<td>buyer</td>
				<td>buyer</td>
				<td>2010-06-24</td>
			 
				<td><input class="button" type="button" value="edit"></td>
				<td><input class="button" type="button" value="delete"></td>
				 
			</tr>
			<tr class="checklist_table_content">
				<td>admin</td>
				<td>admin</td>
				<td>2010-06-24</td>
				 
			 
				<td><input class="button" type="button" value="edit"></td>
				<td><input class="button" type="button" value="delete"></td>
				 
			</tr>
		</table>	
		</div>
	 
	</div>

	
	
</div>