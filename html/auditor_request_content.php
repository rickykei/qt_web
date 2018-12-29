 <div id="content">
	
	<div id="leftcol"><img src="/images/schedulinglogo.png"></div>
	
	<div id="rightcol">
	
		
		<ul>
	 
		<li class="row">
			<img class="rowpic" src="/images/search.png" width="80"/>
			<form id="requestlist" action="" >
			<label>Buyer CD</label><input type="text" /><br/>
			<label>Req id</label><input type="text" /><br/>
			<label>Req Report Code</label><input type="text" /><br/>
			<label>Sch Start Date</label><input type="text" /><br/>
			<label> End Date</label><input type="text" />  <br/>
			<label>tar Start Date</label><input type="text" /><br/>
			<label> End Date</label><input type="text" />  <br/>
			<label>Request Status</label><select name="select"><option value="A">AUDITOR ASSIGNED</option><option value="P">PROCESSING</option><option value="C">COMPLETE</option> <option>VOID</option><br/>
			<input class="button" type="submit" id="search" value="search" class="button"/>
			</form>
			 
		</li>
		</ul>
		<div class="clear"></div>
	
		<div id="contentresult">
		<table id="requestlist_table">
			<tr class="requestlist_table_header">
				
				<th width="80">Req id</th>
				<th width="80">BuyerCD</th>
				<th width="280">Req Rep Code</th>
 			 	<th width="150">Sch Start Date</th>
				<th width="150">Sch End Date</th>
				<th width="150">Targ Start Date</th>
				<th width="150">Targ End Date</th>
			 
				<th width="150">Sts</th>
				<th width="30">Filling</th>
				 <th width="30">Pdf</th>
				 
			</tr>
			
			<tr class="requestlist_table_content">
				<td>1</td>
				<td>APPLE</td>
				<td>REQ1</td>
				 
				<td>2011-02-22</td>
				<td>2011-02-23</td>
				<td> </td>
				<td> </td>
				<td>R</td>
				<td><input class="button" type="button" value="Fill" onclick="window.open('auditor_filling form.html')" /></td>
				<td><input class="button" type="button" value="Pdf" onclick="" /></td>
			</tr>
			
			<tr class="requestlist_table_content">
					<td>2</td>
					<td>APPLE</td>
				<td>REQ2</td>
				 
				<td>2011-02-22</td>
				<td>2011-02-23</td>
				<td>2011-02-22</td>
				<td>2011-02-23</td>
				 <td>A</td>
				 
				<td><input class="button" type="button" value="Fill" onclick="window.open('auditor_filling form.html')" /></td>
				  	 <td><input class="button" type="button" value="Pdf"></td>
 			 
			</tr>
			<tr class="requestlist_table_content">
					<td>3</td>
					<td>APPLE</td>
				<td>REQ3</td>
			 
				<td>2011-02-22</td>
				<td>2011-02-23</td>
				<td>2011-02-22</td>
				<td>2011-02-23</td>
				 <td>P</td>
				 
				 <td><input class="button" type="button" value="Fill" onclick="window.open('auditor_filling form.html')" /></td>
				  	 <td><input class="button" type="button" value="Pdf"></td>
				 
			 
			</tr>
			 
		</table>	
		</div>
	 
	</div>

	
	
</div>