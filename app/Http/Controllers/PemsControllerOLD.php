<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\Phone;
use App\Email;
use App\Exam;
use App\AttachPDF;
use App\Question;
use DB;
use Session;
use Image;
use PDF;
use Mail;
use App\Ref_result;
use App\Admin;
use App\Video;
use App\Student;
use App\Payment;
use App\Subject;
use App\Invoice;
use App\Scorecard;
use App\PendingRegisteration;
use App\Proctordate;
use App\Mail\SendMailable2;
use App\Mail\SendBulkmail;
use App\Mail\SendBooking;
use App\Mail\SendInvoice;
use App\Mail\SendPayment;
use App\Mail\SendExemptExam;
class PemsController extends Controller
{
    
    public function showuploadvideo() {
        return view('pems.uploadvideo');
     }
     public function showUploadFile(Request $request) {
        $file = $request->file('video');
        $data=new Video;  
        if($files=$request->file('video')){  
        $name=$files->getClientOriginalName();  
        $files->move('video',$name);  
        $data->path=$name;  
        }  
        $data->save();  
            
     /*
        //Display File Name
        echo 'File Name: '.$file->getClientOriginalName();
        echo '<br>';
     
        //Display File Extension
        echo 'File Extension: '.$file->getClientOriginalExtension();
        echo '<br>';
     
        //Display File Real Path
        echo 'File Real Path: '.$file->getRealPath();
        echo '<br>';
     
        //Display File Size
        echo 'File Size: '.$file->getSize();
        echo '<br>';
     
        //Display File Mime Type
        echo 'File Mime Type: '.$file->getMimeType();
     
        //Move Uploaded File
        $destinationPath = 'uploads';
        $file->move($destinationPath,$file->getClientOriginalName());*/
     }
public function addadmin(Request $request){
        $id = $request ->id;
        $name = $request->name;
        $email = $request->email;
        $password2 = $request->password;
        $password = bcrypt($request->password);
        $password2 = $request->password;
        $exam_limit = 1000000;
        DB::table('admins')->where('id',$id)->insert(['name' => $name,'exam_limit' => $exam_limit,'email' => $email,'password'=>$password,'password2'=>$password2]);
        $admin = DB::table('admins')->where('id',$id)->first();
        
    $admins = DB::table('users')->get();
     return redirect()->back()->with('admins',$admins)->with('Success','Your Admin User Added Successfully.');
         }

public function deleteadmin(Request $request){
    $id = $request ->id;
    DB::delete('delete from admins where id = ?',[$id]);
    
    $admins = DB::table('admins')->get();
     return redirect()->back()->with('admins',$admins)->with('Success','Your Admin User Deleted Successfully.');
    echo "Record deleted successfully.<br/>";
    echo '<a href = "/pems/home">Click Here</a> to go back.';
 
}
public function editadmin(Request $request){
    $id = $request ->id;
    $admin = DB::table('admins')->where('id',$id)->first();
    $admins = DB::table('admins')->get();
   return view('pems.editadmin',compact('admin','admins'));
}
public function posteditadmin(Request $request){
    $id = $request ->id;
    $name = $request->name;
    $email = $request->email;
    $password2 = $request->password;
    $password = bcrypt($request->password);
    $password2 = $request->password;
    DB::table('admins')->where('id',$id)->update(['name' => $name,'email' => $email,'password'=>$password,'password2'=>$password2]);
    $admin = DB::table('admins')->where('id',$id)->first();
    $admins = DB::table('admins')->get();
   return view('pems.editadmin',compact('admin','admins'))->with('Success','Admin Updated Successfully!');
     }

public function home(){
    return view('pems.home');
}    
    public function certificate2(){
        return view('pems.certificate2');
    }   
    public function startexam(){
        return view('pems.startexam');
    }
    public function exams(){
        return view('pems.exams');
    }
    public function questions(){
        return view('pems.questions');
    }
    public function results(){
        return view('pems.results');
    }
    public function certificates(){
        return view('pems.certificates');
    }
    public function mails(){
        return view('pems.mails');
    }
    public function showquestion(){
        return view('pems.showquestion');
    }
 
