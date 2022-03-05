@extends('layouts.masterpems')
@section('PageTitle', 'NBC Nazlawi Business College')
@section('Description',('This is Home Page Description'))
@section('content')  
       
<style>
td{
	margin:0px;
	padding:0px;
	font-size:12px;
}
th{
	margin:0px;
	padding:0px;
	font-size:12px;
}
</style>  
              
     
<div class="container">
<div class="col-lg-14">
	<div class="panel panel-default">
	<div class="panel-body">

<div class="row">
	<div class="col-lg-5">
		<div class="panel panel-default">
	<div class="panel-heading">Member Details Section</div>
		<div class="panel-body">
			<form method="POST" action="/pems/certificateq" accept-charset="UTF-8">
			{{ csrf_field() }}
				<label for="userid"> Select Member</label>
				<select id="userid" name="userid">
					<option value="0">Select a Member</option>
					@foreach($users as $user)
					<option value="{{$user->student_id}}">{{$user->name}}</option>
					@endforeach
					</select>
				<input name="process" type="hidden" value="byselect">
				<input class="btn btn-default" type="submit" value="Choose">

			</form>
				Or
				
			<form method="POST" action="/pems/certificateq" accept-charset="UTF-6">
			{{ csrf_field() }}
				<label for="memberid">Enter Member Number:</label>
				<input name="userid" type="text" value="{{$member->student_id}}" id="memberid">
				<input name="process" type="hidden" value="byid">
			<input class="btn btn-default" type="submit" value="Find">
				


				</form>

				
			</div>

		</div>
	</div> <!-- end of 6 -->

	<div class="row">
			<div class="col-lg-14">
			<div class="panel panel-default">
				<div class="panel-heading">Apply Exemptions Section</div>
				<div class="panel-body">
				Exam ScoreCard for: <img src='{{asset("/public/".$member->avatar)}}' >

				</div>
				</div>
				</div>
				</div>
				</div>
 
@if($member->student_id > 0)	
		<div class="row">
			<div class="col-lg-14">
			<div class="panel panel-default">
				<div class="panel-heading">Apply Exemptions Section</div>
				<div class="panel-body">
				Exam ScoreCard for: {{$member->name}}


				<table class="table">
				<thead>
					<tr>
						<th>Code</th>
						<th>Title</th>
						<th>Exam Status</th>
						<th>Percentage</th>
						<th>Attemp</th>
						<th>Date</th>
						<th>Level</th>
					</tr>
				</thead>
						<?php $exams = DB::table('exam')->where('examtitle','!=','Empty')->get(); ?>
						@foreach($exams as $e)
						<form action="updateexamresult" method="post">
						@csrf
						<tr>	
						<th>	{{$e->realcode}}</th>
						<th>	{{$e->examtitle}}</th>
   						<th>
						   <input type="hidden" name="examcode" value="{{$e->examcode}}" >
				<input name="pass" value=" 
		
<?php 
$res =DB::table('ref_result')->where('examcode',$e->examcode)->where('student_id',$member->student_id)->get();
		$count =DB::table('ref_result')->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
		//echo $count.'<br>'
		;
		if($count == 0){ $countavilable = 0;
				echo 'Available';
			}else{
				$exempt = 'Open';
				$countExempt =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
				$ref_result =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
					if($countExempt != 0)
					{echo 'Open';
 						  
						}else{
							$exempt = 'In progress';
							$countExempt =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
							$ref_result =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
								if($countExempt != 0)
								{echo 'In progress';
									   
									}else{$exempt = 'Exempt';
							$countExempt =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
							$ref_result =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
								if($countExempt != 0)
								{echo 'Exempt';
									   
									}else{
								
						$passing = 'Pass';
						$countpass =DB::table('ref_result')->where('pass',$passing )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
							if($countpass != 0){echo 'Pass';
 
							}else{
								echo 'Faield';
 							}
 					}
			}}}
		   
		  ?>" >

						   </th>
						  
						   <td>
	<?php $res =DB::table('ref_result')->where('examcode',$e->examcode)->where('student_id',$member->student_id)->get();
		$count =DB::table('ref_result')->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
		echo $count;
	 
			//$countall = $countavilable + $countExempt + $countpass; echo '<br>'.$countall.'<br>';
?>
		</td>
<td><input type="text" name="percentage" value="<?php 
$res =DB::table('ref_result')->where('examcode',$e->examcode)->where('student_id',$member->student_id)->get();
		$count =DB::table('ref_result')->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
		//echo $count.'<br>'
		;
		if($count == 0){ $countavilable = 0;
				echo 'Available';
			}else{
				$exempt = 'Open';
				$countExempt =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
				$ref_result =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
					if($countExempt != 0)
					{echo 'Open';
 						  
						}else{
							$exempt = 'In progress';
							$countExempt =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
							$ref_result =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
								if($countExempt != 0)
								{echo 'In progress';
									   
									}else{$exempt = 'Exempt';
							$countExempt =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
							$ref_result =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
								if($countExempt != 0)
								{echo 'Exempt';
									   
									}else{
								
						$passing = 'Pass';
						$countpass =DB::table('ref_result')->where('pass',$passing )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
							if($countpass != 0){echo 'Pass';
 
							}else{
								echo 'Faield';
 							}
 					}
			}}}
		   
		  ?>"></td>
		<td><input type="date" name="created_at" value="
						   
