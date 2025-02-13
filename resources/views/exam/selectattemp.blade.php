@extends('layouts.master')
@section('PageTitle', 'NBC')
@section('Description',('This is Home Page Description'))
@section('content')
<script type="text/javascript">
function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };

$(document).ready(function(){
     $(document).on("keydown", disableF5);
});
</script>






<style>
    .modal-ku {
        width: 750px;
        margin: auto;
    }
</style>

  <!-- Pre-loader start -->
  <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
            </div>
        </div>
    </div>

<!-- Exam Over -- -------------------------------------- -->
<div class="container-fluid bg-secondary hidden" style="height:100vh" id="examover">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Exam Over</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body alert alert-primary">
                    <div class="row" style="margin:0px;">
                        <div class="col-sm-14" >
                        <h3> Please Wait ....<h3>
                        <h3> Don't Press Back Button<h3>
                        </div>
                        <div class="col-sm-14" >
                          <h3>  Don't Refresh <h3>
                        </div>
                        <div class="col-sm-14 hidden" id="active_process">
                            <span class="card-text "> <i class="fa fa-spinner fa-spin" ></i> Pls Wait Processing Your Response.... </span>
                        </div>
                    </div>
                </div>
                
                <!-- Modal footer --> 
                <div class="modal-footer" id="examover_footer">
                  <!--  <button type="button" onclick="home()" class="btn btn-warning">Home</button>
                    <button type="button" onclick="result()" class="btn btn-warning">Result</button>-->
                </div> 
                
        </div>
    </div>
</div>

    <!-- Instruction -- -->
    <!--- Error -- - -->
    <div id="errorModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Error</h4>
            </div>
            <div class="modal-body">
                <p>We can’t connect to the server</p>
                <p>Try again later. </p>
                <p>Check your network connection.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>

        </div>
    </div>

<div class="container-fluid bg-secondary" id="instruction" >

<!--<div class="modal" tabindex="-1" role="dialog">-->
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Exam Instruction</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<table>

      <?php   
                    $exams = DB::table('exam')->where([['examcode',19],['examtitle','!=','Empty']])->limit(20)->get();
                    ?>

<thead>
     
                    @foreach($exams as $exam)
                    <tr style="background-color:00f;">
                    <th style="background-color:00f;"><h4>{{$exam->realcode}} </h4> </th>
                    <th><h4>{{ $exam->examtitle}} </h4></th>
                    <td>

                    <?php 
                    $userid = Auth::user()->student_id;
                         $proctors = DB::table('proctordate')->where([['subject_id',19],['user_id',$userid],['used',0]])->count() ;
                            if($proctors != 0){
                                //echo '<a href="http://127.0.0.1:8001/exam/start/'.$exam->examcode.'/'.$  title.'/NBC/SSC/120"><button class="btn btn-success">Start Exam</button></a>';
                            }else{ //echo '<button class="btn btn-danger" disabled>Not Ready</button>';

                            }
                    ?>
                    
                    </td>
                </tr>
                @endforeach
</table>
<?php $timeing = 400; ?>
     <!--   <p>Modal body text goes here.</p>-->
        <table class="table table-bordered">
    <thead>
      <tr style="background-color:00f;">
        <th style="background-color:00f;">No. of Question : </th>
        <th><span class="text-right nopadding" id="total_number_of_question"></span></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Total Marks :</td>
        <td><span class="text-right nopadding" id="Total_Marks"></span></td>
      </tr>
     <tr>
        <td>Re-Attempt Allowed :</td>
        <td><span class="text-right nopadding">Yes</span></td>
      </tr>
      <tr>
        <td>Exam Time : </td>
        <td><span class="text-right nopadding">{{$timeing}} min</span></td>
      </tr>
  </tbody>
  </table>

                        <h4 class="modal-title">Notes</h4>
                        <b>
                        <div class="col-sm-14">
                <input type="button" class="btn btn-outline-danger select-button" value="Don't press back Button"> 
                        </div>
                        <div class="col-sm-14">
                        <input type="button" class="btn btn-outline-danger select-button" value=" Result Declaration After Exam"> 
                                                   </div>
                        <div class="col-sm-14">
                       <input type="button" class="btn btn-outline-danger select-button" value="Marks and Neg. Marks Show during Exam"> 
                                                    </div>
                        <div class="col-sm-14">
                        <input type="button" class="btn btn-outline-danger select-button" value=" Click 'Start' button below to start Examm"> 
                        </div>

                        </b>
    
      </div>
 
       <!-- Modal footer --> 
        <div class="modal-footer">
            <div id="examloader" class="hidden">
                <div class="ball-scale">
                    <div class='contain'>
                        <div class="ring"><div class="frame"></div></div>
                        <div class="ring"><div class="frame"></div></div>
                        <div class="ring"><div class="frame"></div></div>
                        <div class="ring"><div class="frame"></div></div>
                        <div class="ring"><div class="frame"></div></div>
                        <div class="ring"><div class="frame"></div></div>
                        <div class="ring"><div class="frame"></div></div>
                        <div class="ring"><div class="frame"></div></div>
                        <div class="ring"><div class="frame"></div></div>
                        <div class="ring"><div class="frame"></div></div>
                    </div>
                </div>
            </div> 
            <div class="alert alert-success hidden" id="pls_wait_preparing_exam_room">Pls wait ... Preparing Exam Room</div>
            <button type="button" onclick="startExam()" id="startexambutton" class="btn btn-warning"    
            <?php 