    public function sendbulkemail(Request $request){ 
        if($request->file('file')) 
        {
         $file = $request->file('file');
           $filename = time() . '.' . $request->file('file')->extension();
           $filePath = public_path() . '/uploads';
           $file->move($filePath, $filename);

            $attach = new AttachPDF;
            $attach->pdfname = $filename;
            $attach->save();
            $msg['receiptiont'] = 10002;
            $msg['name'] = $request->name;
            $msg['email'] = $request->message;
            $msg['subject'] = $request->subject;
            $msg['body'] = $request->body;
            $msg['studebt_id'] = $request->message;
            $msg['pdfname'] = $filename;
            $members= DB::table('users')->get(); 
                
             //Mail::to($('seralkhatem123@gmail.com')->send(new SendBulkmail($msg));
             //Mail::to($('info@acpaglobal.net')->send(new SendBulkmail($msg));
        foreach($members as $user)
        {
            if($user->student_id > 9999)
            {

                $msg['receiptiont'] = $user->student_id;
                $email = $user->email; 
                  //Mail::to($($user->email)->send(new SendBulkmail($msg));
           
            } 
         }
         return view('pems.bulkemail')->with('members',$members)->with('success', 'Message sent successfully.');

        }
         else{
        $filename = 'Theres no attach File'; 
        $msg['receiptiont'] = 10002;
        $msg['pdfname'] =  $filename;
        $msg['name'] = $request->name;
        $msg['email'] = $request->message;
         $msg['subject'] = $request->subject;
         $msg['body'] = $request->body;
         $msg['studebt_id'] = $request->message;
         $msg['pdfname'] = $filename;

         $members= DB::table('users')->get();
          //Mail::to($('seralkhatem123@gmail.com')->send(new SendBulkmail($msg));
          //Mail::to($('info@acpaglobal.net')->send(new SendBulkmail($msg));
        foreach($members as $user)
        {
            if($user->student_id > 9999)
            {

                $msg['receiptiont'] = $user->student_id;
                $email = $user->email; 
                 //Mail::to($($user->email)->send(new SendBulkmail($msg));
                
            } 
        }
         return view('pems.bulkemail')->with('members',$members)->with('success', 'Message sent successfully.');

      }
 
     }   
     
     public function examsedit($examcode){
        $exam= DB::table('exam')->where('examcode',$examcode)->first();
          return view('pems.examsedit')->with('exam',$exam);
         }

    public function examsedit2(Request $request,$examcode){
        $examtitle = $request->input('examtitle');
        $realcode = $request->input('realcode');
        $exam= DB::table('exam')->where('examcode',$examcode)->first();
        $exam->examtitle =$examtitle;
        DB::table('exam')->where('examcode',$examcode)->update(['examtitle' => $examtitle,'realcode'=>$realcode]);
        return view('pems.exams')->with('exam',$exam);
    }

    public function examQedit(Request $request,$examcode){
        $exam= DB::table('exam_question')->orderBy('examcode','DESC')->get();
        return view('pems.examquestionedit')->with('exam',$exam)->with('examcode',$examcode);
 
    } 

            
   
    public function findresult(Request $request){
        $q = $request->input('q');
        $count = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->orWhere('student_id','=',$q)->count();
    if($count < 1){
        return  redirect()->back();
     }
        $id = $request->input('q');
         
        $user = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->orWhere('student_id','=',$q)->get();
        $account = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->orWhere('student_id','=',$q)->get();
       // $account = DB::table('users')->Where('student_id',$q)->first();
         //$id1 = $account->student_id;

        if(count($user) > 0)
        return view('pems.findresult')->with('user',$user)->with('account',$account)->with('id',$id);
        else
        $members= User::all();
        //$subjects= Subject::all();
        $users= User::all();
        return view ('pems.results')->withMessage('No Details found. Try to search again !')->with('users',$users)->with('members',$members);
    }
    
    public function findcertificates(Request $request){
        $q = $request->input('q');
        $count = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->orWhere('student_id','=',$q)->count();
    if($count < 1){
        return  redirect()->back();
     }
        $id = $request->input('q');
       
        $user = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->orWhere('student_id','=',$q)->get();
        $account = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->orWhere('student_id','=',$q)->get();
       // $account = DB::table('users')->Where('student_id',$q)->first();
         //$id1 = $account->student_id;

        if(count($user) > 0)
        return view('pems.findcertificates')->with('user',$user)->with('account',$account)->with('id',$id);
        else
        $members= User::all();
        //$subjects= Subject::all();
        $users= User::all();
        return view ('pems.results')->withMessage('No Details found. Try to search again !')->with('users',$users)->with('members',$members);
    }
    public function journal(){
       // $memberid=0;
        $examcode=0;
        $examtitle=Null;
        $examstatus=Null;
        $memberid=Null;
        $memberid2=Null;
        $subject=Null;
        $membername = Null;
        $results = DB::table('ref_result')->where('student_id',$memberid)->get();

         return view ('pems.journal')
                        ->with('memberid',$memberid)
                        ->with('memberid2',$memberid2)
                        ->with('examtitle',$examtitle)
                        ->with('subject',$subject)
                        ->with('examstatus',$examstatus)
                        ->with('results',$results)
                        ->with('membername',$membername);

    }
    public function getmemberjournal(Request $request){
       // $memberid=0;
        $examcode=0;
        $examtitle=Null;
        $examstatus=Null;
        $memberid=Null;
        $memberid2=Null;
        $subject=Null;
        $memberid = $request->memberid;
        $member = DB::table('users')->where('student_id',$memberid)->first();
$count = DB::table('users')->where('student_id',$memberid)->count();
if($count < 1)
{
    return redirect()->back();
}
        $results = DB::table('ref_result')->where('student_id',$memberid)->get();


        
        $membername = $member->name;
         return view ('pems.journal')
                ->with('memberid',$memberid)
                ->with('memberid2',$memberid2)
                ->with('membername',$membername)
                ->with('examtitle',$examtitle)
                ->with('subject',$subject)
                ->with('results',$results)
                ->with('examstatus',$examstatus);
    }
    
