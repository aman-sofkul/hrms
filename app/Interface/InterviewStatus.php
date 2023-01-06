<?php
namespace App\Interfaces;
 interface InterviewStatus{
 	const Pending = 0;
 	const First Round Done = 1;
 	const Second Round Done = 2; 
 	const FinalRound Done = 3;
 	const Assignment Submit = 4;
 	const Reschedule = 5;
 	const Result Awaiting = 6;

	}

?>