/*
                foreach($exams as $exam){  $userid = Auth::user()->student_id;
                    if($exam->examcode == 66 ){}else{
                        $proctors = DB::table('proctordate')->where([['subject_id',19],['user_id',$userid],['used',0]])->count() ;
                        if($proctors != 0){ 
                            $p1 = DB::table('proctordate')->where([['subject_id',19],['user_id',$userid],['used',0]])->first() ;
                                //foreach($proctors1 as $p1)
                                        $today = date('Y-m-d');
                                        $n_today = strtotime($today);
                                        $n_pro_date = strtotime($p1->procrordate);
                                            if($n_today === $n_pro_date ){ 

                                                }else{ echo 'disabled';}
                        }else{ echo 'disabled';}
                    }}
*/
             ?>
<?php  //$userid = Auth::user()->student_id;  $today = date('Y-m-d');
//$p1 = DB::table('proctordate')->where([['subject_id',19],['user_id',$userid],['used',0]])->first() ;?>
                              
            >Start Exam</button>
        </div> <!--
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
      </div>
    </div>
  </div>
</div >
<!-----------------------TIMERRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR__________________________________________________>-->
<script>

function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

window.onload = function () {
    var fiveMinutes = 60 * '{{$timeing}}',
        display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
};

</script>
<br><br><br><br>
<div>Exam closes in <span id="time">{{$timeing}}:00</span> minutes!</div>

<br><br><br><br>

<!-----------------------TIMERRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR__________________________________________________>-->




<form action="instruction" method="post">
@csrf
<input type="text" name="attempno" value="{{$attempno}}">
<input type="submit" value="Select Attemp">
<table class="table">
    <tr>
    <td>#</td><td>Student_id</td><td>Examcode</td><td>mailing</td><td>Pass</td><td>Level</td><td>percetage</td>
    </tr>
    <tr>
    <td>{{$attempdata->id}}</td><td>{{$attempdata->student_id}}</td><td>{{$attempdata->examcode}}</td><td>{{$attempdata->mailing}}</td><td>{{$attempdata->level}}</td><td>{{$attempdata->percetage}}</td>
    </tr>
</table>
<br><br>

<table class="table">
    <tr>
    <td>#</td><td>Student_id</td><td>Ques_id</td><td>SelectedOption</td><td>Attempno</td><td>givenmarks</td><td>timing</td><td>Serial</td>
    </tr>    
    @foreach($resultdata as $q)

    <?php $question = DB::table('exam_question')->where('id',$q->ques_id)->first(); 
    ?>
    <tr>
    <td>{{$q->id}}</td><td>{{$q->student_id}}</td><td>{{$q->ques_id}}:<table class="table">
    <tr><td> <?php echo $question->question; ?></td></tr>
    <tr><td>Option A  <?php echo $question->option_A; ?></td></tr>
    <tr><td>Option B  <?php echo $question->option_B; ?></td></tr>
    <tr><td>Option C  <?php echo $question->option_C; ?></td></tr>
    <tr><td>Option D  <?php echo $question->option_D; ?></td></tr>
    <tr><td>Correct Answer  <?php echo $question->correct_answer.' '.$question->correct_option; ?></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
</table>    
    
    </td><td>{{$q->selected_option}}</td><td>{{$q->attempno}}</td><td>{{$q->givenmarks}}</td><td>{{$q->timing}}</td><td>{{$q->serial}}</td>
    </tr>
    @endforeach
</table>

@foreach($resultdata as $q)