    public function getmemberjournalresult(Request $request,$memberid,$resultid){
        // $memberid=0;
         $examcode=0;
         $examtitle=Null;
         $examstatus=Null;
         $memberid2=Null;
         $subject=Null;
         $memberid = $memberid;
         $member = DB::table('users')->where('student_id',$memberid)->first();
         $results = DB::table('ref_result')->where('student_id',$memberid)->get();
         $results2 = DB::table('ref_result')->where('id',$resultid)->first();
         $exam = DB::table('exam')->where('examcode',$results2->examcode)->first();
         $membername = $member->name;
         $examtitle=$exam->examtitle;
         $subject='Subject : '.$exam->examtitle;        
         $memberid2='Student Account ID: '.$results2->student_id;
         $examstatus='Exam-'.$results2->pass.'<br/>';

        return view ('pems.journal')
                 ->with('memberid',$memberid)
                 ->with('memberid2',$memberid2)
                 ->with('membername',$membername)
                 ->with('examtitle',$examtitle)
                 ->with('subject',$subject)
                 ->with('results',$results)
                 ->with('results2',$results2)
                 ->with('examstatus',$examstatus);
     }
     public function savenewphone(Request $request){
        $student_id = $request->student_id;
        $memberid= $request->student_id;
        $phone = $request->phone;
        $phonetype = $request->phonetype;
        $phone = new Phone;
        $phone->phone = $request->phone;
        $phone->phonetype = $request->phonetype;
        $phone->student_id = $request->student_id;
        $phone->save();
        $users = User::all();
        $member=DB::table('users')->where('student_id',$request->student_id)->first();
        $phones = DB::table('phones')->where('student_id',$member->student_id)->get();
        $emails = DB::table('emails')->where('student_id',$member->student_id)->get();
        $users = User::all();
        $membername = $member->name;
        $memberemail = $member->email;   
        return view ('pems.memberadminq')
        ->with('member',$member)->with('users',$users)->with('phones',$phones)->with('memberid',$memberid)
        ->with('membername',$membername)->with('memberemail',$memberemail)->with('emails',$emails);
        }
        
     public function deletephone(Request $request){
        $student_id = $request->student_id;
        $memberid= $request->student_id;
        $id = $request->phone_id;
        $phone = Phone::find($id);
        $phone->delete();
        $users = User::all();
        $member=DB::table('users')->where('student_id',$request->student_id)->first();
        $phones = DB::table('phones')->where('student_id',$member->student_id)->get();
        $emails = DB::table('emails')->where('student_id',$member->student_id)->get();
        $users = User::all();
        $membername = $member->name;
        $memberemail = $member->email;   
        return view ('pems.memberadminq')
        ->with('member',$member)->with('users',$users)->with('phones',$phones)->with('memberid',$memberid)
        ->with('membername',$membername)->with('memberemail',$memberemail)->with('emails',$emails);
        }
        
