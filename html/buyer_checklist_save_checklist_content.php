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
			<input type="submit" name="save" value="save_check_list"  />
			</form><form>
			<input type="button" name="delete" value="delete_check_list"/>
			 </form>
		</li>
	 
		</ul>
		<div class="clear"></div>
	
		<div id="checklist_detail_div">
		 
		 

		<br/>
		<hr>	<br/>
		<div class="clean"></div>

		<table id="checklist_detail_tailor_make_table">
			<tr>
				<td colspan="5" class="checklist_detail_tailor_make_table_title">
				 Weight(%)
				</td>
				 
			</tr>
		 
			<tr>
				<th>field</th>
				<th>criteia</th>
				 
				<th>weight</th>
				 
				
			</tr>
			<tr>
				<td>Quality Management</td>
				<td>Documentation</td>
				<td>10% </td>
			 
				
			</tr>
			<tr>
				<td></td>
				<td>Quality</td>
				<td>90%</td>
				 
				
			</tr>
				<tr>
				<td></td>
				<td>Max total</td>
				<td>100%</td>
				 
				
			</tr>
			
			<tr>
				<th>field</th>
				<th>criteia</th>
				 
				<th>weight</th>
				 
				
			</tr>
			<tr>
				<td>Socail Accountability</td>
				<td>Child labour</td>
				<td>20% </td>
			 
				
			</tr>
			<tr>
				<td></td>
				<td>Forced labour</td>
				<td>80%</td>
				 
				
			</tr>
				<tr>
				<td></td>
				<td>Max total</td>
				<td>100%</td>
				 
				
			</tr>
		</table>
		
		
		
		</div>
	 
	</div>

	
	
</div>