<?php $question = DB::table('exam_question')->where('id',$q->ques_id)->first(); 
?>
<?php $timeing = 40; ?>
<div class="card">
                    <div class="alert alert-light text-justify col-sm-12">
                    <input type="hidden" class="current_qusetion_no" id="" value='{{$question->id}}'>
                    
                    <h4 class="modal-title"><b>Ques no. <span class="setqno">{{$question->id}}</span> : </b> {!!$question->question!!}</h4>
                    @if ($question->image != NULL)
                        <div>
                        <img class="img-responsive center-block" src="http://www.ACPA-Global.com">
                        </div>
                    @endif
                    </div>
                    <div class="card-block ">
                        <!-- radio button -->
                        <form action="#" >
                            <p class="col-sm-12">
                                <input type="radio" id="optionA{{$question->id}}" name="option{{$question->id}}" value="A">
                                <label for="optionA{{$question->id}}">{!!$question->option_A!!}</label>
                                @if ($question->image_A != NULL)
                                    <div>
                                        <img class="img-responsive center-block" style="max-width: 250px; max-height: 359px;"  src="http://www.ACPA-Global.org">
                                    </div>
                                @endif
                            </p>
                            <p class="col-sm-12">
                                <input type="radio" id="optionB{{$question->id}}" name="option{{$question->id}}" value="B">
                                <label for="optionB{{$question->id}}" >{!!$question->option_B!!}</label>
                                @if ($question->image_B != NULL)
                                    <div>
                                        <img class="img-responsive center-block" style="max-width: 250px; max-height: 359px;"  src="http://www.ACPA-Global.org/aecapp/public/images/{!!$question->image_B!!}">
                                    </div>
                                @endif
                            </p>
                            <p class="col-sm-12">
                                <input type="radio" id="optionC{{$question->id}}" name="option{{$question->id}}" value="C">
                                <label for="optionC{{$question->id}}">{!!$question->option_C!!}</label>
                                @if ($question->image_C != NULL)
                                    <div>
                                        <img class="img-responsive center-block" style="max-width: 250px; max-height: 359px;" src="http://www.ACPA-Global.org/aecapp/public/images/{!!$question->image_C!!}">
                                    </div>
                                @endif
                            </p>
                            <p class="col-sm-12">
                                <input type="radio" id="optionD{{$question->id}}" name="option{{$question->id}}" value="D">
                                <label for="optionD{{$question->id}}">{!!$question->option_D!!}</label>
                                @if ($question->image_D != NULL)
                                    <div>
                                        <img style="max-width: 250px; max-height: 359px;" class="img-responsive center-block"  src="http://www.ACPA-Global.org/aecapp/public/images/{!!$question->image_D!!}">
                                    </div>
                                @endif
                            </p>
                        </form>
                        <input type="hidden" id="correctoption{ { $ value->id}}" value="{ { $ value->c orrect_option}}">
                        <input type="hidden" id="marks{ { $ value->id}}" value="{ {$ value->marks}}">
                        <input type="hidden" id="negmark s { { $ value ->id}}" value="{ {$ value->negative_marks}}">
                        <!-- End Radio Button -->
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                        <?php //$tmarks = $tmarks + $question->marks; ?>
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

                    </div>
                    <div class="row">
                            <div class="col-xs-12 text-center" style="margin-bottom:20px;">
                                @if ($question->id > 2)
                                <!--------- btn btn-outline-warning select-button ---->
                                <!--
                                <button type="button" onclick="Previous('{ {$ no-1}}',{ {$question->id}})" class="btn btn-warning">Previous</button>-->
                                @endif
                                <!--------- btn btn-outline-success select-button ---->
                                <button type="button"   class="btn btn-success">Save & Next</button>
                                <!--------- btn btn-outline-info select-button ---->
                                <button type="button"  class="btn btn-info">BookMark This Question</button>
                                 <button type="button" onclick="finish()" class="Finshexam btn btn-outline-primary select-button hidden">Finish</button>
                                
                            </div>
                            
                    </div>
                    
                </div>
            
            </div>
     
        
            
        </div>
    </div>
</div>

<div id="styleSelector">

</div>
</div>
</div>
</div>
</div>          

@endforeach

<script type="text/javascript">
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + " : " + seconds;

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}
</script>

  
  <!-- ------------------------------------------------ Script ----------------- -->                                                
  <script type="text/javascript">
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + " : " + seconds;

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