        public function savenewemail(Request $request){
            $student_id = $request->student_id;
            $memberid = $request->student_id;
            $email = $request->email;
            $emailtype = $request->emailtype;
            $email = new Email;
            $email->email = $request->email;
            $email->emailtype = $request->emailtype;
            $email->student_id = $request->student_id;
            $email->save();
            $users = User::all();
            $member=DB::table('users')->where('student_id',$request->student_id)->first();
            $phones = DB::table('phones')->where('student_id',$member->student_id)->get();
            $emails = DB::table('emails')->where('student_id',$member->student_id)->get();
            $users = User::all();
            $membername = $member->name;
            $memberemail = $member->email;   
            return view ('pems.memberadminq')
            ->with('member',$member)->with('users',$users)->with('phones',$phones)->with('memberid',$memberid)
            ->with('membername',$membername)->with('memberemail',$memberemail)->with('emails',$emails);
            }
            public function deleteemail(Request $request){
                $student_id = $request->student_id;
                $memberid = $request->student_id;
                $emailid = $request->email_id;
                $id = $request->email_id;
                $email = Email::find($id);
                $email->delete();
                $users = User::all();
                $member=DB::table('users')->where('student_id',$request->student_id)->first();
                $phones = DB::table('phones')->where('student_id',$member->student_id)->get();
                $emails = DB::table('emails')->where('student_id',$member->student_id)->get();
                $users = User::all();
                $membername = $member->name;
                $memberemail = $member->email;   
                return view ('pems.memberadminq')
                ->with('member',$member)->with('users',$users)->with('phones',$phones)->with('memberid',$memberid)
                ->with('membername',$membername)->with('memberemail',$memberemail)->with('emails',$emails);
                }
                public function updateaddress(Request $request){
                    $student_id = $request->student_id;
                    $memberid = $request->student_id;
                    $deliveryaddress = $request->deliveryaddress;
                    $invoiceaddress =$request->invoiceaddress ;
                    $transscriptaddress=$request->transscriptaddress ;
                    DB::table('users')
                    ->where('student_id', $student_id)
                    ->update(['deliveryaddress' => $deliveryaddress,'invoiceaddress' => $invoiceaddress,'transscriptaddress' => $transscriptaddress]);
                    $users = User::all();
                    $member=DB::table('users')->where('student_id',$request->student_id)->first();
                    $phones = DB::table('phones')->where('student_id',$member->student_id)->get();
                    $emails = DB::table('emails')->where('student_id',$member->student_id)->get();
                    $users = User::all();
                    $membername = $member->name;
                    $memberemail = $member->email;   
                    return view ('pems.memberadminq')
                    ->with('member',$member)->with('users',$users)->with('phones',$phones)->with('memberid',$memberid)
                    ->with('membername',$membername)->with('memberemail',$memberemail)->with('emails',$emails);
                    }
                    public function updateinformation(Request $request){
                        $student_id = $request->student_id;
                        $memberid = $request->student_id;
                        $address_type = $request->address_type;
                        $house =$request->house;
                        $street =$request->street;
                        $town =$request->town;
                        $ZIPcode =$request->ZIPcode;
                        DB::table('users')
                        ->where('student_id', $student_id)
                        ->update(['deliveryaddress' => $address_type,'house' => $house,'street' => $street,'town' => $town,'ZIPcode' => $ZIPcode]);
                        $users = User::all();
                        $member=DB::table('users')->where('student_id',$request->student_id)->first();
                        $phones = DB::table('phones')->where('student_id',$member->student_id)->get();
                        $emails = DB::table('emails')->where('student_id',$member->student_id)->get();
                        $users = User::all();
                        $membername = $member->name;
                        $memberemail = $member->email;   
                        return view ('pems.memberadminq')
                        ->with('member',$member)->with('users',$users)->with('phones',$phones)->with('memberid',$memberid)
                        ->with('membername',$membername)->with('memberemail',$memberemail)->with('emails',$emails);
                        }
                    
