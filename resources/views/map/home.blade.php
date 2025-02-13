@extends('layouts.mastermap')
@section('PageTitle', 'NBC Nazlawi Business College')
@section('Description',('This is Home Page Description'))
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js" integrity="sha512-Meww2sXqNHxI1+5Dyh/9KAtvI9RZSA4c1K2k5iL02oiPO/RH3Q30L3M1albtqMg50u4gRTYdV4EXOQqXEI336A==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.js" integrity="sha512-JjYSgzqo9K0IeYGEslMRYE8aO9tq7Ky3EQNmEVkAe6Cp14AwlJMLMnb0fpgEkr3YxJ8ghQiriOvZwIdRZieGIQ==" crossorigin="anonymous"></script>

<style>
.cookie{
    color:#F00;
    font-family:arial;
}
</style>

<!------ Include the above in your HEAD tag ---------->
<?php  $username = 'Ser2020'; ?>
    <script> 
Cookies.set('myname2','myName2',{expires:2});
Cookies.set('MyPassword','MyPassword2',{expires:2});
Cookies.set('iest','true',{expires:2});

var myCookie = Cookie.get('iest');
var title =document.querySelector('h1');
var strong =document.querySelector('h1');
if(myCookie){
    title.classList.add('cookie');
    strong.classList.add('cookie');
}
if(myCookie == 'false'){
    title.classList.remoe('cookie'); 
}
 
</script>

 

 <div class="container">

<!-- Marketing Icons Section -->
    <div class="row">
        <div class="col-lg-12">

                <div class="panel panel-default">
                <div class="panel-heading">
                <h4>MAP Home Page  @if(Auth::user()->scholarship == 1 )
 
                    
 <img src="{{ asset('/public/scholarship.png')}}" width='50px' heigh="50px" align="right">
 <!--
 style="
 position: fixed;
 margin-top:5px;
 margin-left:-3px;
 padding:5px;
 font-size;10pt;
 border-radius: 5px;">-->

 @endif</h4>
                    </div>
                    <div class="panel-body">
                    <div class="row">
	<div class="col-lg-8">
		<div class="panel panel-default">

					<div class="panel-heading"><strong>Welcome {{Auth::user()->name}} {{Auth::user()->student_id}} </strong></div>
					<div class="panel-body">
   
            <p>
             <!--  <li><a href="/logout">/////////////////Logout</a></li> -->
             Welcome <strong>{{Auth::user()->name}}</strong> to the Nazalwi Bussiness College Access Portal <strong>(MAP)</strong>.
            </p>
           <!-- <h1 id="title" class="cookie">TEST Cookie</h1>-->
            
            <p>
            MAP is a web based application designed to provide NBC Members with the support they need. <br/>
            It is a system which currently gives you access to your Member Details. As we move forward we will be adding more applications to MAP, and we hope that you will get involved by making suggestions about how we can improve it.
            </p><p>
            Please feel free to make suggestions to the Membership Officer about how you feel we can improve MAP.
            </p><p>
            To sit an Exam you need to sign in to the Assessment Portal (PassPort). You can use the same credentials as for your MAP Sign In. <br/>
            To access PassPort select: "Sign In to Passport" from the above menu. <br/>
            We have introduced this additional Sign In to enhance the security of the Assessment system.
            </p><p style="color:#f00"><a href="/profile">
            Important: Please ensure your Certificate Name is Correct. Click here to check or change it.</a>
            </p>
                        </div>
		</div>
	</div>


        <div class="col-lg-4">
        <img src="{{ asset('images/WorldMap.jpg') }}"/>
        <div style="padding:10px; background-color: #5280c7; border-radius: 5px; width:280px; margin-top:15px; color:#fff;">

    "You are the point of origin for
    everything in your world:<br/>
    You set the standard for yourself." <br/>
    (Steve Maraboli) 1975−
    </div>
        </div>
    </div>

    </div>
 
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Explain the courses easily with ...
                </div>
                <div class="panel-body">
                    <div class="row">
            <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><strong>Teacher Badre Eldein</strong></div>
                            <div class="panel-body">
                            <img src="{{asset('/public/explain.jpg')}}" width="250px" heigh="250px">
                          
                            
                            <?php
                             $badr_sbubjects = DB::table('subjects')->where('teacher_id',1)->get();
                             $count1 = DB::table('subjects')->where('teacher_id',1)->count();; ?>
                             @if($count1 > 0)
                                 @foreach($badr_sbubjects as $subject)
                                   
                                 <form action="/explain" method="POST">
                                        @csrf 
                                    <input type="hidden" name="subject_id" value="{{$subject->id}}">
                                    <input class="btn btn-primary" type="submit" Value="Show : {{$subject->name}}">
                                    </form>
                                    
                                    
                                  <!-- echo '<a href="#">'.$subject->name.'</a>';-->

                               @endforeach
                            @endif
                        </div>
                    </div>                    
                    </div>

                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><strong>Teacher Umnia</strong></div>
                            <div class="panel-body"><br>
                            <img src="{{asset('/public/explain3.jpg')}}" width="250px" heigh="250px">
                            
                            
                            <?php
                             $badr_sbubjects = DB::table('subjects')->where('teacher_id',2)->get();
                             $count1 = DB::table('subjects')->where('teacher_id',2)->count();; ?>
                             @if($count1 > 0)
                                 @foreach($badr_sbubjects as $subject)
                                   
                                 <form action="/explain" method="POST">
                                        @csrf 
                                    <input type="hidden" name="subject_id" value="{{$subject->id}}">
                                    <input class="btn btn-primary" type="submit" Value="Show : {{$subject->name}}">
                                    </form>
                                    
                                    
                                  <!-- echo '<a href="#">'.$subject->name.'</a>';-->

                               @endforeach
                            @endif

                        </div>
                        </div>
                        </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><strong>Teacher Sirelkhatim</strong></div>
                            <div class="panel-body">
                            <img src="{{asset('/public/explain2.jpg')}}" width="250px" heigh="250px">
                      
                            <?php
                             $badr_sbubjects = DB::table('subjects')->where('teacher_id',3)->get();
                             $count1 = DB::table('subjects')->where('teacher_id',3)->count();; ?>
                             @if($count1 > 0)
                                 @foreach($badr_sbubjects as $subject)
                                   
                                    <form action="/explain" method="POST">
                                        @csrf 
                                    <input type="hidden" name="subject_id" value="{{$subject->id}}">
                                    <input class="btn btn-primary" type="submit" Value="Show : {{$subject->name}}">
                                    </form>
                                    
                                    
                                  <!-- echo '<a href="#">'.$subject->name.'</a>';-->

                               @endforeach
                            @endif
                        </div>
                    </div>
                </div>                    </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
                </div>
            </div>
        </div>
    </div>

@endsection


 