<?php
	echo '<table border=0 cellspacing=2 cellpadding=2 width=100%>
			<tr>
				<td>Menu</td>
			</tr>';
	$i=1;
	 while ($i <= 5)
	 {
	 	echo "<tr>
				<td colspan=2>Menu 1</td>
			  </tr>
			  <tr>
			  	<td></td>
				<td>";
					$j=1;
					while ($j<=$i)
					{
						echo "<table>
								<tr>
									<td colspan=2>Menu 1.2</td>
								</tr>
								<tr>
									<td></td>
									<td>";
										$z=1;
										while($z<=$j)
										{
											echo "<table>
													<tr>
														<td colspan=2>&nbsp;&nbsp;Menu 1.2.3</td>
													</tr>
												  </table>";
											
											$z++;
										}
									echo"</td>
								</tr>
							  </table>";
						$j++;
					}
				echo"</td>
			</tr>";
	 
	 	$i++;
	 }
?>