    public function showmemberadmin(Request $req){
        $memberid = NULL;
        $member=DB::table('users')->where('student_id',$req->userid)->orWhere('student_id',$req->memberid)->first();
        $users = User::all();
        $membername = 1;
        $memberemail = 1;   
        return view ('pems.memberadmin')
        ->with('member',$member)->with('users',$users)->with('memberid',$memberid)
        ->with('membername',$membername)->with('memberemail',$memberemail);
    }               
    public function showmemberadminq(Request $req){
        $memberid = $req->userid;
        $member=DB::table('users')->where('student_id',$req->userid)->orWhere('student_id',$req->memberid)->first();
        $users = User::all();
        $phones = DB::table('phones')->where('student_id',$member->student_id)->get();
        $emails = DB::table('emails')->where('student_id',$member->student_id)->get();
        $membername = $member->name;
        $memberemail = $member->email;   
        return view ('pems.memberadminq')
        ->with('member',$member)->with('users',$users)->with('memberid',$memberid)->with('emails',$emails)->with('phones',$phones)
        ->with('membername',$membername)->with('memberemail',$memberemail);
    }
    public function memberstatus(Request $req){
        $memberid = NULL;
        $member=DB::table('users')->where('student_id',$req->userid)->orWhere('student_id',$req->memberid)->first();
        $users = User::all();
        
        return view ('pems.memberstatus')
        ->with('member',$member)->with('users',$users);
    }
    public function memberstatusq(Request $req){
        $memberid = $req->userid;
        $member=DB::table('users')->where('student_id',$req->userid)->orWhere('student_id',$req->memberid)->first();
        $users = User::all();
        
        return view ('pems.memberstatusq')
        ->with('member',$member)->with('users',$users);
    }
    public function deletependingmembers(Request $req){
        $id = $req->id;
        $deluser=User::find($id);
        $deluser->delete();
        $invoices = DB::table('invoices')->where('paied',0)->get();
        //$pendeingusers = DB::table('users')->where('type','Pending')->orWhere('type','Registered')->get();
        $pendeingusers = DB::table('users')->where('is_admin',0)->get();
        return view ('pems.pendingmembers')->with('pendeingusers',$pendeingusers)->with('invoices',$invoices);
    }
    public function pendingmembers(){
        //$pendeingusers = DB::table('users')->where('type','Pending')->orWhere('type','Registered')->get();
        $pendeingusers = DB::table('users')->where('is_admin',0)->get();
        $invoices = DB::table('invoices')->where('paied',0)->get();
        return view ('pems.pendingmembers')->with('pendeingusers',$pendeingusers)->with('invoices',$invoices);
    }
    public function qandalive(){
        return view ('pems.qandalive');
    }
    public function qandaoffline(){
        $qno = 0;
        $examcode = 0;
        $questions= DB::table('exam_question')->where([['examcode','=',$examcode],['online','=',0]])->get();
        $qcount= DB::table('exam_question')->where('examcode',$examcode)->count();
        $exam= DB::table('exam')->get();
        return view('pems.qandaoffline')->with('examcode',$examcode)->with('exam',$exam)->with('qcount',$qcount)->with('questions',$questions)->with('qno',$qno);
 
        return view ('pems.qandaoffline');
    }
    public function invoicing(){
        return view ('pems.invoicing');
    }
    public function certificate(Request $req){
        $memberid = NULL;
        $member=DB::table('users')->where('student_id',$req->userid)->orWhere('student_id',$req->memberid)->first();
          $users = User::all();
        return view ('pems.certificate')
        ->with('member',$member)->with('users',$users)->with('memberid',$memberid);
    }
    public function certificateq(Request $req){
        $memberid = $req->userid;

        $count=DB::table('users')->where('student_id',$req->userid)->count();
if($count < 1){
    return redirect()->back();
}

        $member=DB::table('users')->where('student_id',$req->userid)->first();
        $levels=DB::table('levels')->get();
        $users = User::all();
        return view ('pems.certificateq')
        ->with('member',$member)->with('users',$users)->with('levels',$levels)->with('memberid',$memberid);
    }
    public function updateexamresult(Request $request){
        $id = $request->ref_result_id;
        $level = $request->level;
        $pass = $request->pass;
        $examcode = $request->examcode;
        $memberid = $request->userid;

        $created_at = $request->created_at;
        //return 'update exam result'.$id.$level.$pass.$examcode.$memberid.$created_at;
$refs = DB::table('ref_result')->where([['examcode',$examcode],['student_id',$memberid]])->get();
foreach($refs as $ref){
    
$id = $request->id;
$examcode = $ref->id;
$pass = $request->pass;

$level = $request->level;
$created_at = $request->created_at;

        DB::table('ref_result')->where('id',$id)->update( ['pass' => $pass] );
        DB::table('ref_result')->where('id',$id)->update( ['level' => $level] );
        DB::table('ref_result')->where('id',$id)->update( ['created_at' => $created_at] );
 
}

        $memberid = $request->userid;
        $count=DB::table('users')->where('student_id',$request->userid)->count();
                if($count < 1){
                    return redirect()->back();
                }

        $member=DB::table('users')->where('student_id',$request->userid)->first();
        $levels=DB::table('levels')->get();
        $users = User::all();
        return view ('pems.certificateq')
        ->with('member',$member)->with('users',$users)->with('levels',$levels)->with('memberid',$memberid);
    
    }
    public function rossusers(){
        $admins = DB::table('admins')
       // ->where('is_admin',1)
        ->get();
        return view ('pems.rossusers',compact('admins'));
    }
    public function allresult(){
        $member_id = 0;
        $users = User::all();
        return view ('pems.allresult',compact('users','member_id'));
    }
    public function allresultq(Request $req){
        $users = User::all();
        $member_id = $req->userid;
        $q = $req->userid;
         $count = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->orWhere('student_id','=',$q)->count();
    if($count < 1){
        return  redirect()->back();
     }
        $member=DB::table('users')->Where('student_id',$member_id)->first();
        $member_id = $member->student_id;
        return view ('pems.allresult',compact('member','users','member_id'));
    }
    public function downloadresult(Request $req,$id){
        $results = DB::table('result')->where('attempno',$id)->get();
        $ref_result = DB::table('ref_result')->where('id',$id)->first();
        $exam = DB::table('exam')->where('examcode',$ref_result->examcode)->first();
        $users = User::all();
        $member_id = $ref_result->student_id;
        $member=DB::table('users')->Where('student_id',$member_id)->first();
        $member_id = $member->student_id;

        $pdf = PDF::loadView('pems.allresultdownload', compact('member','users','exam','member_id','results','ref_result'));
        $refid = $ref_result->id;
        $date = $ref_result->student_id;
        $pdfname = $date.$refid.'.pdf';
        return $pdf->stream( $pdfname);
    }

