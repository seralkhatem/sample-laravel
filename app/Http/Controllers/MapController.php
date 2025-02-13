<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\User;
use App\Admin;
use App\Student;
use App\CourcesActivity;
use App\Payment;
use App\Reference;
use App\Myaddress;
use App\Invoice;
use App\Subject;
use App\Courseimg;
use Mail;
use PDF;
use App\Mail\PendingRegisteration;
use App\Mail\SendMailable;
use App\Mail\sendPendingData;
use App\Mail\SendMailable2;
use App\Mail\Senddata;
use App\Mail\NBC_Membership_Confirmation;
use App\Mail\ActivationMember;
use App\Mail\StudentInvoice;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendInvoice;
use App\Mail\Account_Registeration;
use App\Mail\AccountRegisteration;
 

use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;


//use DB;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


class MapController extends Controller
{
    public $user;
    public $invoice;
    public $subject;
    public $payment;
    public $total=0;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function allinvoice(){
        $allinvoice = Invoice::all();
        return view('allinvoice')->with('allinvoice',$allinvoice);
    } 
    public function allpayment(){
    $allpayment = Payment::all();
    return view('allpayment')->with('allpayment',$allpayment); }
    public function putmyaddress(){
    $user = User::find(1);
    $myaddresses= User::find(1);
    return view('map.myaddresses')->with('user',$user)->with('myaddresses',$myaddresses); }
    public function map(){   return view('map.home');  } 
    public function videos1(){
    $fees = Auth::user()->fee;
    if($fees > 19){
    return view('map.videos.part1.index');
        }else{
    return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');  }   }   
            
    public function part1session1(){
    $fees = Auth::user()->fee;
    if($fees > 19){  return view('map.videos.part1.session1');
    }else{
        return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');   }  } 
    
    public function part1session2(){
    $fees = Auth::user()->fee;
    if($fees > 19){
    return view('map.videos.part1.session2');        
    }else{
    return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos '); } } 

    public function part1session3(){
    $fees = Auth::user()->fee;
    if($fees > 19){ 
    return view('map.videos.part1.session3');   }else{
    return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');    }  } 
    public function part1session4(){
    $fees = Auth::user()->fee;
    if($fees > 19){ 
    return view('map.videos.part1.session4');

    }else{
    return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');  }   } 

    public function videos2(){
    $fees = Auth::user()->fee;
    if($fees > 39){ 
    return view('map.videos.part2.index');
    }else   { return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos '); }    } 

    public function part2session1(){
    $fees = Auth::user()->fee;
    if($fees > 19){  return view('map.videos.part2.session1');
     }else{
    return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');
    }    }  
    public function part2session2(){
    $fees = Auth::user()->fee;
    if($fees > 39){ 
    return view('map.videos.part2.session2');
            }else{
            return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');
        }    }  
    public function part2session3(){
    $fees = Auth::user()->fee;
    if($fees > 39){ 
    return view('map.videos.part2.session3') ;    }else{
    return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');   }    } 
    public function part2session4(){
        $fees = Auth::user()->fee;
        if($fees > 39){ 
        return view('map.videos.part2.session4') ; 
        }else{
        return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');   }  } 
    public function part2session5(){
        $fees = Auth::user()->fee;
        if($fees > 39){ 
        return view('map.videos.part2.session5') ; 
        }else{
        return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');   }  } 
    public function part2session6(){
        $fees = Auth::user()->fee;
        if($fees > 39){ 
        return view('map.videos.part2.session6') ; 
        }else{
        return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');   }  } 
    public function part2session7(){
        $fees = Auth::user()->fee;
        if($fees > 39){ 
        return view('map.videos.part2.session7') ; 
        }else{
        return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');   }  } 
public function part2session8(){
    $fees = Auth::user()->fee;
    if($fees > 39){ 
    return view('map.videos.part2.session8') ; 
    }else{

        return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');   }  } 

    public function videos3(){
    $fees = Auth::user()->fee;
    if($fees > 59){
    return view('map.videos.part3.index');
    } else{
        return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');
    }
    } 
    
    public function part3session1(){
        $fees = Auth::user()->fee;
        if($fees > 59){
            return view('map.videos.part3.session1');
         }else{
        return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');
        }    }  
        public function part3session2(){
        $fees = Auth::user()->fee;
        if($fees > 59){
            return view('map.videos.part3.session2');
                }else{
                return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');
            }    }  
        public function part3session3(){
        $fees = Auth::user()->fee;
        if($fees > 59){
            return view('map.videos.part3.session3') ;    }else{
        return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');   }    } 
        public function part3session4(){
            $fees = Auth::user()->fee;
            if($fees > 59){
                return view('map.videos.part3.session4') ; 
            }else{
            return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');   }  } 
    public function videos4(){
    $fees = Auth::user()->fee;
    if($fees > 79){
    
    return view('map.videos.part4.index');
    }else
    {
        return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');
    }
    } 
          
    
    public function part4session1(){
        $fees = Auth::user()->fee;
        if($fees > 59){
            return view('map.videos.part4.session1');
         }else{
        return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');
        }    }  
        public function part4session2(){
        $fees = Auth::user()->fee;
        if($fees > 59){
            return view('map.videos.part4.session2');
                }else{
                return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');
            }    }  
        public function part4session3(){
        $fees = Auth::user()->fee;
        if($fees > 59){
            return view('map.videos.part4.session3') ;    }else{
        return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');   }    } 
        public function part4session4(){
            $fees = Auth::user()->fee;
            if($fees > 59){
                return view('map.videos.part4.session4') ; 
            }else{
            return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');   }  } 


    public function videos5(){
    $fees = Auth::user()->fee;
    if($fees > 99){
    return view('map.videos.part5.index');
    //return view('map.home')->with('message', 'Profile Picture Uploaded Successfuly');

    }else{
        return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');
    }
        } 

         
        public function part5session1(){
            $fees = Auth::user()->fee;
            if($fees > 59){
                return view('map.videos.part5.session1');
             }else{
            return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');
            }    }  
            public function part5session2(){
            $fees = Auth::user()->fee;
            if($fees > 59){
                return view('map.videos.part5.session2');
                    }else{
                    return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');
                }    }  
            public function part5session3(){
            $fees = Auth::user()->fee;
            if($fees > 59){
                return view('map.videos.part5.session3') ;    }else{
            return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');   }    } 
            public function part5session4(){
                $fees = Auth::user()->fee;
                if($fees > 59){
                    return view('map.videos.part5.session4') ; 
                }else{
                return redirect()->back()->with('error','You Dont Have enugh Credit To watch This  Viseos ');   }  } 
    
               
        
    public function video(){
    $video = "video/top5videoplayer.mp4";
    $mime = "video/mp4";
    $title = "Os Simpsons";

    $video2 = "video/Part2Session6A.avi";
    $mime2 = "video/avi";
    $title2 = "Os Simpsons";

    return view('map.home')->with(compact('video', 'mime', 'title','video2', 'mime2', 'title2')); 
  } 
    //-------------------------------------------Export PDF---------------------------------------------------------------------------------------------------------------------------------------
    public function pdfexport(){
        $id = Auth::user()->id;
        $student = Student::find($id);
        
        $student_id = $student->student_id;
        $invoice = DB::table('invoices')->where('student_id', $student_id)->get();
        
        $pdf = PDF::loadView('student.pdf',['student' => $student,'invoice' => $invoice])->setPaper('a4','potrait');
        $fileName = time().$student->name;
        return $pdf->stream($fileName.'.pdf');
        }
    //------------------------------------------------Invoive PDF------------------------------------------------------------------------------
    public function sendregisterationdatapdf($id){
        $invoice = Invoice::find($id);
        $id= $invoice->student_id;
        $student = DB::table('users')->where('student_id',$id)->get()->first();
        
        $student_id = $invoice->student_id;
        //$invoice = DB::table('invoices')->where('student_id', $student_id)->get();
        
        $pdf = PDF::loadView('map.sendRegisterationData',['student' => $student,'invoice' => $invoice])->setPaper('a4','potrait');
        $fileName = 'INV-'.$invoice->id.'-'.$invoice->student_id;
        return $pdf->stream($fileName.'.pdf');
    }
//------------------------------------------------Invoive PDF------------------------------------------------------------------------------

//------------------------------------------------Invoive PDF------------------------------------------------------------------------------
public function invoice($id){
    $invoice = Invoice::find($id);
    $id= $invoice->student_id;
    $student = DB::table('users')->where('student_id',$id)->get()->first();
    
    $student_id = $invoice->student_id;
    //$invoice = DB::table('invoices')->where('student_id', $student_id)->get();
    
    $pdf = PDF::loadView('map.invoicepdf',['student' => $student,'invoice' => $invoice])->setPaper('a4','potrait');
    $fileName = 'INV-'.$invoice->id.'-'.$invoice->student_id;
    return $pdf->stream($fileName.'.pdf');
}
//------------------------------------------------Invoive PDF------------------------------------------------------------------------------
public function payment($id){
    $payment = Payment::find($id);
    $id= $payment->user_id;
    $student = DB::table('users')->where('student_id',$id)->get()->first();
    
    $student_id = $payment->student_id;
    //$invoice = DB::table('invoices')->where('student_id', $student_id)->get();
    
    $pdf = PDF::loadView('mails.payment',['student' => $student,'payment' => $payment])->setPaper('a4','potrait');
    $fileName = 'Payment-'.$payment->id.'-'.$payment->user_id;
    return $pdf->stream($fileName.'.pdf');
}

public function passexamhall(Request $r){
    $exams = DB::table('exam')->get();
        $exam1code = NULL;
        $exam1title = NULL;
        $proctor =0;
    
    return view('map.passexamhall',compact('exams','exam1code','exam1title','proctor'));
}
//-------------------------------------GO to Exam // Start Exam----------------------------------------------- ---------------------------- -------------------------
public function passstartexam(Request $request){
    $student_id = Auth::user()->student_id;
    $id = $request->examcode;
    $exam = DB::table('exam')->where('examcode',$id)->first();
    $title = $exam->examtitle;
    $tname = $exam->tname;
    $cat = $exam->category;
    $examtime = $exam->examtime;
    $student_id1 = Auth::user()->student_id;
    if(Auth::user()->name != $request->name){
        $url = 'https://exam.acpaglobal.net/public/exam/start/'.$id.'/'.$title.'/'.$cat.'/SSC/'.$examtime.'/'.$student_id.'/';
        return redirect($url);
        return redirect('/login');
    }else{
         //   {id}/{title}/{tname}/{cat}/{time}https://exam.acpaglobal.net/public/exam/start/66/Mook%20Exam/NBC/SSC/30'
         $url = 'https://exam.acpaglobal.net/public/exam/start/'.$id.'/'.$title.'/'.$cat.'/SSC/'.$examtime.'/'.$student_id.'/';
         return redirect($url);
    } 
}
//**------------------------------*********pending log in --------------------------------------------------------------------------------------*/ */   
    public function pendinglogin(){

            return view('auth.pendinglogin');
        }

        
    public function postpendinglogin(Request $request){
		
        $password = $request->password;
        $id = $request->id;
        $count1 = DB::table('users')->where('password2',$password)->count();
        $count2 = DB::table('users')->where('id',$id)->count();
        if($count1 < 1){
            return redirect()->back()->with('error','Your Password is incorrect ?');
                }
                elseif($count2 < 1){
                    return redirect()->back()->with('error','Your Pending id is incorrect ?');
                        }else{
                            $id = $request->id;
                            $password = $request->password;
                            $user = User::find($id);
                            //  $user = DB::table('users')->where('id',$id)->get();
                            // if($user->password2 === $password ){
                                $id = $request->id;
                                $user = User::find($id);
                                //$user = DB::table('users')->where('id','=' $id)->get();
                                $maxid = DB::table('users')->max('student_id');
                                $member_id = $maxid + 1;
                                $student_id = $user->student_id;
                            if($student_id < 10000){
                                $id = $request->id;
                                $password = $request->password;
                                $user = User::find($id);
                                $maxid = DB::table('users')->max('student_id');
                                $member_id = $maxid + 1;
                                DB::table('users')
                                ->where('id', $user->id)
                                ->update(['is_admin' => 2,'student_id' => $member_id,'type' => 'Registered' ]);
                                    Mail::to($user->email)->send(new SendMailable2($user));
                                $user1 = DB::table('users')->where('student_id',$member_id)->first();
                                $invoice = new Invoice;
                                $invoice->amount = 23;
                                $invoice->student_id = $member_id;
                                $invoice->subject_id = 'Registeration ';
                                $invoice->description = 'Registeration ';
                                $invoice->save();
                    //------------------------------------------------------------------Send New Invoice ---------------------------------------------------------
                                $max_inv= DB::table('invoices')->max('id');
                                $user=DB::table('invoices')->where('id',$max_inv)->first();
                                $student_id=$user->student_id;
                                $user1 = DB::table('users')->where('student_id',$student_id)->first();
                                $user=DB::table('invoices')->where('id',$max_inv)->first();
                                $email=$user1->email;
                                 Mail::to($email)->send(new NBC_Membership_Confirmation($user));
                                 //Mail::to($('seralkhatem123@gmail.com')->send(new NBC_Membership_Confirmation($user));
                                 //Mail::to($('admin@acpaglobal.net')->send(new NBC_Membership_Confirmation($user));
                    //------------------------------------------------------------------End Send New Invoice ---------------------------------------------------------
                                return redirect('/login')->with('Success', 'user Activated Successfuly');

                }
                
                
        }
        return redirect('/login')->with('Success', 'user Activated Successfuly');
 
    }
    //**------------------------------End pending log in --------------------------------------------------------------------------------------*/ */   
        public function map123(){
            return view('home123');
             }
//**------------------------------ Edit Refrences Last  --------------------------------------------------------------------------------------*/ */   
    public function updatemyaddress(Request $request){
        $this->validate($request,[
            'type'=> 'required',
            'house'=> 'required'
        ]);
        //create myaddress
        $myaddress=User::find(1);
        $myaddress->addresstype =$request->input('addresstype');
        $myaddress->save();
return redirect('/myaddress/{id}/edit')->with('success', 'Update Complete')->with('message', 'Data  Updated Successfuly');
    }

    public function myaccount(){
       
            $NetBalance=0;
            $totInvoice=0;
            $user = User::find(1);
            $student_id = Auth::user()->student_id;
            $user = DB::table('users')->where('student_id',$student_id)->first();
            $invoices=Invoice::join('users','users.student_id','=','invoices.student_id')
                                 ->select('users.id as id', 'invoices.invoice as invoice','invoices.created_at as created_at')
                                 ->get();
            $payments=Payment::join('users','users.id','=','payments.user_id')
            ->select('users.id as id', 'payments.payment as payment','payments.created_at as created_at')
            ->get();
            //Mail::to($student->email)->send(new StudentInvoice($student));
            //echo 'send Invoice Successfully';
            //return view('email.sendInv');
            return view('map.myaccount')
            ->with(['user'=>1,'invoices' => $invoices ,'payments' => $payments,'NetBalance'=>$NetBalance,'totInvoice'=>$totInvoice]);

        }
        public function myqualifications(){

            $NetBalance=0;
            $totInvoice=0;
            $user = User::find(1);
            $invoices=Invoice::join('users','users.id','=','invoices.student_id')
                                 ->select('users.id as id', 'invoices.invoice as invoice','invoices.created_at as created_at')
                                 ->get();
            $payments=Payment::join('users','users.id','=','payments.user_id')
            ->select('users.id as id', 'payments.payment as payment','payments.created_at as created_at')
            ->get();
            $subjects=DB::table('subjects')->get();
            $users = DB::table('users')->get();
            //Mail::to($student->email)->send(new StudentInvoice($student));
            //echo 'send Invoice Successfully';
            //return view('email.sendInv');
            return view('map.myqualifications')->with(['user'=>1,'invoices' => $invoices ,'payments' => $payments,'NetBalance'=>$NetBalance,'totInvoice'=>$totInvoice,'subjects'=>$subjects]);      }

        public function mysqcpd(){
            $id = Auth::user()->id;
            $user = User::find($id);
           /* $courseactivites=CourcesActivity::join('courseactivites.user_id','=','users','users.id')
                                 ->select('users.id as id', 'courseactivites.coursetitle as coursetitle', 'courseactivites.description as description', 'courseactivites.numberhourse as numberhourse', 'courseactivites.coursestartdate as coursestartdate', 'courseactivites.courselocation as courselocation','courseactivites.created_at as created_at')
                                 ->get();*/
            $courseactivites=DB::table('courseactivites')->where('user_id',$id)->get();
            $subjects=DB::table('subjects')->get();
            $users = DB::table('users')->get();
            return view('map.mysqcpd')->with(['user'=>1,'courseactivites' => $courseactivites ]);
        }
        public function storeref(Request $request){
            $user = User::find(1);
            $references=Reference::join('users','users.id','=','references.user_id')
            ->select('users.id as id', 'references.id as id', 'references.name as name', 'references.phone as phone', 'references.address as address', 'references.email as email', 'references.relationship as relationship')
            ->get();
            return view('map.myreferences')->with('success', 'References Created')
            ->with(['user'=>1,'references' => $references ]);

        }
        public function delmyref(Request $request){
            $user = User::find(1);
            $references=Reference::join('users','users.id','=','references.user_id')
            ->select('users.id as id', 'references.id as id', 'references.name as name', 'references.phone as phone', 'references.address as address', 'references.email as email', 'references.relationship as relationship')
            ->get();
            return view('map.myreferences')->with('success', 'References Created')->with(['user'=>1,'references' => $references ])
            ->with('message', 'Data  Uploaded Successfuly');

        }

        public function createRef(Request $request){
            $user = User::find(1);

            $reference = new Reference;
				$reference->relationship = $request->input('relationship');
				$reference->name = $request->input('name');
				$reference->relationship = $request->input('relationship');
				$reference->email = $request->input('email');
				$reference->phone = $request->input('phone');
				$reference->address = $request->input('address');
				$reference->user_id =Auth::user()->id;
                $reference->save();
                $user = User::find(1);
                $references=Reference::join('users','users.id','=','references.user_id')
                ->select('users.id as id', 'references.id as id', 'references.name as name', 'references.phone as phone', 'references.address as address', 'references.email as email', 'references.relationship as relationship')
                ->get();
return view('map.myreferences')->with('success', 'References Created')
->with(['user'=>Auth::user()->id,'references' => $references ])
->with('message', 'Refrence Creaated Successfuly');
//return redirect('map.myreferences')->with('success', 'References Created')->with(['user'=>1,'references' => $references ]);

        }
//--------------------------------------------------------------------------------------------------

        public function updateavatar(Request $request)
        {
            $path = $request->file('avatar')->store('avatars');

            return $path;
        }
//----------------------------------------Update References ----------------------------------------------------------
public function updateRef(Request $request){
    $id = $request->input('id');

    $refernces= Reference::find($id);
    $reference = new Reference;
    $reference->relationship = $request->input('relationship');
    $reference->name = $request->input('name');
    $reference->relationship = $request->input('relationship');
    $reference->email = $request->input('email');
    $reference->phone = $request->input('phone');
    $reference->address = $request->input('address');
    $reference->user_id =Auth::user()->id;
    $reference->update();

    $user = User::find(1);
    $references=Reference::join('users','users.id','=','references.user_id')
    ->select('users.id as id', 'references.id as id', 'references.name as name', 'references.phone as phone', 'references.address as address', 'references.email as email', 'references.relationship as relationship')
    ->get();
    return view('map.myreferences')->with('success', 'References Created')->with(['user'=>1,'references' => $references ])
    ->with('message', 'Refrence Updated Successfuly');

//            return view('map/myreferences/3/editmyreferences')->with('refernces',$refernces);
}

//----------------------------------------Update References ----------------------------------------------------------
public function updateRef2(Request $request){

    $id = $request->input('id');
  //  $refernces= Reference::find($id);

   // $reference = new Reference;
    $referencerelationship = $request->input('relationship');
    $referencename = $request->input('name');
    $referenceemail = $request->input('email');
    $referencephone = $request->input('phone');
    $referenceaddress = $request->input('address');
    DB::table('references')
    ->where('id', $id)
    ->update(['name' => $referencename,'email' => $referenceemail,'phone' => $referencephone,'address' => $referenceaddress ]);
 
    $user = User::find(1);
    $references=Reference::join('users','users.id','=','references.user_id')
    ->select('users.id as id', 'references.id as id', 'references.name as name', 'references.phone as phone', 'references.address as address', 'references.email as email', 'references.relationship as relationship')
    ->get();
    return view('map.myreferences')->with('success', 'References Created')->with(['user'=>1,'references' => $references ])
    ->with('message', 'Refrence Updated Successfuly');

//            return view('map/myreferences/3/editmyreferences')->with('refernces',$refernces);
}
public function delRef($id){
    $ref = Reference::find($id);
    $ref->delete();

    $user = User::find(1);
    $references=Reference::join('users','users.id','=','references.user_id')
    ->select('users.id as id', 'references.id as id', 'references.name as name', 'references.phone as phone', 'references.address as address', 'references.email as email', 'references.relationship as relationship')
    ->get();
    return view('map.myreferences')->with('success', 'References Created')->with(['user'=>1,'references' => $references ])
    ->with('message', 'Refrence Deleted Successfuly');



}

        public function editRef($id){
            $reference = Reference::find($id);
            return view('map.editRef')->with('reference',$reference);
        }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createcourseimg()
    {
        return view('map.mysqcpd')->with('message', 'Data  Uploaded Successfuly');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storecourseimg(Request $request)
    {

        $this->validate($request, ['title' => 'required','body' => 'required','courseimg' => 'nullable|max:5999' ]);
    //Handle File Upload
        if($request->hasfile('courseimg')){
            //Get File Name With Extension
            $filenamewithExt = $request->file('courseimg')->getOriginalClientName();
            //Get just file name
            $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('courseimg')->getOriginalClientExtension();
            //File Name to store
            $fileNameToStore=$filename.'_'.time().'.'.$extenson;
            //Uploade Image
            $path = $request->file('courseimg')->storeAs('public/courseimgs', $fileNameToStore)
            ->with('message', 'Data  Uploaded Successfuly');
        }else{
            $fileNameToStore = 'noimage.jpg';
        }
		return 123;
			//Create Post
				$courseimg = new Courseimg;
                $courseimg->courseimg = $fileNameToStore;
                $courseimg->user_id =Auth::user()->id;
                $courseimg->save();

                $user = User::find(1);
                $courseactivites=CourcesActivity::join('users','users.id','=','courseactivites.user_id')
                                                ->select('users.id as id', 'courseactivites.coursetitle as coursetitle', 'courseactivites.description as description', 'courseactivites.numberhourse as numberhourse', 'courseactivites.coursestartdate as coursestartdate', 'courseactivites.courselocation as courselocation','courseactivites.created_at as created_at')
                                                ->get();
                $subjects=DB::table('subjects')->get();
                $users = DB::table('users')->get();

        return redirect('/')->with('success', 'Post Created')
        ->with('message', 'Data  Uploaded Successfuly')
        ->with(['user'=>1,'courseactivites' => $courseactivites, $fileNameToStore ]);
    }
//----------------SEND MAIL 2020-----------------------------------------------------------------------------------------------------
    public function sendmail2020(Request $request){
        $data["email"]=$request->get("email");
        $data["client_name"]=$request->get("client_name");
        $data["subject"]=$request->get("subject");

        $pdf = PDF::loadView('mails.mail2020', $data);

        try{
            Mail::send('mails.mail20202', $data, function($message)use($data,$pdf) {
            $message->to($data["email"], $data["client_name"])
            ->subject($data["subject"])
            ->attachData($pdf->output(), "invoice.pdf");
            });
        }catch(JWTException $exception){
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
             $this->statusdesc  =   "Error sending mail";
             $this->statuscode  =   "0";

        }else{

           $this->statusdesc  =   "Message sent Succesfully";
           $this->statuscode  =   "1";
        }
        return response()->json(compact('this'));
 }
 //----------------END   SEND MAIL 2020-----------------------------------------------------------------------------------------------------


 public function sendmail(Request $request){
    $data["email"]=$request->get("email");
    $data["client_name"]=$request->get("client_name");
    $data["subject"]=$request->get("subject");

    $pdf = PDF::loadView('mails.mail', $data);

    try{
        Mail::send('mails.mail', $data, function($message)use($data,$pdf) {
        $message->to($data["email"], $data["client_name"])
        ->subject($data["subject"])
        ->attachData($pdf->output(), "invoice.pdf");
        });
    }catch(JWTException $exception){
        $this->serverstatuscode = "0";
        $this->serverstatusdes = $exception->getMessage();
    }
    if (Mail::failures()) {
         $this->statusdesc  =   "Error sending mail";
         $this->statuscode  =   "0";

    }else{

       $this->statusdesc  =   "Message sent Succesfully";
       $this->statuscode  =   "1";
    }
    return response()->json(compact('this'));

}


public function  postregister2(Request $request){
	$this->validate($request,[
		'g-recaptcha-response' => 'required|captcha',
	]);
$email = $request->email;
$count= DB::table('users')->where('email',$email)->count();
$pass1 = $request->password;
$pass2 = $request->password2;
if($pass1 != $pass2){
    return redirect()->back()->with('error','Password MISS matuch..!');
}
 if($count > 0){
     return redirect('/resetpass')->with('error','This Email Already Registered ..!') ;
}
$reg = new User;
$reg->name=  $request->username." " .$request->lastname;
$reg->firstname=  $request->username;
$reg->lastname= $request->lastname;
$reg->town= 'My Town';
$reg->phone = $request->phone;
$reg->country = $request->country;
$reg->email = $request->email;
$reg->gender = $request->gender;
$email = $request->email;
$reg->title = $request->title;
$reg->password2 = $request->password;
if($request->password != NULL){

//$reg->password = Hash::make($request->password);
//
//$reg->password = md5($request->password);
$reg->password = bcrypt($request->password);

$reg->save();

    $name[1] = $request->username;
    $name[2] = $request->phone;
    $name[3] = $request->email;
     Mail::to($request->email)->send(new Account_Registeration($name));

     Mail::to('seralkhatem123@gmail.com')->send(new Account_Registeration($name));
     //Mail::to($('admin@acpaglobal.net')->send(new Account_Registeration($name));


$user = DB::table('users')->where('email',$request->email)->first();
$data = array(
    'name' => $request->name,
    'phone' => $request->phone,
    'email' => $request->email,);

$user = DB::table('users')->where('email',$request->email);
return redirect('/handleregister')->with('Success', 'Data  Uploaded Successfuly');
}
return view('mails.sendMail7')->with('data',$data)->with('user',$user)->with('Success', 'Data  Uploaded Successfuly');
}
public function completeregister(){

    return view('welcome')->with('Success', 'Data  Uploaded Successfuly');
}
public function completeregister1($id){
    $count =     $user = DB::table('users')->where('id', $id)->count();
if($count < 1){
    return redirect('/pendinglogin')->with('error','There are no data For this Account !!');
}else{
    $user = User::find($id);
    $user = DB::table('users')->where('id','=', $id)->first();
    $email = $user->email;
    if($user->sendpending == 0){
             Mail::to($email)->send(new AccountRegisteration($user));
             Mail::to('seralkhatem123@gmail.com')->send(new AccountRegisteration($user));
             //Mail::to($('admin@acpaglobal.net')->send(new AccountRegisteration($user));


            //DB::table('users')->where('email',$email)->update(['sendpending'=>1]);
            DB::table('users')->where('email', $email)->update(['sendpending' => 1 ]);
            return redirect('/handleregister')->with('Success', 'Data  Uploaded Successfuly');
    }
 
    return redirect('/handleregister')->with('Success', 'Data  Uploaded Successfuly');
}
    
   // return view('home1234');
}
public function completeregister2($id){
    $user = User::find($id);
  
    
return redirect('/login');
}
public function mail(Request $request)
{
    $name[0] = $request->name;
    $name[1] = 'Cloudways';
    $name[2] = '01233333';
    //Mail::to('Cloudways@Cloudways.com')->send(new SendMailable($name));
   // Mail::to('seralkhatem123@gmail.com')->send(new SendMailable($name));
   // Mail::to('admin@acpaglobal.net')->send(new NBC_Membership_Confirmation($name));


   return 'Email sent Successfully';
}
public function resetpassword2(){
    return redirect('/resetpass')->with('message', 'Data  Uploaded Successfuly');

}
public function resetpassword3(Request $request){
	$this->validate($request,[
		'g-recaptcha-response' => 'required|captcha',
	]);
    $name[0] = $request->email;
    $email = $request->email;
    $email = $name[0];
    $count = DB::table('users')->where('email','=', $email)->count();
    if($count < 1){
        return redirect()->back()->with('Error','There is no member for this mail!');
    }
    $user = DB::table('users')->where('email','=', $email)->first();    


     //$id = $user->id;
//    DB::table('users')->where('id', $user->id)->update(['is_admin' => 2]);
     Mail::to($user->email)->send(new Senddata($user));
     Mail::to('seralkhatem123@gmail.com')->send(new Senddata($user));
     //Mail::to($('admin@acpaglobal.net')->send(new Senddata($user));

    return redirect('/map/home')->with('message', 'Data  Uploaded Successfuly');
    }
    public function changefullname(Request $request){
        $id=Auth::user()->id;
        $fullname=User::find($id);
        $fullname->fullname =$request->input('fullname');
        $fullname->save();
return redirect()->back()->with('message', 'Fullname  Updated Successfuly');

    }
    public function postcouresactivity(Request $request){

        $data=new CourcesActivity;
        $data->coursetitle =$request->input('coursetitle');
        $data->description =$request->input('description');
        $data->numberhourse =$request->input('numberhourse');
        $data->coursestartdate =$request->input('coursestartdate');
        $data->courselocation =$request->input('courselocation');
        $data->user_id = Auth::user()->id;
        $data->save();
        return redirect()->back()->with('message', 'Fullname  Updated Successfuly');
        return redirect('/map/mysqcpd');


    }
    public function payinvoice(Request $request){
        $id=$request->id;
        $totpay=0;
        $invoice=Invoice::find($id);
        $student_id=$invoice->student_id;
        $tot_pay=DB::table('payments')->where('user_id',$student_id)->get();
        foreach($tot_pay as $pay){
            $totpay = $totpay + $pay->payment;
        }
        if($totpay >= $invoice->amount){
            $invoice->paied =1;
        $invoice->save();
        $payment = new Payment;
        $payment->user_id= $invoice->student_id;
        $payment->payment= -$invoice->amount;
        $payment->invoice_id= $invoice->id;
        $payment->subject_id = 'Payment of invoice No: '.$invoice->id;
        $payment->save();


        return redirect()->back()
        //->with('success', 'Update Complete')
        ->with('message', 'Invoice Paied Successfuly');
        

        }else{
            return redirect()->back()->with('error', 'You dont have suffciunt creadit to pay ');
        }
        


    }
    public function undopayinvoice(Request $request){
        $id=$request->id;
        $invoice=Invoice::find($id);
        $student_id=$invoice->student_id;
        $invoice->paied =0;
        $invoice->save();

        $payment = DB::table('payments')->where('invoice_id',$id)->delete();

  return redirect()->back()->with('message', 'Invoice Un-Paied Successfuly');

    }

    
    public function payinvoice2(Request $request){
        $id=$request->id;
        $totpay=0;
        $invoice=Invoice::find($id);
        $student_id=$invoice->student_id;
        $tot_pay=DB::table('payments')->where('user_id',$student_id)->get();
        foreach($tot_pay as $pay){
            $totpay = $totpay + $pay->payment;
        }
        $q = $student_id;
        $id = $student_id;
        $user = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->orWhere('student_id','=',$q)->get();
        $account = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->orWhere('student_id','=',$q)->get();
        $account = DB::table('users')->Where('student_id',$q)->first();
         $id1 = $account->student_id;

        if($totpay >= $invoice->amount){
            $invoice->paied =1;
        $invoice->save();
        $payment = new Payment;
        $payment->user_id= $invoice->student_id;
        $payment->payment= -$invoice->amount;
        $payment->invoice_id= $invoice->id;
        $payment->subject_id = 'Payment of invoice No: '.$invoice->id;
        $payment->save();

        return view('ross.receiptsq')->with('user',$user)->with('id',$id)->with('id1',$id1)
        //->with('success', 'Update Complete')
        ->with('message', 'Invoice Paied Successfuly');
        

        }else{
            return view('ross.receiptsq')->with('user',$user)->with('id',$id)->with('id1',$id1)->with('error', 'You dont have suffciunt creadit to pay ');
        }
        


    }
    public function undopayinvoice2(Request $request){
        $id=$request->id;
        $invoice=Invoice::find($id);
        $student_id=$invoice->student_id;
        $invoice->paied =0;
        $invoice->save();

        $payment = DB::table('payments')->where('invoice_id',$id)->delete();

        $q = $student_id;
        $id = $student_id;
        $user = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->orWhere('student_id','=',$q)->get();
        $account = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->orWhere('student_id','=',$q)->get();
        $account = DB::table('users')->Where('student_id',$q)->first();
         $id1 = $account->student_id;

  return view('ross.receiptsq')->with('message', 'Invoice Un-Paied Successfuly')->with('user',$user)->with('id',$id)->with('id1',$id1);

    }
    
}
