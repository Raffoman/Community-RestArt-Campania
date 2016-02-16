<?php

/**
 * jQuery Voting System
 * @link http://www.w3bees.com/2013/09/voting-system-with-jquery-php-and-mysql.html
 */




include('config.php');


        
        if ($_SERVER['HTTP_X_REQUESTED_WITH']) {
	if (isset($_POST['postid']) AND isset($_POST['action'])) {
        $postId = (int) mysql_real_escape_string($_POST['postid']);
        
        
		# check if already voted, if found voted then return
		if (isset($_SESSION['post_vote'][$postId])) return;


		# query into db table to know current voting score 
		$query7 = mysql_query("
			SELECT post_vote
			from ac_post
			WHERE post_id = '{$postId}' 
			LIMIT 1" );

		# increase or dicrease voting score
		if ($data1 = mysql_fetch_array($query7)) {
			if ($_POST['action'] === 'up'){
				$voti = ++$data1['post_vote'];
			} else {
				$voti = --$data1['post_vote'];
			}
			# update new voting score
			mysql_query("
				UPDATE ac_post
				SET post_vote = '{$voti}'
				WHERE post_id = '{$postId}' ");

			# set session with post id as true
			$_SESSION['post_vote'][$postId] = true;
		}
	}
}


?>