    public function bulkemail(){
        return view ('pems.bulkemail');
    }
         

    //-----------------------EXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXmas 

    
    public function selectquestion(){
        $qno = 0;
        $examcode = 0;
        $questions= DB::table('exam_question')->where([['examcode','=',$examcode],['online','=',0]])->get();
        $qcount= DB::table('exam_question')->where('examcode',$examcode)->count();
        $exam= DB::table('exam')->get();
        return view('pems.selectquestion')->with('examcode',$examcode)->with('exam',$exam)->with('qcount',$qcount)->with('questions',$questions)->with('qno',$qno);
 
    }

    public function addnewquestion(Request $request,$examcode){
        $examcode = $request->examcode;
  
          $question = New Question;
          $question->examcode=$examcode;
          $question->question=$request->question;
          $question->option_A=$request->option_A;
          $question->option_B=$request->option_B;
          $question->option_C=$request->option_C;
          $question->option_D=$request->option_D;
          $question->online = $request->online;
          $question->correct_option=$request->correct_option;
          $question->save();
  
          $qno = $request->qno;
          $questions= DB::table('exam_question')->where('id',$qno)->where('online',1)->get();
          $qqq= DB::table('exam_question')->where('id',$qno)->where('online',1)->first();
          $questions2= DB::table('exam_question')->where('examcode',$examcode)->where('online',1)->get();
          $examcode= $examcode;
          $qcount= DB::table('exam_question')->where('examcode',$examcode)->count();
          $exam= DB::table('exam')->get();
          return redirect()->back()->with('examcode',$examcode)->with('exam',$exam)->with('qqq',$qqq)->with('qcount',$qcount)->with('questions',$questions)->with('questions2',$questions2)->with('qno',$qno);
           
    }
    public function addnewquestion1(Request $request){
      $examcode = $request->examcode;
        $question = New Question;
        $question->examcode=$examcode;
        $question->question=$request->question;
        $question->option_A=$request->option_A;
        $question->option_B=$request->option_B;
        $question->option_C=$request->option_C;
        $question->option_D=$request->option_D;
        $question->online = $request->online;
        $question->correct_option=$request->correct_option;
        $question->save();

        $qcount= DB::table('exam_question')->where('examcode',$examcode)->count();
        $questions= DB::table('exam_question')->where([['examcode','=',$examcode],['online','=',1]])->get();
        $questions2= DB::table('exam_question')->where([['examcode','=',$examcode],['online','=',1]])->get();
        $exam=DB::table('exam')->get();
        $exam1=DB::table('exam')->get();
        $qno = 0;
         return view('pems.addnewquestion1')->with('examcode',$examcode)->with('exam',$exam)->with('qno',$qno)->with('questions',$questions)->with('questions2',$questions2)->with('qcount',$qcount);

          
  }
  public function addnewquestion2(Request $request){
    $examcode = $request->examcode;
      $question = New Question;
      $question->examcode=$examcode;
      $question->question=$request->question;
      $question->option_A=$request->option_A;
      $question->option_B=$request->option_B;
      $question->option_C=$request->option_C;
      $question->option_D=$request->option_D;
      $question->online = $request->online;
      $question->correct_option=$request->correct_option;
      $question->save();

      $qcount= DB::table('exam_question')->where('examcode',$examcode)->count();
      $questions= DB::table('exam_question')->where([['examcode','=',$examcode],['online','=',1]])->get();
      $questions2= DB::table('exam_question')->where([['examcode','=',$examcode],['online','=',1]])->get();
      $exam=DB::table('exam')->get();
      $exam1=DB::table('exam')->get();
      $qno = 0;
       return view('pems.addnewquestion1')->with('examcode',$examcode)->with('exam',$exam)->with('qno',$qno)->with('questions',$questions)->with('questions2',$questions2)->with('qcount',$qcount);

        
}



   
    public function selectexam(Request $request){
        $qno = 0;
        $examcode = $request->subjectid;
  /* $questions = DB::table('exam_question')->get();
        foreach($questions as $q){
            DB::table('exam_question')
              ->where('id', $q->id)
              ->update(['online' => 1]);
        }
        */
        //$questions2= DB::table('exam_question')->where('examcode',$examcode)->where('online',3)->get();
        $qcount= DB::table('exam_question')->where('examcode',$examcode)->count();
        $questions= DB::table('exam_question')->where([['examcode','=',$examcode],['online','=',1]])->get();
        $questions2= DB::table('exam_question')->where([['examcode','=',$examcode],['online','=',1]])->get();
        $exam=DB::table('exam')->get();
        $exam1=DB::table('exam')->get();
        return view('pems.selectquestion')->with('examcode',$examcode)->with('exam',$exam)->with('qno',$qno)->with('questions',$questions)->with('questions2',$questions2)->with('qcount',$qcount);
 
    }
    public function selectexamquestionno(Request $request){
       // $qno = 0;
         $qno = $request->qno;

        $questions= DB::table('exam_question')->where('id',$qno)->where('online',1)->get();
        $qqq= DB::table('exam_question')->where('id',$qno)->where('online',1)->first();
        $questions2= DB::table('exam_question')->where('examcode',$qqq->examcode)->where('online',1)->get();

        $examcode= $qqq->examcode;
        $qcount= DB::table('exam_question')->where('examcode',$examcode)->count();
        $exam= DB::table('exam')->get();
        return view('pems.selectquestion')->with('examcode',$examcode)->with('exam',$exam)->with('qqq',$qqq)->with('qcount',$qcount)->with('questions',$questions)->with('questions2',$questions2)->with('qno',$qno);
 
    }
    public function exameditquestion(Request $request,$examcode){
        $id=$request->id;
        $question=$request->question;
        $option_A=$request->option_A;
        $option_B=$request->option_B;
        $option_C=$request->option_C;
        $option_D=$request->option_D;
        $online=$request->online;
        //$marks=$request->marks;
        $correct_option=$request->correct_option;
        DB::table('exam_question')->where('id',$id)->update(['id' => $id,'question'=>$question,'option_A'=>$option_A,'option_B'=>$option_B,'option_C'=>$option_C,'option_D'=>$option_D,'online'=>$online ,'correct_option'=>$correct_option]);
//--------------------------------------------------------------------------------------------------
        $exam= DB::table('exam_question')->where('examcode',$examcode)->get();
       // return view('pems.examquestionedit')->with('exam',$exam)->with('examcode',$examcode);
       $examcode = $request->id;
      // $examcode = $request->$request->id;
        $qno = $request->id;
      // $qno = $request->$request->id;

        $questions= DB::table('exam_question')->where('id',$qno)->get();
        $qqq= DB::table('exam_question')->where('id',$qno)->first();
        $examcode= $qqq->examcode;
        $qcount= DB::table('exam_question')->where('examcode',$examcode)->count();
        $exam= DB::table('exam')->get();
        return view('pems.selectquestion')->with('examcode',$examcode)->with('exam',$exam)->with('qqq',$qqq)->with('qcount',$qcount)->with('questions',$questions)->with('qno',$qno);
 
    }
    
    
    public function showonlinequestions(Request $request,$examcode,$qid){
        //        $id=$request->id;
                $question = New Question;
               // $question->owner_id=$request->online;
               $question->id=$qid;
               $question->examcode=$examcode;
               $question->question=$request->question;
                $question->option_A=$request->ans1;
                $question->option_B=$request->ans2;
                $question->option_C=$request->correct;
                $question->option_D=$request->ans3;
                $question->pageno=$request->pageno;
                //$marks=$request->marks;
                $question->correct_option='C';
                $question->correct_answer=$request->correct;
                
                $question->save();
        
               // DB::table('exam_question')->where('id',$id)->update(['id' => $id,'question'=>$question,'option_A'=>$option_A,'option_B'=>$option_B,'option_C'=>$option_C,'option_D'=>$option_D ,'correct_option'=>$correct_option]);
        //--------------------------------------------------------------------------------------------------
                $exam= DB::table('exam_question')->where('examcode',$examcode)->get();
              //  return view('pems.examquestionedit')->with('exam',$exam)->with('examcode',$examcode);
              return redirect()->back();
         
            }


//**----------------------------------------------*offline exams  --------------------------------------------------------------------------*/

            
    public function selectquestionoffline(){
        $qno = 0;
        $examcode = 0;
        $questions= DB::table('exam_question')->where([['examcode','=',$examcode],['online','=',0]])->get();
        $qcount= DB::table('exam_question')->where('examcode',$examcode)->count();
        $exam= DB::table('exam')->get();
        return view('pems.qandaoffline')->with('examcode',$examcode)->with('exam',$exam)->with('qcount',$qcount)->with('questions',$questions)->with('qno',$qno);
 
    }

