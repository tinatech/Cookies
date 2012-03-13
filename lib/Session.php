<?php

/* Session.php - Session handling
 *
 * Description:
 *
 * Class that handles all session transactions.
 *
 *
 * @project Webshop
 * @author Petter Walbø Johnsgård
 * @version 0.1b
*/

class Session {
	
	/* Function that receives a row to order, and ordertype
	 *
	 * Returns:
	 * ORDER BY `$row` ASC/DESC
	 *
	 * example:
	 * $row = "fname"
	 * $order = "ASC"
	 * $result = Session->setOrder($row, $order);
	 *
	 *
	 * echo $result;  // ORDER BY `fname` ASC
	 *
	 */
	function setSortBy($session, $row, $order) {
		$_SESSION[''.$session.''] = 'ORDER BY `'.$row.'` '.$order;
		}
			
}