function startExam(){
  
            $("#startexambutton").addClass('hidden'); 
            $("#examloader").removeClass('hidden');
            $("#pls_wait_preparing_exam_room").removeClass('hidden');

            var data = new FormData();
                data.append('examcode', 1);//'{ { $ id}}');
                
               $.ajax({
                   type : 'POST',
                   url : '/refresult',
                   beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},
                
                   data: data,
                   contentType: false,
                   processData: false,
                   success: function(data){

                        $("#instruction").addClass('hidden'); 
                        $("#show_exam").removeClass('hidden');
        //Fullscreen mode----------------------------------------alsir-------------------------------------
                                            /*if (elem.mozRequestFullScreen) { /* Firefox * /
                                            elem.mozRequestFullScreen();
                                        } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera * /
                                            elem.webkitRequestFullscreen();
                                        } else if (elem.msRequestFullscreen) { /* IE/Edge * /
                                            elem.msRequestFullscreen();
                                        }*/
                                        /*
                                        window.onload = maxWindow;

                                            function maxWindow() {
                                                window.moveTo(0, 0);

                                                if (document.all) {
                                                    top.window.resizeTo(screen.availWidth, screen.availHeight);
                                                }

                                                else if (document.layers || document.getElementById) {
                                                    if (top.window.outerHeight < screen.availHeight || top.window.outerWidth < screen.availWidth) {
                                                        top.window.outerHeight = screen.availHeight;
                                                        top.window.outerWidth = screen.availWidth;
                                                    }
                                                }
                                            }
                                        */



                                        function requestFullScreen(element) {
                                            // Supports most browsers and their versions.
                                            var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || element.msRequestFullScreen;

                                            if (requestMethod) { // Native full screen.
                                                requestMethod.call(element);
                                            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                                                elem.mozRequestFullScreen();

                                                var wscript = new ActiveXObject("WScript.Shell");

                                                if (wscript !== null) {                                            
                                                    elem.mozRequestFullScreen();
                                                    wscript.SendKeys("{F11}");
                                                }
                                            }
                                        }

                                        var elem = document.body; // Make the body go full screen.
                                        requestFullScreen(elem);
    //End Fullscreen mode----------------------------------------alsir-------------------------------------

                        var fiveMinutes = 60 * '{{$timeing}}',
                        display = document.querySelector('#timmer');
                        startTimer(fiveMinutes, display);
          
                   }
               })
   
}

  // Show Selected Question 
  function show_selected_question($sub, $question->id, $q_no){
          //  alert($sub+ $question->id+ $q_no)
            $('.hideme').addClass('hidden');
            $('#ques_block'+''+$question->id).removeClass('hidden');
         //   alert('#ques_block'+''+$question->id);
            if({{$question->id-1}} == $q_no) {
                $('.Finshexam').removeClass('hidden');
            }
            $('.setqno').text($q_no);
            $('.current_qusetion_no').val($q_no);
            $('#current_selected_subject').val($sub);
            $("#display_selected_subject").text($sub);
        }
        // Save Answer 
        function Save($abs_qno, $arr){

            var $current_subject =   set_question[$abs_qno][1];
            var $current_question_id = set_question[$abs_qno][0];
            var $current_ques_no = $abs_qno;
  //----------------------------------------------------------------------Hide this q-------------------------------------------          
            colors[$current_subject+''+$current_question_id] = "#fff";
        //    alert($current_subject+''+$current_question_id);
            var present = document.getElementById('btn'+$current_question_id);
            
            if(present)
            document.getElementById('btn'+$current_question_id).hidden = true;
            if($('input[name=option'+$current_question_id+']:checked').val() == $('#correctoption'+$current_question_id).val())
            {
                AddUserResponse($current_question_id , $('input[name=option'+$current_question_id+']:checked').val() , $('#marks'+$current_question_id).val());
            } else{
                AddUserResponse($current_question_id , $('input[name=option'+$current_question_id+']:checked').val() , $('#negmarks'+$current_question_id).val());
          
            }
            //myArr.indexOf(ID)
            if(!set_question.hasOwnProperty(+$abs_qno + +1)){
                return;
            }
        
            var $next_ques_no = +$abs_qno + +1;
            var $next_subject =   set_question[$next_ques_no][1];
            var $next_question_id = set_question[$next_ques_no][0];
           
            if({{$question->id-1}} == $next_ques_no) {
                $('.Finshexam').removeClass('hidden');
            }

            if($current_subject != $next_subject)
            {
                change_selected_question($next_subject , $arr)          
            }  

            $('.hideme').addClass('hidden');
            //Next Subject & id
            $('#ques_block'+''+$next_question_id).removeClass('hidden');
            
            $('.setqno').text($next_ques_no);
            $('.current_qusetion_no').val($next_ques_no);
            $('#current_selected_subject').val($next_subject);            
            $("#display_selected_subject").text($next_subject);

        }
         // Skip Question 
         function Skip($abs_qno, $arr){

            var $current_subject =   set_question[$abs_qno][1];
            var $current_question_id = set_question[$abs_qno][0];
            var $current_ques_no = $abs_qno;
            
            colors[$current_subject+''+$current_question_id] = "#fb6560";
        //    alert($current_subject+''+$current_question_id);
            var present = document.getElementById('btn'+$current_question_id);
            
            if(present)
            document.getElementById('btn'+$current_question_id).hidden = true;

         //   document.getElementById('btn'+$current_question_id).style.background = "#fb6560";

            if(!set_question.hasOwnProperty(+$abs_qno + +1)){
                return;
            }
            var $next_ques_no = +$abs_qno + +1;
            var $next_subject =   set_question[$next_ques_no][1];
            var $next_question_id = set_question[$next_ques_no][0];

            if({{$question->id-1}} == $next_ques_no) {
                $('.Finshexam').removeClass('hidden');
            }

            if($current_subject != $next_subject)
            {
                change_selected_question($next_subject , $arr)          
            }  

            $('.hideme').addClass('hidden');
            //Next Subject & id
            $('#ques_block'+''+$next_question_id).removeClass('hidden');
            
            $('.setqno').text($next_ques_no);
            $('.current_qusetion_no').val($next_ques_no);
            $('#current_selected_subject').val($next_subject);            
            $("#display_selected_subject").text($next_subject);
        }
         // Reminder Question 
         function Reminder($abs_qno, $arr){

            var $current_subject =   set_question[$abs_qno][1];
            var $current_question_id = set_question[$abs_qno][0];
            var $current_ques_no = $abs_qno;
            
            
            colors[$current_subject+''+$current_question_id] = "#5bc0de";
        //    alert($current_subject+''+$current_question_id);
            var present = document.getElementById('btn'+$current_question_id);
            
            if(present)
                document.getElementById('btn'+$current_question_id).style.background = "#5bc0de";

            if(!set_question.hasOwnProperty(+$abs_qno + +1)){
                return;
            }
            var $next_ques_no = +$abs_qno + +1;
            var $next_subject =   set_question[$next_ques_no][1];
            var $next_question_id = set_question[$next_ques_no][0];
         
            
            if({{$question->id-1}} == $next_ques_no) {
                $('.Finshexam').removeClass('hidden');
            }
            if($current_subject != $next_subject)
            {
                change_selected_question($next_subject , $arr)          
            }  

            $('.hideme').addClass('hidden');
            //Next Subject & id
            $('#ques_block'+''+$next_question_id).removeClass('hidden');
            
            $('.setqno').text($next_ques_no);
            $('.current_qusetion_no').val($next_ques_no);
            $('#current_selected_subject').val($next_subject);            
            $("#display_selected_subject").text($next_subject);
        }
           // Previous Question 
           function Previous($abs_qno, $arr){

            var $current_subject =   set_question[$abs_qno][1];
            var $current_question_id = set_question[$abs_qno][0];
            var $current_ques_no = $abs_qno;
            
       //     colors[$current_subject+''+$current_question_id] = "#5bc0de";
        //   document.getElementById($current_subject+''+$current_question_id).style.background = "#5bc0de";

            if(!set_question.hasOwnProperty(+$abs_qno - +1)){
                return;
            }
            var $next_ques_no = +$abs_qno - +1;
            var $next_subject =   set_question[$next_ques_no][1];
            var $next_question_id = set_question[$next_ques_no][0];

            if($current_subject != $next_subject)
            {
                change_selected_question($next_subject , $arr)          
            }  

            $('.hideme').addClass('hidden');
            //Next Subject & id
            $('#ques_block'+''+$next_question_id).removeClass('hidden');
            
            $('.setqno').text($next_ques_no);
            $('.current_qusetion_no').val($next_ques_no);
            $('#current_selected_subject').val($next_subject);            
            $("#display_selected_subject").text($next_subject);
        }
 // Change Subject 
        function change_selected_question($sub , $arr){
            var $q = 1;
            $('#current_selected_subject').val($sub);
            $("#display_selected_subject").text($sub);
            $('.rearrange_q').text('');
            for (var k in $arr){
                if($sub == $arr[k].subject)
                {
                    $('.rearrange_q').append('<button id="btn'+$arr[k].id+'" class="btn btn-warning btn-icon circle-btn" >'+ $q +'</button>')
                    document.getElementById('btn'+$arr[k].id).style.background =
                                            colors[$sub+''+$arr[k].id];
                    var s = "$('#btn" + $arr[k].id+"').on('click', function (e) { "+
                            "show_selected_question('"+$arr[k].subject +"','"+ $arr[k].id +"','" +$q+"');"+
                        "});";
                  
                    $('.rearrange_q').append("<script type='text\/javascript'>" + s                     
                        + "<\/script>");                                                  
                //    set_question[$sub+''+$q] = $arr[k].id;
                }$q++;  
            }
        }
