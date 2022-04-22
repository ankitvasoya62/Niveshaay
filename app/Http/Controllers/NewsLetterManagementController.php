<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterUser;
use App\Models\Newsletter;
use Mail;
use App\Mail\NewsletterMail;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\NewsletterUserImport;
use App\Rules\ExcelRule;
use File;

class NewsLetterManagementController extends Controller
{
    //
    public function newsletterusers(){
        $active = "newsletterusers";
        $newsletterusers = NewsletterUser::orderBy('id','desc')->get();
        return view('backend.newsletter.newsletteruser',compact('newsletterusers','active'));
    }

    public function addnewsletterusers(){
        $active = "newsletterusers";
        return view('backend.newsletter.addnewsletteruser',compact('active'));
    }

    public function storenewsletterusers(Request $request){
        $this->validate($request,[
            // 'first_name'=>'required',
            // 'last_name'=>'required',
            'email'=>'required|email',
            
            
        ]);

        $newsletteruser = new NewsletterUser;
        $newsletteruser->first_name = $request->first_name;
        $newsletteruser->last_name = $request->last_name;
        $newsletteruser->email = $request->email;
        $newsletteruser->phone_no = $request->phone_no;
        $newsletteruser->save();
        return redirect()->route('admin.newsletter.users')->with('success','Newsletter User added successfully!');
    }

    public function editnewsletteruser($id){
        $active = "newsletterusers";
        $newsletteruser = NewsletterUser::find($id);
        return view('backend.newsletter.editnewsletteruser',compact('active','newsletteruser'));
    }

    public function updatenewsletteruser(Request $request,$id){
        $this->validate($request,[
            // 'first_name'=>'required',
            // 'last_name'=>'required',
            'email'=>'required|email',
            
            
        ]);

        $newsletteruser = NewsletterUser::find($id);
        $newsletteruser->first_name = $request->first_name;
        $newsletteruser->last_name = $request->last_name;
        $newsletteruser->email = $request->email;
        $newsletteruser->phone_no = $request->phone_no;
        $newsletteruser->save();
        return redirect()->route('admin.newsletter.users')->with('success','Newsletter user updated successfully!');        
    }

    public function deletenewsletteruser($id){
        $newsletteruser = NewsletterUser::find($id);
        $newsletteruser->delete();
        return redirect()->route('admin.newsletter.users')->with('success','Newsletter User deleted successfully');
    }

    public function newsletters(){
        $active = "newsletters";
        $newsletters = Newsletter::orderBy('id','desc')->get();
        return view('backend.newsletter.newsletter',compact('newsletters','active'));        
    }

    public function addnewsletters(){
        $active = "newsletters";
        return view('backend.newsletter.addnewsletter',compact('active'));                
    }

    public function storenewsletters(Request $request){
        $this->validate($request,[
            // 'first_name'=>'required',
            // 'last_name'=>'required',
            'title'=>'required',
            'banner'=>'required',
            // 'banner_title'=>'required',
            // 'edi'=>'required',
            // 'title'=>'required',
            'date'=>'required'
            
            
        ]);        

        $newsletter = new Newsletter;
        $newsletter->title = $request->title;
        //$newsletter->banner_title = $request->banner_title;
        $newsletter->date = $request->date;
        $newsletter->editor_top = preg_replace('/<p[^>]*>(&nbsp;|\s+|<br\s*\/?>)*<\/p>/','',$request->editor_top);
        $newsletter->editor_left = preg_replace('/<p[^>]*>(&nbsp;|\s+|<br\s*\/?>)*<\/p>/','',$request->editor_left);
        $newsletter->editor_right = preg_replace('/<p[^>]*>(&nbsp;|\s+|<br\s*\/?>)*<\/p>/','',$request->editor_right);
        $newsletter->editor_bottom = preg_replace('/<p[^>]*>(&nbsp;|\s+|<br\s*\/?>)*<\/p>/','',$request->editor_bottom);
        if($request->file('banner')){
            try{
                $image = $request->file('banner');
                $imageFileExt = $image->getClientOriginalName();
                $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                $imageName = str_replace(" ", "_", $imageFileName).'_' .time().".".$image->extension();
                //$imageName = time().".".$image->extension();
                $destinationPath = public_path('images/newsletter');
                
                if(!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true, true);
                }
                //$imageName = time().".".$image->extension();
                $image->move(public_path('images/newsletter'),$imageName);
                $newsletter->banner= $imageName;
            }catch(\Exception $e){

            }
            
        }
        
        $newsletter->save();

