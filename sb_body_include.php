<div id="watchus_dialog">
	<div id="watchus_dialog_left"> <img src="sidebar_pkg/sidebar_img/sidebar_watchus2.png" width="78" height="56" alt="Whats Us" /> </div>
	<div id="watchus_dialog_right">
		<p class="dialog_title">Watch for new things!</p>
		<img src="sidebar_pkg/sidebar_img/hline.jpg" width="398" height="3" />
		<p class="dialog_text">Join our mailing list to learn about new Glean Learning Tools and other news about PLML!</p>
		<form action="sidebar_pkg/SF_Connector/insertlead.php" method="post">
			<input type="hidden" id="LeadSource" name="LeadSource" value="<?php echo preg_replace("/\.(org|com)$/", "", preg_replace("/^www\./", "", $_SERVER['HTTP_HOST'])); ?>">
		
			<div>
				<table>
					<tr>
						<td align="right"><p class="dialog_text">First Name</p></td>
						<td><input id="first_name" class="dialog_input" type="text" name="FirstName"  /></td>
					</tr>
					<tr>
						<td align="right"><p class="dialog_text">Last Name</p></td>
						<td><input id="last_name" class="dialog_input" type="text" name="LastName"  /></td>
					</tr>
					<tr>
						<td align="right"><p class="dialog_text">E-Mail</p></td>
						<td><input id="email" class="dialog_input" type="text" name="Email"  /></td>
					</tr>
					<tr>
						<td colspan="2"><p class="dialog_text">Are you with a school or school district in the US?</p></td>
					</tr>
					<tr>
						<td align="right"><p class="dialog_text"></p></td>
						<td><p class="dialog_radio_text" >
								<label>
									<input onClick="ShowSDSBOX()" type="radio" name="RadioGroup" value="yes" id="RadioGroup_0" checked="checked" />
									Yes</label>
								<label>
									<input onClick="HideSDSBOX()" type="radio" name="RadioGroup" value="no" id="RadioGroup_1" />
									No</label>
							</p></td>
					</tr>
					</table>
					<div id="statedisctrictschool_box">
					<table>
					<tr>
						<td align="right"><p class="dialog_text">Your State</p></td>
						<td><?php print_states_select_box('select_state'); ?></td>
					</tr>
					<tr>
						<td align="right"><p class="dialog_text">Your District</p></td>
						<td><div id="select_district_box"></div></td>
					</tr>
					<tr>
						<td align="right"><p class="dialog_text">Your School</p></td>
						<td><div id="select_school_box"></div></td>
					</tr>
					
					</table>
					</div>
					<table>
					<tr width="100%">
						<td align="center" width="100%" >
							<div id="info_box">
							</div>
							
							<div id="response_box">
								<input class="submit" onclick="SubmitData();" type="button" value=""  />								
							</div>
							

						</td>
						
					</tr>
					<tr>
						<td align="center" colspan="2"><p class="dialog_text"><span style="font-size:11px;">We do not share your info. Ever.</span> <a href='http://www.plml.org/privacy-policy' target='_blank' style="text-decoration: none;"><span style="font-size:11px; color:red; text-decoration:none;">Read our privacy policy.</span></a></p></td>
					</tr>
				</table>
				
			</div>
		</form>
	</div>
</div>
<div id="inventit_dialog">
	<div id="inventit_dialog_left"> <img src="sidebar_pkg/sidebar_img/sidebar_inventit2.png" width="75" height="78" alt="Invent It" /> </div>
	<div id="inventit_dialog_right">
		<p class="dialog_title">New Learning Tools</p>
		<img src="sidebar_pkg/sidebar_img/hline.jpg" width="398" height="3" />
		<p class="dialog_text">
		Every day we work hard to create new learning tools and to improve the ones we already have.