// Add AddUserResponse
        function AddUserResponse(ques_id,selected_option ,givenmarks){
              
            //    $("#add").addClass('hidden'); 
            //    $("#spin").removeClass('hidden'); 
                var data = new FormData();
            //    ques_id = 111;
            //    selected_option = "A";
            //    givenmarks = 1;
                data.append('ques_id', ques_id);
                data.append('selected_option', selected_option);
                data.append('givenmarks', givenmarks);
                data.append('examcode','{{$question->id}}' )
                active_process = +active_process + +1;   
                $("#active_process").removeClass('hidden'); 
               $.ajax({
                   type : 'POST',
                   url : '/adduserreponse',
                   beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},
                
                   data: data,
                   contentType: false,
                   processData: false,
                   success: function(data){
                        active_process = +active_process - +1;

                        if(active_process == 0){
                            $("#active_process").addClass('hidden');
                        }
               //     $("#add").removeClass('hidden'); 
               //     $("#spin").addClass('hidden'); 
                     console.log("ABC");
                        
                   }
               }).fail(function (jqXHR, textStatus, error) {
                // Handle error here
                //alert(jqXHR); alert(textStatus); 
                         active_process = +active_process - +1;

                        if(active_process == 0){
                            $("#active_process").addClass('hidden');
                        }
                        
                        $('#errorModal').modal('show');
                       // $('.modal-title').text('Error !!!');
               
            });
        }
  
        function finish(){
           // $("#examover").removeClass('hidden'); 
            $("#show_exam").addClass('hidden');
            window.location.href = "https://acpaglobal.net/showlastresult/{{$question->id}}";
        }

        function  home() {
            $("#examover_footer").text("");
            $("#examover_footer").append('<i class="fa fa-spinner fa-spin" ></i> '+" "+" Pls Wait... ");
           window.location.href = "/home";
        }                

        function result() {
            $("#examover_footer").text("");
            $("#examover_footer").append('<i class="fa fa-spinner fa-spin" ></i> '+" "+" Pls Wait... ");
           window.location.href = "/result";
        } 
</script>

