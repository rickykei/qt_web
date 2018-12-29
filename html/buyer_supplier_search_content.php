 <div id="content">
	
	<div id="leftcol"><img src="/images/schedulinglogo.png"></div>
	
	<div id="rightcol">
	
		
		<ul>
		<li class="row">
			<img class="rowpic" src="/images/supplier_main.png" width="80"/>
			To add a new supplier onto the list, click here!
			<form  id="checklist_create" action="create_new_checklist.php" >
				<input   type="button" alt="buyer_supplier_create.php?KeepThis=true&height=450&width=450&modal=true" title="" class="thickbox button" value="create"/>
			</form>
			 
		</li>
		<li class="row">
			<img class="rowpic" src="/images/supplier_search.png" width="80"/>
			<form id="checklist_search" action="" >
			<label>Area</label><input type="text" /><br/>
			<label>Name</label><input type="text" /><br/>
			<label>Industry</label><input type="text" /><br/>
			<label>Type</label><input type="text" /><br/>
			<label>Supplier Code</label><input type="text" /> 
			<input class="button" type="submit" id="createchecklistbtn" value="search" class="button"/>
			</form>
			 
		</li>
		</ul>
		<div class="clear"></div>
	
		<div id="contentresult">
		<table id="checklist_table">
			<tr class="checklist_table_header">
				 
				<th width="280">Supplier Name</th>
				<th width="100">Supplier Code</th>
				<th width="20">Supplier Type</th>
				<th width="50">Industry</th>
				<th width="50">Area</th>
				<th width="30">Edit</th>
				<th width="30">Delete</th>
				 
			</tr>
			
			<tr class="checklist_table_content">
				<td>HK logistic LTD</td>
				<td>001</td>
				<td>casing</td>
				<td>Manfacturing</td>
				<td>Shanghai</td>
				<td><input class="button" type="button" value="Edit"></td>
				<td><input class="button" type="button" value="Delete"></td>
			</tr>
			
			<tr class="checklist_table_content">
				<td>China Mobile LTD</td>
				<td>002</td>
				<td>Mould</td>
				<td>Manfacturing</td>
				<td>Shanghai</td>
					<td><input class="button" type="button" value="Edit"></td>
				<td><input class="button" type="button" value="Delete"></td>
			 
			</tr>
		</table>	
		</div>
	 
	</div>

	
	
</div>