<br/><br/>
You--yes, you!--are an essential thought partner to our team. Join the Builders' Group to discuss new ideas, to test prototypes, to share relevant videos, or to help invent and test the best uses for technology in classrooms and libraries.
<br/><br/>
We need your help: join the PLML Glean Builders' Group! </p>
		<form action="sidebar_pkg/SF_Connector/insertlead.php" method="post">
			<input type="hidden" name="Volunteer" value="Builders List">
					
			<div>
				<table>
					<tr>
						<td align="right"><p class="dialog_text">First Name</p></td>
						<td><input id="first_name2"  class="dialog_input" type="text" name="FirstName"  /></td>
					</tr>
					<tr>
						<td align="right"><p class="dialog_text">Last Name</p></td>
						<td><input id="last_name2" class="dialog_input" type="text" name="LastName"  /></td>
					</tr>
					<tr>
						<td align="right"><p class="dialog_text">E-Mail</p></td>
						<td><input id="email2"  class="dialog_input" type="text" name="Email"  /></td>
					</tr>
					<tr>
						<td colspan="2"><p class="dialog_text">Are you with a school or school district in the US?</p></td>
					</tr>
					<tr>
						<td align="right"><p class="dialog_text"></p></td>
						<td><p class="dialog_radio_text" >
								<label>
									<input onClick="ShowSDSBOX()" type="radio" name="RadioGroup2" value="yes" id="RadioGroup2_0" checked="checked"/>
									Yes</label>
								<label>
									<input onClick="HideSDSBOX()" type="radio" name="RadioGroup2" value="no" id="RadioGroup2_1" />
									No</label>
							</p></td>
					</tr>
					</table>
					<div id="statedisctrictschool_box2">
					<table>
					<tr>
					
						<td align="right"><p class="dialog_text">Your State</p></td>
						<td><?php print_states_select_box('select_state2'); ?></td>
					</tr>
					<tr>
						<td align="right"><p class="dialog_text">Your District</p></td>
						<td><div id="select_district_box2"></div>
						</td>
					</tr>
					<tr>
						<td align="right"><p class="dialog_text">Your School</p></td>
						<td><div id="select_school_box2"></div>
						</td>
					</tr>
					</table>
					</div>
					<table>
					<tr width="100%">
						<td align="center" width="100%" >
							<div id="info_box2">
							</div>
								
							<div id="response_box2">
								<input class="submit" onclick="SubmitData2();" type="button" value=""  />
							</div>
						</td>
					</tr>
					<tr width="100%">
						<td align="center"><p class="dialog_text"><span style="font-size:11px;">We do not share your info. Ever.</span> <a href='http://www.plml.org/privacy-policy' target='_blank' style="text-decoration: none;"><span style="font-size:11px; color:red; text-decoration:none;">Read our privacy policy.</span></a></p></td>
					</tr>
				</table>
			</div>
		</form>
	</div>
</div>
<div id="loveit_dialog">
	<div id="loveit_dialog_left"> <img src="sidebar_pkg/sidebar_img/sidebar_loveit2.png" width="82" height="82" alt="Love It" /> </div>
	<div id="loveit_dialog_right">
		<p class="dialog_title">Boolify</p>
		<img src="sidebar_pkg/sidebar_img/hline.jpg" width="398" height="3" />
		<p class="dialog_text">
		Love Who-Is? <br /><br />The Public Learning Media Lab (PLML) is a 501(c)(3) nonprofit organization. We depend on donations and grants to create and maintain our many free Glean Learning Tools, such as Boolify. Please show your appreciation by making a contribution to support our work.  
			<br /><br />
			Donate instantly online through FirstGiving. Your donation is fully tax deductible.<br />
			<a target="_blank" href="http://www.firstgiving.com/31337"><img border="0" src="sidebar_pkg/sidebar_img/firstgiving.jpg" width="158" height="33" alt="First Giving" vspace="10"/></a> <br />
			Alternatively, you can support us every time you make a purchase through Amazon.com. While you may not notice anything visibly different, a portion of your order will be contributed to PLML. Click on the Amazon logo below to start shopping and contributing.<br />
			<a href="http://www.plml.org/fractions-of-joy"><img border="0" src="sidebar_pkg/sidebar_img/amazon.jpg" width="110" height="41" alt="Amazon" vspace="10"/></a> </p>
	</div>
</div>