<?php 


$res =DB::table('ref_result')->where('examcode',$e->examcode)->where('student_id',$member->student_id)->get();
		$count =DB::table('ref_result')->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
		//echo $count.'<br>'
		;
		if($count == 0){ $countavilable = 0;
				echo ' ';
			}else{
				$exempt = 'Open';
				$countExempt =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
				$ref_result =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
					if($countExempt != 0)
					{echo  $ref_result->created_at;
 						  
						}else{
							$exempt = 'In progress';
							$countExempt =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
							$ref_result =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
								if($countExempt != 0)
								{echo  $ref_result->created_at;
									   
									}else{$exempt = 'Exempt';
							$countExempt =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
							$ref_result =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
								if($countExempt != 0)
								{echo $ref_result->created_at;
									   
									}else{
								
						$passing = 'Pass';
						$ref_result =DB::table('ref_result')->where('pass',$passing )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
						$countpass =DB::table('ref_result')->where('pass',$passing )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
							if($countpass != 0){echo  $ref_result->created_at;
 
							}else{
								echo  'DATE';//$ref_result->created_at;
 							}
 					}
			}}}
?>" >
						   </td>
						   <td>
						<input type="hidden" name="id" value="<?php 


$res =DB::table('ref_result')->where('examcode',$e->examcode)->where('student_id',$member->student_id)->get();
		$count =DB::table('ref_result')->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
		//echo $count.'<br>'
		;
		if($count == 0){ $countavilable = 0;
				echo ' ';
			}else{
				$exempt = 'Open';
				$countExempt =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
				$ref_result =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
					if($countExempt != 0)
					{echo $ref_result->id; //  'Result Not Found';
 						  
						}else{
							$exempt = 'In progress';
							$countExempt =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
							$ref_result =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
								if($countExempt != 0)
								{echo  $ref_result->id;
									   
									}else{$exempt = 'Exempt';
							$countExempt =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
							$ref_result =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
								if($countExempt != 0)
								{echo $ref_result->id;
									   
									}else{
								
						$passing = 'Pass';
						$ref_result =DB::table('ref_result')->where('pass',$passing )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
						$countpass =DB::table('ref_result')->where('pass',$passing )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
							if($countpass != 0){echo  $ref_result->id;
 
							}else{
								echo 'RESULLT NOT FOUND'; // $ref_result->id;
 							}
 					}
			}}}
?>">
						<input type="hidden" name="userid" value="{{$member->student_id}}">
			<input type="text" name="level" value="<?php 


$res =DB::table('ref_result')->where('examcode',$e->examcode)->where('student_id',$member->student_id)->get();
$count =DB::table('ref_result')->where('level','!=',Null)->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
$res2 =DB::table('ref_result')->where('level','!=',Null)->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
//echo $count.'<br>'
		;
		if($count == 0){ $countavilable = 0;
				echo 'Null';
			}else{ 				//echo $res2->level;

				$exempt = 'Open';
				$countExempt =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
				$ref_result =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
					if($countExempt != 0)
					{echo  $ref_result->level;
 						  
						}else{
							$exempt = 'In progress';
							$countExempt =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
							$ref_result =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
								if($countExempt != 0)
								{echo  $ref_result->level;
									   
									}else{$exempt = 'Exempt';
							$countExempt =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
							$ref_result =DB::table('ref_result')->where('pass',$exempt )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
								if(($countExempt != 0)&&($ref_result->level != Null))
								{echo $ref_result->level;
									   
									}else{
								
						$passing = 'Pass';
						$ref_result =DB::table('ref_result')->where('pass',$passing )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->first();
						$countpass =DB::table('ref_result')->where('pass',$passing )->where('examcode',$e->examcode)->where('student_id',$member->student_id)->count();
							if(($countpass != 0)&&($ref_result->level != ' ')){echo  $ref_result->level;
 
							}else{
								echo 'null ';
								//echo  $ref_result->level;
 							}
 					}
			}}}
?>">
						   </td>
						   <td><input type="submit"   value="Edit"></td>
						</tr>
					
						</form>
						@endforeach
 				</table>

				</div>
				</div>
			</div>
		
