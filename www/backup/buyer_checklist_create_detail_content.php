 <div id="content">
	
	<div id="leftcol"><img src="/images/checklist.png"></div>
	
	<div id="rightcol">
	
		
		<ul>
		<li class="row">
			<img class="rowpic" src="/images/checklist_create.png" width="80"/>
			<div class="rowtext">
			Buyer can simply tick the questions which needs to be included in the checklist.
			
			[check list name] [version] 
			</div>
			<form method="post" action="/?user=<?php echo $user;?>&function=checklist&action=save_checklist">
			<input type="submit" class="button" name="save" value="save_check_list"  />
			</form>
			<form>
			<input type="button"  class="button" name="delete" value="delete_check_list"/>
			 </form>
		</li>
	 
		</ul>
		<div class="clear"></div>
	
		<div id="checklist_detail_div">
		<table id="checklist_detail_table">
			<tr>
				<td colspan="5" class="checklist_detail_table_cat"  >
				<select name="cat">
				<option value="1">Quality management system</option>
				<option value="2">Environmental Management System</option>
				<option value="3">Health & Safety Management System</option>
				<option value="4">Social Accountability</option>
				<option value="5">Security management system</option>
				</select>
				</td>
				 
			</tr>
			<tr class="checklist_detail_table_subcat">
				<td colspan="5"><select name="subcat">
				<option value="1">System Requirement</option>
				<option value="2">Management Responsibility</option>
				<option value="3">Resource management</option>
				<option value="4">Product/ Service realization</option>
				<option value="5">Review Requirement</option>
				</select></td>
				 
			</tr>
		</table>
		<table id="checklist_detail_table_header">
			<tr>
				<th ><input type="checkbox" id="checkallmc" onclick=""/></th>
				<th>Requirement</th>
				<th>Risk Code</th>
				<th>Photo</th>
				<th>Law</th>
				
			</tr>
			<tr class="checklist_detail_table_content1">
				<td><input type="checkbox" /></td>
				<td>Does the factory haev a copy of valid laws and regulations on child labour or understand its requirements? </td>
				<td>HIGH</td>
				<td>YES</td>
				<td>Child Law 1.3</td>
				 
			</tr>
			<tr class="checklist_detail_table_content2">
				<td  width="5%"><input type="checkbox" /></td>
				<td>Does the factory haev a copy of valid laws and regulations on child labour or understand its requirements? </td>
				<td>HIGH</td>
				<td>YES</td>
				<td>Child Law 1.3</td>
				 
			</tr>
					<tr class="checklist_detail_table_content1">
				<td><input type="checkbox" /></td>
				<td>Does the factory haev a copy of valid laws and regulations on child labour or understand its requirements? </td>
				<td>HIGH</td>
				<td>YES</td>
				<td>Child Law 1.3</td>
				 
			</tr>
			<tr class="checklist_detail_table_content2">
				<td><input type="checkbox" /></td>
				<td>Does the factory haev a copy of valid laws and regulations on child labour or understand its requirements? </td>
				<td>HIGH</td>
				<td>YES</td>
				<td>Child Law 1.3</td>
				 
			</tr>
		</table>

		<br/>
		<hr>	<br/>
		<div class="clean"></div>

		<table id="checklist_detail_tailor_make_table">
			<tr>
				<td colspan="5" class="checklist_detail_tailor_make_table_title">
				 Tailor Make MC
				</td>
				 
			</tr>
		 
			<tr>
				<th>id</th>
				<th>Requirement</th>
				<th>Risk Code</th>
				<th>Photo</th>
				<th>Law</th>
				
			</tr>
			<tr>
				<td>1</td>
				<td><input type="text" id="question" value="question1"/></td>
				<td><select id="riskcode"><option value="high">high</option>
				<option value="low">low</option>
				</select></td>
				<td><select id="photo"><option value="yes">yes</option>
				<option value="no">no</option>
				</select></td>
				<td><input type="text" id="law" value="law law law"/></td>
				
			</tr>
			<tr>
				<td>2</td>
				<td><input type="text" id="question" value="cursor here add new row plz"/></td>
				<td><select id="riskcode"><option value="high">high</option>
				<option value="low">low</option>
				</select></td>
				<td><select id="photo"><option value="yes">yes</option>
				<option value="no">no</option>
				</select></td>
				<td><input type="text" id="law" value=""/></td>
				
			</tr>
		</table>
		
		
		
		</div>
	 
	</div>

	
	
</div>