        return redirect()->route('admin.newsletter')->with('success','Newsletter added successfully!');
    }

    public function editnewsletters($id){
        $newsletter = Newsletter::find($id);
        $active = 'newsletters';
        return view('backend.newsletter.editnewsletter',compact('active','newsletter'));
    }

    public function updatenewsletters(Request $request,$id){
        $newsletter = Newsletter::find($id);
        $previous_image =  $newsletter->banner;
        $newsletter->title = $request->title;
        //$newsletter->banner_title = $request->banner_title;
        $newsletter->date = $request->date;
        $newsletter->editor_top = !empty($request->editor_top) || $request->editor_top != "<p><br><p>" ? $request->editor_top : '';
        // $newsletter->editor_left = !empty($request->editor_left) || $request->editor_left != "<p><br><p>" ? $request->editor_left : '';
        $newsletter->editor_left = preg_replace('/<p[^>]*>(&nbsp;|\s+|<br\s*\/?>)*<\/p>/','',$request->editor_left);
        $newsletter->editor_right = preg_replace('/<p[^>]*>(&nbsp;|\s+|<br\s*\/?>)*<\/p>/','',$request->editor_right);
        // $newsletter->editor_right = !empty($request->editor_right) || $request->editor_right != "<p><br><p>" ? $request->editor_right : '';
        $newsletter->editor_bottom = !empty($request->editor_bottom) || $request->editor_bottom != "<p><br><p>" ? $request->editor_bottom : '';
        if($request->file('banner')){
            
            $image = $request->file('banner');
            $imageFileExt = $image->getClientOriginalName();
            $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
            $imageName = str_replace(" ", "_", $imageFileName).'_' .time().".".$image->extension();
            //$imageName = time().".".$image->extension();
            $destinationPath = public_path('images/newsletter');
            
            if(!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            //$imageName = time().".".$image->extension();
            $image->move(public_path('images/newsletter'),$imageName);
            $newsletter->banner= $imageName;
            @unlink(public_path('images/newsletter/'.$previous_image));
            
        }
        $newsletter->save();

        return redirect()->route('admin.newsletter')->with('success','Newsletter updated successfully!');        
    }

    public function deletenewsletter($id){
        $newsletter = Newsletter::find($id);
        $previous_image = $newsletter->banner;
        $newsletter->delete();
        @unlink(public_path('images/newsletter/'.$previous_image));
        return redirect()->route('admin.newsletter')->with('success','Newsletter deleted successfully!');        
    }

    public function shownewsletter($id){
        $newsletter = Newsletter::find($id);

        return view('backend.newsletter.newslettertemplate',compact('newsletter'));
    }

    public function sendnewsletter(){
        $newsletters = Newsletter::all();
        $active = "sendnewsletter";
        $newsletterusers = NewsletterUser::all();
        return view('backend.newsletter.sendnewsletter',compact('newsletterusers','active','newsletters'));
    }

    public function sendnewslettermail(Request $request){
        $this->validate($request,[
            'newsletter_id'=>'required'
        ],
        [
            'newsletter_id.required'=>'Please select any one newsletter'
        ]);
        $newsletterid = $request->newsletter_id;
        $newsletter = Newsletter::find($newsletterid);
        //$newsletteruser = $request->newsletter_user;
        $newsletteruser = NewsLetterUser::all()->where('status','active');
        foreach ($newsletteruser as $key => $value) {
            # code...
            $toEmail = $value['email'];
            try{
                Mail::to($toEmail)->send(new NewsletterMail($newsletter));
            }
            catch(\Throwable $th){
                throw $th;
            }   
        }
          

        return redirect()->back()->with('success','Newsletter sent successfully!');   
    }

    public function bulknewsletteruser(){
        $active = 'bulknewsletterusers';
        return view('backend.newsletter.bulknewsletteruser',compact('active'));
    }

    public function storebulknewsletteruser(Request $request){
        $request->validate([
            'file'=>['required',
            new ExcelRule($request->file('file'))]
        ]);
        try {
            $import=new NewsletterUserImport;
            Excel::import($import,request()->file('file'));
            $getRows=$import->getRowCount();
            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures())->withRows($getRows);
            }
        } catch (\Throwable $th) {
            // throw $th;
            return back()->withError('Something went wrong! Check your file.');
        }
        return back()->withSuccess('Imported Successfully!')->withRows($getRows);
    }

    public function activenewsletteruser($id){
        $newsletteruser = NewsletterUser::find($id);
        $newsletteruser->status = 'active';
        $newsletteruser->save();
        return back()->with('success','Newsletteruser activated successfully!');
    }

    public function deactivenewsletteruser($id){
        $newsletteruser = NewsletterUser::find($id);
        $newsletteruser->status = 'inactive';
        $newsletteruser->save();
        return back()->with('success','Newsletteruser deactivated successfully!');
    }
}