<script type="text/javascript">

        $(document).ready(function(){
            $(".create-model").click(function(){
                $('#create').modal('show');
                $('.form-horizontal').show();
                $('.modal-title').text('Add Student');
            });

            
        });

        $(document).ready(function(){
                $(".addsubject").click(function(){
                $('#addsubject').modal('show');
                $('.form-horizontal').show();
                $('.modal-title').text('Add Subject');
            });

            
        });
        

    //add_subject_to_db  
    $(document).ready(function(){
            $("#add_subject_to_db").click(function(){  
            $("#add_subject_to_db").addClass('hidden'); 
            $("#add_subject_to_db_spin").removeClass('hidden'); 
            $('#add_subject_msg').text("Processing ... ");

               $.ajax({
                   type : 'POST',
                   url : '/Addquestiontodb',
                   beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},
                   data : {
                    'subject': $('input[name=subject]').val(),
                    'examcode': $('input[name=examcode]').val(),
                    'admin_id': $('input[name=admin_id]').val(),
                    'admin_email': $('input[name=admin_email]').val(),
                    },

                   success: function(data){

                    $("#add_subject_to_db").removeClass('hidden'); 
                    $("#add_subject_to_db_spin").addClass('hidden'); 
                    $('.subject_error').addClass('hidden');

                        if((data.errors)){
                            
                            $('#add_subject_msg').text("Error Encounter !!! ");
                            if((data.errors.subject)) 
                            { 
                                $('.subject_error').removeClass('hidden'); 
                                $('.subject_error').text(data.errors.subject);
                            }
                           
                            else {   $('#add_subject_msg').text("Unknown Error !!! "); }

                        }else{
                            $('.dropdown-subject').append('<a class="dropdown-item" onclick="set_current_subject(\''+ data.subject +'\','+ data.id +')" href="#">'+data.subject+'</a>');
                            $('#add_subject_msg').text("Subject Successfully Added");
                            $('#subject').val('');
                        }
                   }
               })
            });
        });
        $(document).ready(function(){
            $(".show_add_question-model").click(function(){

                if($('#current_subject_id').val() == ''){
                 //   alert("Pls. Add / Select Subject");
                    $('#alert_msg').modal('show');
                    $('.form-horizontal').show();
                    $('.modal-title').text('Warring');
                    $('#alert_msg_show').text('Pls Add / Select Subject');
                   
                    return ;
                }

                $('#MathPreview').text("");
                $('#MathBuffer').text("");
                $('#OptionDPreview').text("");
                $('#OptionCPreview').text("");
                $('#OptionBPreview').text("");
                $('#OptionPreview').text("");
                $("#addquestion").removeClass('hidden'); 
                $('#OptionDBuffer').text("");
                $('#OptionCBuffer').text("");
                $('#OptionBBuffer').text("");
                $('#OptionBuffer').text("");
                $('#show_img').addClass('hidden');
            
                $('#option_A').val('');
                $('#option_B').val('');
                $('#option_C').val('');
                $('#option_D').val('');
                $('#MathInput').val('');
                $('#marks').val('');
                $('#negative_marks').val('0');
                $('#correct_option').val('A');
                $('#level').val('none');

                Preview.Init();
                PreviewA.InitA();
                PreviewB.InitB();
                PreviewC.InitC();
                PreviewD.InitD();
                $('#create_question-model').modal('show');
                $('.form-horizontal').show();
                $('.modal-title').text('Add Question');
            });            
        });

        function set_current_subject($sub , $question->id) {
            $('#current_subject_id').val($question->id);
            $('#current_subject_name').val($sub);
            $('#subject_button').text($sub);
        }
        function DisplayQuestion($question->id , $question->id, $question, $A ,$B , $C , $D, $m , $nm , $co, $l , $image){
            
            $('#show_selected_question-model').modal('show');
            $('.modal-title').text('Question ');
            
            $('#A').text($A);
            $('#B').text($B);
            $('#C').text($C);
            $('#D').text($D);
            $('#qno').text("Ques no. "+$question->id +" : ");
            $('#q').text($question);
            $('#M').text($m);
            $('#NM').text($nm);
            $('#CO').text($co);
            $('#L').text($l);
        }


        function EditQuestion($question->id , $question->id, $question, $A ,$B , $C , $D, $m , $nm , $co, $l , $image){
            
            $('#MathPreview').text("");
            $('#MathBuffer').text("");
            $('#OptionDPreview').text("");
            $('#OptionCPreview').text("");
            $('#OptionBPreview').text("");
            $('#OptionPreview').text("");

            $('#OptionDBuffer').text("");
            $('#OptionCBuffer').text("");
            $('#OptionBBuffer').text("");
            $('#OptionBuffer').text("");
            $('#show_img').addClass('hidden');

                $('#option_A').val($A);
                $('#option_B').val($B);
                $('#option_C').val($C);
                $('#option_D').val($D);
                $('#edit_qno').val("Ques no. "+$question->id +" : ");
                $('#MathInput').val($question);
                $('#marks').val($m);
                $('#negative_marks').val($nm);
                $('#correct_option').val($co);
                $('#level').val($l);
                
                $img = "images/" + $image;
                if($image)
                {
                    $('#show_img').text('');
                    $('#show_img').removeClass('hidden');
                //    $('#show_img').append("<img id=\"ques_image\" src=\"{{ asset('assets/images/avatar-4.jpg')}}\" >");
                    $('#show_img').append("<img class=\"img-responsive center-block\" src=\"{{ asset('images/')}}" + '/'+$image +"\">");
            
                }
            //  $('#ques_image').attr('src','{{ asset('+$img+')}}');

                Preview.Init();
                PreviewA.InitA();
                PreviewB.InitB();
                PreviewC.InitC();
                PreviewD.InitD();
                $("#addquestion").addClass('hidden'); 
                $('#create_question-model').modal('show');
                $('.form-horizontal').show();
                $('.modal-title').text('Add Question');
        }

        function viewdetil(name ,student_id,admin_id ,created_at ,validity) {
  //          console.log(d.fee);
                $('#show').modal('show');
                $('.modal-title').text('Student Detail');
                $('#view_name').text(name);
                $('#view_student_id').text(student_id);
                $('#view_institution_id').text(admin_id);
                $('#view_created_at').text(created_at);
                $('#view_validity').text(validity);
        }

        function Editdetail(id,name ,student_id){
    //        console.log(d.fee);
                $('#edit').modal('show');
                $('.modal-title').text('Change Password');
                $('#uid').val(id);
                $('#uname').val(name);
                $('#ustudent_id').val(student_id);
        }

        function Delete_user(id, name ,student_id){
        // console.log(d.fee);
                $('#delete').modal('show');
                $('.modal-title').text('Are your sure want to delete');
                $('#delete_id').text(id);
                $('#did').val(id);
                $('#delete_name').text(name);
                $('#delete_student_id').text(student_id);
        }       
      
