<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Validator;
use App\Doctor;
use App\Rezident;
use App\Account;
use Session;
use Carbon\Carbon;

use App\Pacient;
use App\Region;
use App\Specialization;
use App\Title;
use App\Package;
use App\Service;
use App\Vacation;
use App\AvailableResident;

use App\Mail\SendHoliday;
use App\Mail\SendReservation;
use App\Mail\SendMessageCod;
use App\Mail\LogedIn;

class AccountController extends Controller
{
    public function register(Request $request){
 
        $form_data = $request->only(['name','password','confirm_password','email', 'termeni','id_type']);
        $validationRules = [
            'name' =>['required','min:3'],
            'password'    => ['required','min:6'],
            'confirm_password'    => ['required','min:6'],
            'email'   => ['required','email', 'unique:accounts'],
            'termeni'   => ['required'],
        ];
      
        $validationMessages = [
            'name.required'    => "Te rugam sa introduci numele!",
            'email.email'    => "Trebuie sa introduci o adresa de :attribute valida!",
            'email.unique'    => "Exista un cont asociat acestei adrese de email!",
            'email.required'    => "Campul email este obligatoriu!",
            'password.min'    => "Dimensiunea parolei prea mica!",
            'confirm_password.min'    => "Dimensiunea parolei prea mica!",
            'password.required'    => "Campul parola trebuie completat!",
            'confirm_password.required'    => "Parola trebuie confirmata!",
            'termeni.required'    => "Trebuie sa accepti termenii si conditiile!",
        ];
        $validator = Validator::make($form_data, $validationRules, $validationMessages);
        if(!filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)){
           return ['success' => false, 'msg' => 'Adresa de email nu respecta formatul standard! Ex: email@email.com'];
        }
        if ($validator->fails())
            return ['success' => false, 'msg' => $validator->errors()->all()];  
        else{
            if($request->input('password') != $request->input('confirm_password')){
              return ['success' => false, 'msg' => 'Parolele nu se potrivesc!'];  
            }

            //Pentru fiecare rezident nou contul ii va expira dupa un an.
            if($request->input('id_type') == 2){
                $expDate = Carbon::today()->addYear()->format('Y-m-d');
            }else{
              $expDate = null;
            }
            $id_inserat = DB::table('accounts')->insertGetId(
                [
                  'name'      => $request->input('name'), 
                  'id_type'      => $request->input('id_type'), 
                  'email'      => $request->input('email'), 
                  'password'     => Hash::make($request->input('password')), 
                  'exp_date'     =>$expDate,
                ]
            );
          if($id_inserat){
            return ['success' => true, 'msg' => "Contul a fost creat cu succes! Va rugam sa va autentificati!"];
          }
          else{
            return ['success' => false, 'msg' => "Contul nu a putut fi creat! Va rugam reincercati!"];
          }
        }
    }
    public function login(Request $request){
 
        $form_data = $request->only(['password','email',]);
        $validationRules = [
            'password'    => ['required','min:6'],
            'email'   => ['required','email'],
        ];
      
        $validationMessages = [
            'email.email'    => "Trebuie sa introduci o adresa de :attribute valida!",
            'email.required'    => "Campul email este obligatoriu!",
            'password.min'    => "Dimensiunea parolei prea mica!",
            'password.required'    => "Campul parola trebuie completat!",
        ];
        $validator = Validator::make($form_data, $validationRules, $validationMessages);
        if ($validator->fails())
            return ['success' => false, 'msg' => $validator->errors()->all()];  
        else{
          $user = Account::where(['email' => $request->input('email')])->first();
          if($user && Hash::check($request->input('password'), $user->password)){
            $date_sesiune = array(
              'id' => $user->id,
            );
            $dateUser = $user = Account::where(['email' => $request->input('email')])->first();
            Session::put('user', $date_sesiune);
            Mail::to($request->get('email'))->send(new LogedIn($dateUser));
            return [
              'success' => true,
               'msg' => "Logat cu succes!",
            ];

          }
          else{
            return ['success' => false, 'msg' => "Email sau parola gresite!"];
          }
        }      
    }

    public function logout(){
        Session::forget('user');
        return redirect('/');
    }
    public function reinoieste_abonament(){
        $newDate = Carbon::now()->addYear()->format('Y-m-d');
        if(Session::has('user')){
          $usr = Session::get('user');
          $user = Account::where('id',$usr['id'])->first();
          if($user['id_type'] ==2){
            DB::table('accounts')->where(['id'=> Session::get('user')['id']])->update(['exp_date'=>$newDate]);
            return ['success' => true, 'msg' => "Abonamentul a fost reinoit!"];
          }
      }
    }
    public function delete(){
        if(Session::has('user')){
          $usr = Session::get('user');
          $user = Account::where('id',$usr['id'])->first();
          if($user['id_type'] ==1){
            Vacation::where('id_medic', '=', $usr['id'])->delete();
          }
          if($user['id_type'] ==2){
            AvailableResident::where('id_rezident', '=', $usr['id'])->delete();
          }
          Account::where('id', '=', $usr['id'])->delete();
          return ['success' => true, 'msg' => "Contul a fost sters!"];
          Session::forget('user');
      }
    }

    public function cont(){
      $currDate = Carbon::today()->format('Y-m-d');
      // dd($currDate);
        if(Session::has('user')){
            $usr = Session::get('user');
            $user = Account::where('id',$usr['id'])->first();
            if($user->exp_date<$currDate){
              $abonamentExpirat = true;
            }else{
              $abonamentExpirat = false;
            }
            if($user->id_type ==1){
                return view('cont-medic',[
                  'user'=>$user,
                  'abonamentExpirat' =>$abonamentExpirat,
                ]);
            }
               
            else{
                return view('cont-rezident',[
                  'user'=>$user,
                  'abonamentExpirat' =>$abonamentExpirat,
                ]);
            }
        }

        return redirect('/');
    }
    public function date(){

      $judete = Region::get();
      $specializari = Specialization::get();
      $tipPacienti  = Pacient::get();
      $titlulatura = Title::get();
        if(Session::has('user')){
            $usr = Session::get('user');
            $user = Account::where('id',$usr['id'])->first();
            
            return view('date',[
              'judete'=>$judete,
              'specializari'=>$specializari,
              'tipPacienti'=>$tipPacienti,
              'titlulatura'=>$titlulatura,
            ]);
        }else{

          return redirect('/');
        }
  
    }
    public static function generateRandomString($length = 90) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }

    public function modifica_parola(Request $request){
      if($request->input('actiune_modificare') == "trimite_cod"){
          $form_data = $request->only(['email']);
          $validationRules = [
              'email'   => ['required','email'],
          ];
  
          $validationMessages = [
              'email.email'    => "Trebuie sa introduci o adresa de :attribute valida!",
              'email.required'    => "Campul email este obligatoriu!",
          ];
          $validator = Validator::make($form_data, $validationRules, $validationMessages);
          if ($validator->fails())
              return ['success' => false, 'msg' => $validator->errors()->all()];  
          else{
            $htmlcodparola = "<input type='text' class ='cont-input' name='cod' placeholder='Cod primit pe email' autocomplete='off'/>
                             <input type='password' class ='cont-input' name='parola1' placeholder='Parola' autocomplete='off'/>
                             <input type='password' class ='cont-input' name='parola2' placeholder='Parola noua' autocomplete='off'/>";
            try{
                  $user = Account::where(['email' => $request->input('email')])->first();
                  if($user){
                    $codDeTrimis = $this->generateRandomString(10);
                    try{
                        DB::table('accounts')->where('email', $request->input('email'))->update(
                            ['cod_email_schimbare_parola' => $codDeTrimis]
                        );
                        Mail::to($request->get('email'))->send(new SendMessageCod($codDeTrimis));
                        return ['success' => true, 'msg' => "Introdu codul primit pe email!", 'htmlcodparola' => $htmlcodparola, 'actiune' => 'verifica-cod'];
                    } catch (\Illuminate\Database\QueryException $e) {
                        return ['success' => false, 'msg' => "Nu s-a putut modifica parola. Reincercati!"];  
                    }
                  }
                  else{
                    return ['success' => false, 'msg' => "Adresa de email nu exista sau nu este buna!"];
                  }
            } catch (\Illuminate\Database\QueryException $e) {
                  return ['success' => false, 'msg' => "Nu s-a gasit adresa de email. Reincercati!"];  
            }
          }  
      } 
      if($request->input('actiune_modificare') == "verifica_cod"){
          $form_data = $request->only(['cod','parola1','parola2']);
          $validationRules = [
              'cod'   => ['required'],
              'parola1'   => ['required', 'min:6'],
              'parola2'   => ['required', 'min:6'],
          ];
  
          $validationMessages = [
              'cod.required'    => "Codul este obligatoriu!",
              'parola1.required'    => "Ambele parole trebuie completate!",
              'parola1.min'    => "Parola trebuie sa aiba minim :min caractere!",
              'parola2.required'    => "Ambele parole trebuie completate!",
              'parola2.min'    => "Parola trebuie sa aiba minim :min caractere!",
          ];
          $validator = Validator::make($form_data, $validationRules, $validationMessages);
          if ($validator->fails())
              return ['success' => false, 'msg' => $validator->errors()->all()];  
          else{
              try {
                if($request->input('parola1') != $request->input('parola2')){
                  return ['success' => false, 'msg' => 'Parolele nu se potrivesc!'];  
                } else{
                  $nr_update = DB::table('accounts')->where('cod_email_schimbare_parola', $request->input('cod'))->update(
                      ['password' => Hash::make($request->input('parola1'))]
                  );
                  if($nr_update){
                    return ['success' => true, 'msg' => "Parola a fost modificata cu succes!", 'actiune' => 'parola-modificata'];
                  }
                  else{
                    return ['success' => false, 'msg' => "Codul introdus nu se potriveste! Verificati adresa de email!"];
                  }
                }
                
              } catch (\Illuminate\Database\QueryException $e) {
                  return ['success' => false, 'msg' => "Nu s-a putut modifica parola. Reincercati!"];  
              }
          } 
      }
      
    }

    public function edit_cont(Request $request){
 
      $form_data = $request->only(['cont_telefon','cont_parafa','cont_specializare','cont_titulatura','cont_pacienti','cont_locatie','cont_judet','cont_termeni']);
      $validationRules = [
          'cont_telefon'    => ['required','min:6'],
          'cont_parafa'    => ['required'],
          'cont_specializare'    => ['required'],
          'cont_titulatura'    => ['required'],
          'cont_pacienti'    => ['required'],
          'cont_judet'    => ['required'],
          'cont_locatie'    => ['required','min:6'],
          'cont_termeni'    => ['required'],
      ];
    
      $validationMessages = [
          'cont_telefon.min'    => "Campul telefon trebuie sa contina :min caractere!",
          'cont_telefon.required'    => "Campul telefon este obligatoriu!",
          'cont_parafa.required'    => "Campul parafa este obligatoriu!",
          'cont_specializare.required'    => "Campul specializare este obligatoriu!",
          'cont_titulatura.required'    => "Campul titulatura este obligatoriu!",
          'cont_pacienti.required'    => "Campul tip pacienti este obligatoriu!",
          'cont_locatie.min'    => "Campul locatie trebuie sa contina :min caractere!",
          'cont_judet.required'    => "Campul judet este obligatoriu!",
          'cont_termeni.required'    => "Campul termeni este obligatoriu!",
      ];
      $validator = Validator::make($form_data, $validationRules, $validationMessages);
      if ($validator->fails())
          return ['success' => false, 'error' => $validator->errors()->all()];  
      else{
      //   if(!filter_var($request->input('cont_email'), FILTER_VALIDATE_EMAIL)){
      //     return ['success' => false, 'error' => 'Adresa de email nu respecta formatul standard! Ex: email@email.com'];
      //  }
        try{
          $date_de_modificat = array();
          if($request->input('cont_name') !== null && !empty($request->input('cont_name'))){
              $date_de_modificat['name'] = $request->input('cont_name');
          } 
          if($request->input('cont_email') !== null && !empty($request->input('cont_email'))){
              $date_de_modificat['email'] = $request->input('cont_email');
          } 
          if($request->input('cont_password') !== null && !empty($request->input('cont_password'))){
              $date_de_modificat['password'] = Hash::make($request->input('cont_password'));
          } 
          if($request->input('cont_telefon') !== null && !empty($request->input('cont_telefon'))){
              $date_de_modificat['telefon'] = $request->input('cont_telefon');
          } 
          if($request->input('cont_parafa') !== null && !empty($request->input('cont_parafa'))){
              $date_de_modificat['parafa'] = trim(strtoupper($request->input('cont_parafa')));
          } 
          if($request->input('cont_specializare') !== null && !empty($request->input('cont_specializare'))){
              $date_de_modificat['id_specializare'] = $request->input('cont_specializare');
          } 
          if($request->input('cont_titulatura') !== null && !empty($request->input('cont_titulatura'))){
              $date_de_modificat['id_titulatura'] = $request->input('cont_titulatura');
          } 
          if($request->input('cont_pacienti') !== null && !empty($request->input('cont_pacienti'))){
              $date_de_modificat['id_pacienti'] = $request->input('cont_pacienti');
          } 
          if($request->input('cont_judet') !== null && !empty($request->input('cont_judet'))){
              $date_de_modificat['id_judet'] = $request->input('cont_judet');
          } 
          if($request->input('cont_locatie') !== null && !empty($request->input('cont_locatie'))){
              $date_de_modificat['locatie'] = $request->input('cont_locatie');
          } 
          if($request->input('cont_informatii') !== null && !empty($request->input('cont_informatii'))){
              $date_de_modificat['informatii'] = $request->input('cont_informatii');
          } 
          DB::table('accounts')->where(['id'=> Session::get('user')['id']])->update(
              $date_de_modificat
          );
          return ['success' => true, 'error' => "Datele au fost salvate cu succes!"];
        } 
        catch (\Illuminate\Database\QueryException $e) {
             return ['success' => false, 'error' => "Nu s-au putut modifica datele. Reincercati!"];  
        }
      }
            
  }
  public function beneficii(){
      $currDate = Carbon::today()->format('Y-m-d');
      if(Session::has('user')){
          $usr = Session::get('user');
          $user = Account::where('id',$usr['id'])->first();
          if($user->exp_date<$currDate){
            $abonamentExpirat = true;
          }else{
            $abonamentExpirat = false;
          }
          if($user->id_type ==2){
              return view('beneficii',[
                'abonamentExpirat'=>$abonamentExpirat,
                'user'=>$user,
              ]);
          }else{

               return redirect('/');
          }
      }

      return redirect('/');
  }

  public function pachete(){
    $servicii = Service::get();
    $pachete = Package::get();
    $currDate = Carbon::today()->format('Y-m-d');
    
    foreach($servicii as $item){
      if($item->id_pachet ==1)
        $serviciiBaza[] = $item;
      if($item->id_pachet ==2)
        $serviciiStandard[] = $item;
    }
    if(Session::has('user')){
        $usr = Session::get('user');
        $user = Account::where('id',$usr['id'])->first();
        if($user->exp_date<$currDate){
          $abonamentExpirat = true;
        }else{
          $abonamentExpirat = false;
        }
        if($user->id_type ==1){
            return view('pachete',[
              'user'=>$user,
              'pachete'=>$pachete,
              'abonamentExpirat'=>$abonamentExpirat,
              'serviciiBaza'=>$serviciiBaza,
              'serviciiStandard'=>$serviciiStandard,
             
            ]);
        }else{

             return redirect('/');
        }
    }

    return redirect('/');
  }

      // as putea sa fac o interogare dar deja este facuta sa nu intru si sa fac o interogare daca are toate datele introduse
  public function concediu(){
    
     if(Session::has('user')){
          $currDate = Carbon::today()->format('Y-m-d');
          $usr = Session::get('user');
          $user = Account::where('id',$usr['id'])->first();
          if($user->id_type == 1){
            if($user->exp_date >= $currDate){
              return view('concediu',[
                'user'=>$user,
              ]);
            } else{
              return redirect('pachete');
            }
            
          } elseif($user->id_type == 2){
            if($user->exp_date >= $currDate){
              return view('concediu-rezident',[
                'user'=>$user,
              ]);
            } else{
              return redirect('beneficii');
            }
          } else{
             return redirect('/');
          }
      } else{
         return redirect('/');
      } 
  }
  
     public function concediu_medic(Request $request){
       
      $usr = Session::get('user');
      $user = Account::where('id',$usr['id'])->first();
      $form_data = $request->only(['concediu_date','start_hour','end_hour','name','email','phone','locatie']);
          $validationRules = [
              'concediu_date'    => ['required'],
              'start_hour'   => ['required'],
              'end_hour'   => ['required'],
          ];
       
       $date = explode('-',$form_data['concediu_date']);
       $start_date = Carbon::createFromFormat('d.m.Y',trim($date[0]));
       $end_date = Carbon::createFromFormat('d.m.Y',trim($date[1]));
       

          $validationMessages = [
              'concediu_date.required'    => "Campul data este obligatoriu!",
              'start_hour.required'    => "Campul ora inceput este obligatoriu!",
              'end_hour.required'    => "Campul ora sfarsit este obligatoriu!",
          ];
          $validator = Validator::make($form_data, $validationRules, $validationMessages);
          if ($validator->fails())
              return ['success' => false, 'msg' => $validator->errors()->all()];  
          else{           
                   $id_inserat = DB::table('vacations')->insertGetId(
                [
                  'id_medic'      => $user->id, 
                  'medic_email'  =>$user->email,
                  'medic_phone'  =>$user->telefon,
                  'medic_titulatura'  =>$user->id_titulatura,
                  'medic_pacienti'  =>$user->id_pacienti,
                  'medic_judet'  =>$user->id_judet,
                  'medic_locatie'  =>$user->locatie,
                  'start_hour'      => $request->input('start_hour'), 
                  'end_hour'      => $request->input('end_hour'), 
                  'start_date'      => $start_date->format('Y-m-d'), 
                  'end_date'      => $end_date->format('Y-m-d'), 
                ]
            );
            Mail::to(setting('contact.email'))->send(new SendHoliday($request->all()));
            return ['success' => true, 'msg' => "Datele au fost salvate cu succes!"];
    }
  }
  
   public function concediu_rezident(Request $request){
       
      $usr = Session::get('user');
      $user = Account::where('id',$usr['id'])->first();
      $form_data = $request->only(['concediu_date','start_hour','end_hour','name','email','phone','locatie']);
          $validationRules = [
              'concediu_date'    => ['required'],
              'start_hour'   => ['required'],
              'end_hour'   => ['required'],
          ];
       
       $date = explode('-',$form_data['concediu_date']);
       $start_date = Carbon::createFromFormat('d.m.Y',trim($date[0]));
       $end_date = Carbon::createFromFormat('d.m.Y',trim($date[1]));
       

          $validationMessages = [
              'concediu_date.required'    => "Campul data este obligatoriu!",
              'start_hour.required'    => "Campul ora inceput este obligatoriu!",
              'end_hour.required'    => "Campul ora sfarsit este obligatoriu!",
          ];
          $validator = Validator::make($form_data, $validationRules, $validationMessages);
          if ($validator->fails())
              return ['success' => false, 'msg' => $validator->errors()->all()];  
          else{           
                   $id_inserat = DB::table('available_residents')->insertGetId(
                [
                  'id_rezident'      => $user->id,
                  'nume_rezident'=>$user->name,
                  'rezident_email'  =>$user->email,
                  'rezident_phone'  =>$user->telefon,
                  'rezident_titulatura'  =>$user->id_titulatura,
                  'rezident_pacienti'  =>$user->id_pacienti,
                  'rezident_judet'  =>$user->id_judet,
                  'rezident_locatie'  =>$user->locatie,
                  'start_hour'      => $request->input('start_hour'), 
                  'end_hour'      => $request->input('end_hour'), 
                  'start_date'      => $start_date->format('Y-m-d'), 
                  'end_date'      => $end_date->format('Y-m-d'), 
                ]
            );
            Mail::to(setting('contact.email'))->send(new SendReservation($request->all()));
            return ['success' => true, 'msg' => "Datele au fost salvate cu succes!"];
    }
  }
  
    public function istoric(Request $request){
      
      if(Session::has('user')){
            $currDate = Carbon::today()->format('Y-m-d');
            $usr = Session::get('user');
            $user = Account::where('id',$usr['id'])->first();
            if($user->id_type == 1){
              $concedii = Vacation::orderBy('start_date','desc')->get();
              $concediuMedic = [];
              foreach($concedii as $concediu){
                if(strtotime($concediu->end_date)<time())
                  continue;
                if($concediu->id_medic == $user->id)
                $concediuMedic[] = $concediu;
                
              }
              
             return view('istoric-medic',[
               'concediuMedic'=>$concediuMedic,
               'currDate'=>$currDate,
             ]);

            } elseif($user->id_type == 2){
              $concedii = AvailableResident::orderBy('start_date','desc')->get();
              $concediuRezident = [];
              foreach($concedii as $concediu){
                if(strtotime($concediu->end_date)<time())
                  continue;
                if($concediu->id_rezident == $user->id)
                $concediuRezident[] = $concediu;
              }
              return view('istoric-rezident',[
                'currDate'=>$currDate,
                'concediuRezident'=>$concediuRezident,
              ]);
        } else{
           return redirect('/');
        } 
    }
  }

  public function concediu_finalizat(Request $request){
    $concediu = Vacation::find($request->concediu_id);
    $concediu->is_finished = $request->finalizat ? 1:0;
    $concediu->save();
  }

  public function disponibilitate_finalizata(Request $request){
    $concediu = AvailableResident::find($request->concediu_id);
    $concediu->is_finished = $request->finalizat ? 1:0;
    $concediu->save();
  }
}