    public function addnewquestionoffline(Request $request,$examcode){
      
        
                $question = New Question;
                $question->examcode=$examcode;
                $question->online=0;
                $question->question=$request->question;
                $question->option_A=$request->option_A;
                $question->option_B=$request->option_B;
                $question->option_C=$request->option_C;
                $question->option_D=$request->option_D;
                $question->correct_option=$request->correct_option;
                $question->save();
        $qno = 0;
        $examcode = $examcode;
        $questions= DB::table('exam_question')->where('examcode',$examcode)->get();
        $qcount= DB::table('exam_question')->where('examcode',$examcode)->count();
        $exam= DB::table('exam')->get();
        return redirect()->back()->with('examcode',$examcode)->with('exam',$exam)->with('qqq',$qqq)->with('qcount',$qcount)->with('questions',$questions)->with('questions2',$questions2)->with('qno',$qno);


 
            }

public function selectexamoffline(Request $request){
        $qno = 0;
        $examcode = $request->subjectid;
        $qcount= DB::table('exam_question')->where('examcode',$examcode )->count();
        $questions= DB::table('exam_question')->where([['examcode','=',$examcode],['online','=',0]])->get();
        $exam=DB::table('exam')->get();
        $exam1=DB::table('exam')->get();
        return view('pems.qandaoffline')->with('examcode',$examcode)->with('exam',$exam)->with('qno',$qno)->with('questions',$questions)->with('qcount',$qcount);
 
    }
    public function selectexamquestionnooffline(Request $request){
       // $qno = 0;
        $examcode = $request->qno;
        $qno = $request->qno;

        $questions= DB::table('exam_question')->where('id',$qno)->get();
        $qqq= DB::table('exam_question')->where('id',$qno)->first();
        $questions2= DB::table('exam_question')->where('examcode',$qqq->examcode)->where('online',0)->get();

        $examcode= $qqq->examcode;
        $qcount= DB::table('exam_question')->where('examcode',$examcode)->count();
        $exam= DB::table('exam')->get();
        return view('pems.qandaoffline')->with('examcode',$examcode)->with('exam',$exam)->with('qqq',$qqq)->with('questions2',$questions2)->with('qcount',$qcount)->with('questions',$questions)->with('qno',$qno);
 
    }
    public function exameditquestionoffline(Request $request,$examcode){
        $id=$request->id;
        $question=$request->question;
        $option_A=$request->option_A;
        $option_B=$request->option_B;
        $option_C=$request->option_C;
        $option_D=$request->option_D;
        $online=$request->online;
        //$marks=$request->marks;
        $correct_option=$request->correct_option;
        DB::table('exam_question')->where('id',$id)->update(['id' => $id,'question'=>$question,'option_A'=>$option_A,'option_B'=>$option_B,'option_C'=>$option_C,'option_D'=>$option_D,'online'=>$online ,'correct_option'=>$correct_option]);
//--------------------------------------------------------------------------------------------------
        $exam= DB::table('exam_question')->where('examcode',$examcode)->get();
       // return view('pems.examquestionedit')->with('exam',$exam)->with('examcode',$examcode);
       $examcode = $request->id;
      // $examcode = $request->$request->id;
        $qno = $request->id;
      // $qno = $request->$request->id;

        $questions= DB::table('exam_question')->where('id',$qno)->get();
        $qqq= DB::table('exam_question')->where('id',$qno)->first();
        $examcode= $qqq->examcode;
        $qcount= DB::table('exam_question')->where('examcode',$examcode)->count();
        $exam= DB::table('exam')->get();
        return view('pems.qandaoffline')->with('examcode',$examcode)->with('exam',$exam)->with('qqq',$qqq)->with('qcount',$qcount)->with('questions',$questions)->with('qno',$qno);
 
    }
    
    
    public function showofflinequestions(Request $request,$examcode,$qid){
        //        $id=$request->id;
            $question = New Question;
            // $question->owner_id=$request->online;
            $question->id=$qid;
            $question->examcode=$examcode;
            $question->question=$request->question;
            $question->option_A=$request->ans1;
            $question->option_B=$request->ans2;
            $question->option_C=$request->correct;
            $question->option_D=$request->ans3;
            $question->pageno=$request->pageno;
            //$marks=$request->marks;
            $question->correct_option='C';
            $question->correct_answer=$request->correct;
            
            $question->save();
        
               // DB::table('exam_question')->where('id',$id)->update(['id' => $id,'question'=>$question,'option_A'=>$option_A,'option_B'=>$option_B,'option_C'=>$option_C,'option_D'=>$option_D ,'correct_option'=>$correct_option]);
        //--------------------------------------------------------------------------------------------------
                
        /*where([
    ['status', '=', '1'],
    ['subscribed', '<>', '1'],
])->get();*/
        $exam= DB::table('exam_question')->where([
            ['examcode','=',$examcode],
            ['online','=',0],     
            ])->get();
              //  return view('pems.examquestionedit')->with('exam',$exam)->with('examcode',$examcode);
              return redirect()->back();
         
            }


}