// Add Question
        $(document).ready(function(){
            $("#addquestion").click(function(){
              
                $("#addquestion").addClass('hidden'); 
                $("#add_question_spin").removeClass('hidden'); 
                $('#add_question_msg').text("Processing ...");

                var data = new FormData();

                data.append('question', $('textarea[name=question]').val());
                data.append('option_A', $('input[name=option_A]').val());
                data.append('option_B', $('input[name=option_B]').val());
                data.append('option_C', $('input[name=option_C]').val());
                data.append('option_D', $('input[name=option_D]').val());
                data.append('marks', $('input[name=marks]').val());
                data.append('category', $('input[name=category]').val());
                data.append('examcode', $('input[name=examcode]').val());
                data.append('subject_code', $('input[name=current_subject_id]').val());
                data.append('subject', $('input[name=current_subject_name]').val());
                data.append('image', $('#image')[0].files[0]);
                data.append('negative_marks', $('input[name=negative_marks]').val());
                data.append('admin_email', $('input[name=admin_email]').val());
                data.append('admin_id', $('input[name=admin_id]').val());
                data.append('correct_option', $('select[name=correct_option]').val());
                data.append('level', $('select[name=level]').val());
            
           //     var postData = new FormData($("#modal_form_id")[0]);   
           //     postData.append('subject_code': $('input[name=current_subject_id]').val(),
           //     'subject': $('input[name=current_subject_name]').val(),);       
               $.ajax({
                   type : 'POST',
                   url : '/addquestion',
                   data: data,
                   contentType: false,
                   processData: false,
                   beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},
              
                   success: function(data){
                        $("#addquestion").removeClass('hidden'); 
                        $("#add_question_spin").addClass('hidden'); 

                        $('.question_error').addClass('hidden');
                        $('.option_A_error').addClass('hidden');
                        $('.option_B_error').addClass('hidden');
                        $('.option_C_error').addClass('hidden');
                        $('.option_D_error').addClass('hidden');
                        $('.marks_error').addClass('hidden');
                        $('.negative_marks_error').addClass('hidden');

                        if((data.errors)){
                           
                            if((data.errors.question)) 
                            { 
                                $('.question_error').removeClass('hidden'); 
                                $('.question_error').text(data.errors.question);
                            }
                            else if((data.errors.option_A)) 
                            { 
                                $('.option_A_error').removeClass('hidden'); 
                                $('.option_A_error').text(data.errors.option_A);
                            }

                            else if((data.errors.option_B)) 
                            { 
                                $('.option_B_error').removeClass('hidden'); 
                                $('.option_B_error').text(data.errors.option_B);
                            }
                            else if((data.errors.option_C)) 
                            { 
                                $('.option_C_error').removeClass('hidden'); 
                                $('.option_C_error').text(data.errors.option_C);
                            }
                            else if((data.errors.option_D)) 
                            { 
                                $('.option_D_error').removeClass('hidden'); 
                                $('.option_D_error').text(data.errors.option_D);
                            }
                            
                            else if((data.errors.marks)) 
                            { 
                                $('.marks_error').removeClass('hidden'); 
                                $('.marks_error').text(data.errors.marks);
                            }
                            else if((data.errors.negative_marks)) 
                            { 
                                $('.negative_marks_error').removeClass('hidden'); 
                                $('.negative_marks_error').text(data.errors.negative_marks);
                            }
                            else {    $('#add_question_msg').text("Error : "+data.errors);}

                        }else{
                            $('#add_question_msg').text("Question Successfully Added");
                            $('#MathInput').val('');
                            $('#option_A').val('');
                            $('#option_B').val('');
                            $('#option_C').val('');
                            $('#option_D').val('');
                            $('#marks').val('');
                            $('#negative_marks').val('');
                            $('#image').val('');
                            $('#correct_option').val('A');
                            console.log("ABC");
                        }
                   }
               })
            });
        });

    //Update Student Password
        $(document).ready(function(){
            $("#update").click(function(){  
            $("#update").addClass('hidden'); 
            $("#upspin").removeClass('hidden'); 

               $.ajax({
                   type : 'POST',
                   url : 'ChangePassword',
                   beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},
                   data :{
                    'id': $('input[name=uid]').val(),
                    'name': $('input[name=uname]').val(),
                    'student_id': $('input[name=ustudent_id]').val(),
                    'password': $('input[name=upassword]').val(),
                    'password_confirmation': $('input[name=upassword_confirmation]').val(),
                   },

                   success: function(data){

                    $("#update").removeClass('hidden'); 
                    $("#upspin").addClass('hidden'); 

                            $('.uname_error').addClass('hidden');
                            $('.ustudent_id_error').addClass('hidden');
                            $('.upass_error').addClass('hidden');

                        if((data.errors)){
                            
                            if((data.errors.student_id)) 
                            { 
                                $('.ustudent_id_error').removeClass('hidden'); 
                                $('.ustudent_id_error').text(data.errors.student_id);
                            }
                            else {  $('.ustudent_id_error').addClass('hidden'); }

                            if((data.errors.name)) 
                            { 
                                $('.uname_error').removeClass('hidden'); 
                                $('.uname_error').text(data.errors.name);
                            }
                            else {  $('.uname_error').addClass('hidden'); }

                            if((data.errors.password)) 
                            { 
                                $('.upass_error').removeClass('hidden'); 
                                $('.upass_error').text(data.errors.password);
                            }
                            else {  $('.upass_error').addClass('hidden'); }

                        }else{
                            $('#umsg').text("Student Successfully Added");
                        //    $('#uname').val('');
                        //    $('#ustudent_id').val('');
                        //    $('#upassword').val('');
                        //    $('#upassword_confirmation').val('');
                            console.log("ABC");
                        }
                   }
               })
            });
        });

    //Delete Student
        $(document).ready(function(){
            $("#delete").click(function(){
              
                $("#delete").addClass('hidden'); 
                $("#dspin").removeClass('hidden'); 
                console.log($("#delete_id").val())
               $.ajax({
                   type : 'POST',
                   url : 'RemoveStudent',
                   beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},
                   data :{
                    'id': $('input[name=did]').val(),
                    },
                   success: function(data){
                        $("#delete").removeClass('hidden'); 
                        $("#dspin").addClass('hidden'); 
                        console.log( 'ABCD',$('.student'+$('.id').val()));
                        $('.student'+$('#did').val()).remove();
                    
                    //    $('#dmsg').text("Student Record Successfully Deleted");
                        $('#delete').modal('hide');
                   }
               })
            });
        });
    </script>