</div> <!-- end of 12 -->
				


						
				
								</div> <!-- end of row -->
							<div class="row">
					<div class="col-lg-6">
						<div class="panel panel-default">
							<div class="panel-heading">RPLE COGS Section</div>
							<div class="panel-body">

								<form method="POST" action="/membershipicertificate" accept-charset="UTF-8">
								@csrf
								
								<div class="form-group">
								<label for="addpicture">Add Member Picture to CoGS </label>
								<input name="addpicture" type="checkbox" value="yes" id="addpicture">
								</div>
								<div class="form-group">
									<label for="expiredate">Expiry Date:</label>
								<input class="form-input" id="expiredate" name="expiredate" type="date" value="" required>	
								</div>
								<div class="form-group">
								<select name="certificates"><option value="0">Select An Award</option>
								@foreach($levels as $level)
									<option value="{{$level->id}}">{{$level->level}}</option>
								@endforeach
								</select>
								</div>
 								<input name="student_id" type="hidden" value="{{$member->student_id}}">
								<input class="btn btn-danger" type="submit" value="Download">
								</form>
							</div>
						</div>
					</div>
				
				<!-- end of fellows -->

					<!-- begin of qualifications certificates -->
					<div class="col-lg-6">
						<div class="panel panel-default">
							<div class="panel-heading">Qualification Certificates Section</div>
							<div class="panel-body">
									<!-----------------------OLD ----------------------/dynamic_pdf/pdf2-------->
								<form method="POST" action="/qualificationcertificates" accept-charset="UTF-8">
								@csrf								
								<div class="form-group">
								<label for="graduatedate">Override The Qualifications Graduation Date:</label>
								<input class="form-input" id="graduatedate" name="graduatedate" type="date" value="" required>
								</div>
								<div class="form-group">
								<label for="certificates">Select an Academic QCF Qualification Type:</label>
								<select id="certificates" name="certificates">
									<option value="0">Select Certificate</option>
									<option value="1">Technical Accounting</option>
									<option value="2">Advanced Technical Accounting</option>
									<option value="3">Project Accounting</option>
									<option value="4">Corporate Accounting</option>
									<option value="5">Advanced Project Accounting</option>
									<option value=6>Advanced Corporate Accounting</option>
									<option value="7">Project Management</option>
									<option value="8">Information Technology</option>
									</select>
								</div>
								<input name="student_id" type="hidden" value="{{$member->student_id}}">
								<input class="btn btn-danger" type="submit" value="Download Pdf">
								</form>
							</div>
						</div>
					</div>
					<!-- end of qualification certificates-->


					<!-- begin of transcript -->
						<div class="col-lg-6">
						<div class="panel panel-default">
							<div class="panel-heading">Transcript Section</div>
							<div class="panel-body">
								<form method="POST" action="/transcriptsectioncertificate" accept-charset="UTF-8">
								@csrf
								<div class="form-group">
								</div>
								<div class="form-group">
								<label for="graduatedate">Override The  Graduation Date:</label>
								<input class="form-input" id="graduatedate" name="graduatedate" type="date" value="" required>
								</div>
								<div class="form-group">
								<label for="registerdate">Override The Registeration  Date:</label>
								<input class="form-input" id="registerdate" name="registerdate" type="date" value="" required> 
								</div>
								<div class="form-group">
								<label for="addpicture">Add Member Picture to Transcript </label>
								<input name="addpicture" type="checkbox" value="yes" id="addpicture" >
								<select name="certificates"><option value="0">Select a Member</option>
								<option value="17">Fellow Qualified Accountant</option>
								<option value="16">Registered Qualified Accountant</option>
								<option value="15">Qualified Accounting Technician</option>
								<option value="14">Information Technology Award</option>
								<option value="13">Certified Project Managers </option>
								<option value="12">Fellow Certified Project Accountant &amp; Corporate Executive Accountant &amp; Certified Project Managers</option>
								<option value="11">Fellow Certified Corporate Executive Accountant</option>
								<option value="10">Fellow Certified Project Accountant</option>
								<option value="9">Certified Corporate Executive Accountant &amp; Certified Project managers</option>
								<option value="8">Certified project &amp; Corporate Executive Accountant &amp; Project Mangers</option>
								<option value="7">Associate Certified Corporate Executive Accountant</option>
								<option value="6">Associate Certified Project Accounting &amp; Certified Project Managers</option>
								<option value="5">Advanced Accounting Technician &amp; Certified Project Managers</option>
								<option value="4">Advanced Accounting Technician</option>
								<option value="3">Graduate Accounting Technician &amp; Certified Project Managers</option>
								<option value="2">Graduate Accounting Technician</option>
								<option value="1">Affiliate Member</option>
								</select>
								</div>
								<div class="form-group">
								<label for="certifiname">Certificate Name</label>
								<input class="form-control" name="certifiname" type="text" value="" id="certifiname" required>
								<input name="student_id" type="hidden" value="{{$member->student_id}}">

								</div>
								<div class="form-group">

 								<input class="btn btn-danger" type="submit" value="Create Draft QCF Transcript">
								</div>
								</form>
							</div>
						</div>
					</div>
@endif
					<!-- end of transcript -->
				</div>
			
			
						
				</div>
				</div>
				</div>
</div> <!-- end of 12 -->
				



  
</div>
                             
@endsection