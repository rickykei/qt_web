 <div id="content">
	
	<div id="leftcol"><img src="/images/schedulinglogo.png"></div>
	
	<div id="rightcol">
	
		
		<ul>
		<li class="row">
			<img class="rowpic" src="/images/calendar.png" width="80"/>
			To add a new request from the check list template, click here!
			<form  id="checklist_create" action="create_new_checklist.php" >
				<input   type="button" alt="buyer_scheduling_create.php?KeepThis=true&height=450&width=450&modal=true" title="" class="thickbox button" value="create"/>
			</form>
			 
		</li>
		<li class="row">
			<img class="rowpic" src="/images/supplier_search.png" width="80"/>
			<form id="checklist_search" action="" >
			<label>Req id</label><input type="text" /><br/>
			<label>Template Name</label><input type="text" /><br/>
			<label>Supplier Code</label><input type="text" /><br/>
			<label>Sch Start Date</label><input type="text" /><br/>
			<label>Sch End Date</label><input type="text" /> 
			<input class="button" type="submit" id="createchecklistbtn" value="search" class="button"/>
			</form>
			 
		</li>
		</ul>
		<div class="clear"></div>
	
		<div id="contentresult">
		<table id="checklist_table">
			<tr class="checklist_table_header">
  			 <th width="80">Req id</th>
				<th width="280">Template Name</th>
				<th width="100">Supplier Code</th>
			 
				<th width="150">Sch Start Date</th>
				<th width="150">Sch End Date</th>
				<th width="30">Edit</th>
				<th width="30">Delete</th>
				 
			</tr>
			
			<tr class="checklist_table_content">
				<td>1</td>
				<td>001</td>
				<td>supp01</td>
				<td>2011-02-22</td>
				<td>2011-02-23</td>
				 
				<td><input class="button" type="button" value="Edit"></td>
				<td><input class="button" type="button" value="Delete"></td>
			</tr>
			
			<tr class="checklist_table_content">
				<td>2</td>
				<td>002</td>
					<td>supp03</td>
			<td>2011-02-22</td>
				<td>2011-02-23</td>
				 
					<td><input class="button" type="button" value="Edit"></td>
				<td><input class="button" type="button" value="Delete"></td>
			 
			</tr>
		</table>	
		</div>
	 
	</div>

	
	
</div>