<script type="text/javascript">
    function create_new_exam(){
        $('#add_new_exam').modal('show');
        $('.modal-title').text('Create Exam');
    }
</script>

<script type="text/javascript">
   $(document).ready(function(){
            $("#addexam").click(function(){

                $("#addexam").addClass('hidden'); 
                $("#aespin").removeClass('hidden'); 
               $.ajax({
                   type : 'POST',
                   url : 'addexam',
                   beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},
                   data :{
                        'tname': $('input[name=tname]').val(),
                        'examtitle': $('input[name=examtitle]').val(),
                        'admin_id': $('input[name=admin_id]').val(),
                        'admin_email': $('input[name=admin_email]').val(),
                        'category':  $('select[name=category]').val(),
                        'examtime':  $('input[name=examtime]').val(),
                    },

                   success: function(data){
                    console.log(data);
                            $('.tname_error').addClass('hidden');
                            $('.examtitle_error').addClass('hidden');
                            $('.examtime_error').addClass('hidden');

                        if((data.errors)){
                           
                            $("#addexam").removeClass('hidden'); 
                            $("#aespin").addClass('hidden'); 

                            if((data.errors.tname)) 
                            { 
                                $('.tname_error').removeClass('hidden'); 
                                $('.tname_error').text(data.errors.tname);
                            }
                            
                            else if((data.errors.examtitle)) 
                            { 
                                $('.examtitle_error').removeClass('hidden'); 
                                $('.examtitle_error').text(data.errors.examtitle);
                            }

                            else if((data.errors.examtime)) 
                            { 
                                $('.examtime_error').removeClass('hidden'); 
                                $('.examtime_error').text(data.errors.examtime);
                            }
                          
                            
                            else {
                                $('#create_exam_error_msg').text("Unknown Error Encounter! Fill detail correctly");
                           
                            }
                           
                        }else{
                            $('#create_exam_error_msg').text("Exam Added, Redirecting...");
                            $('#aespin').text("Redirecting ....");
                          //  alert(data.examcode);
                            $('#name').val('');
                            $('#student_id').val('');
                            $('#password').val('');
                            $('#password_confirmation').val('');
                            
                            window.location.href = "/addquestion/examcode/"+data.id + "/"+ data.examtitle+ "/"+ data.tname+ "/"+ data.category+ "/"+ data.examtime;
                        }
                   }
               })
            });
        });
</script>


@endsection