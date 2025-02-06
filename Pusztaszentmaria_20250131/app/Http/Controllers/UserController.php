<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function Reg(Request $req){
        $req->validate([
            'nev'       =>  'required',
            'email'     =>  'required|email',
            'password'  =>  ['required','confirmed',Password::min(8)
                                                            ->letters()
                                                            ->numbers()
                                                            ->mixedCase()],
            'password_confirmation' => 'required'
        ], [
            'nev.required'          => 'A NEVET KÖTELEZŐ MEGADNI!',
            'email.required'        => 'AZ EMAILT KÖTELEZŐ MEGADNI!',
            'email.email'           => 'AZ EMAIL NEM HIVATALOS',
            'password.required'     => 'A JELSZÓT KÖTELEZŐ MEGADNI!',
            'password.confirmed'    => 'A KÉT JELSZÓ NEM EGGYEZIK!',
            'password.min'          => 'A JELSZÓ MINIMUM 8 KARAKTER HOSSZÚNAK KELL LENNIE',
            'password.letters'      => 'A JELSZÓNAK TARTALMAZNI KELL BETŰKET',
            'password.numbers'      => 'A JELSZÓNAK TARTALMAZNI KELL SZÁMOT',
            'password.mixed'        => 'A JELSZÓNAK TARTALMAZNI KELL KIS ÉS NAGY BETŰT IS',
            'password_confirmation.required' => 'A JELSZÓ MEGERŐSÍTÉST KÖTELEZŐ MEGADNI!'
        ]);
            $data                   = new User;
            $data->nev              = $req->nev;
            $data->email            = $req->email;
            $data->password         = Hash::make($req->password);

            $data->Save();
            return redirect('/login')->with('success', 'Sikeres regisztráció!');
    }

    public function Login(){
        if (!Auth::check()) {
            return view('login'); // A view neve legyen 'login' (elérési út nélkül)
        } else {
            return redirect('/mypage');
        }
    }

    public function LoginData(Request $req){
        $req->validate([
            'credentials'  => 'required',
            'password'     => 'required'
        ], [
            'credentials.required'  => 'Kötelező megadni',
            'password.required'     => 'Kötelező megadni'
        ]);

        // Próbálj meg bejelentkezni névvel
        if (Auth::attempt(['nev' => $req->credentials, 'password' => $req->password])) {
            $req->session()->regenerate();
            return redirect('/mypage')->with('success', 'Sikeresen belépett!');
        }

        // Próbálj meg bejelentkezni emaillel
        if (Auth::attempt(['email' => $req->credentials, 'password' => $req->password])) {
            $req->session()->regenerate();
            return redirect('/mypage')->with('success', 'Sikeresen belépett!');
        }

        // Ha mindkét próbálkozás sikertelen
        return redirect('/login')->withErrors(['sv' => 'Hibás felhasználónév vagy jelszó!']);
    }

    public function MyPage(){
        if(Auth::check()){
            return view('mypage');
        } else {
            return redirect('/login')->with('error', 'Kérlek elöbb jelentkezz be!');
        }
    }

    public function Logout(){
        Auth::logout();
        return redirect('/')->with('success', 'SIkeresen kijelentkeztél!');
    }

    public function Newpass(){
        if(Auth::check()){
            return view('newpass');
        } else {
            return redirect('/login')->with('error', 'Elöbb jelentkezz be!');
        }
    }

    public function NewpassData(Request $req){
        $req->validate([
            'oldpassword'       => 'required',
            'newpassword'       => ['required', 'confirmed', Password::min(8)
                                                                    ->letters()
                                                                    ->numbers()
                                                                    ->mixedCase()],
            'newpassword_confirmation'  => 'required'
        ],[
            'oldpassword.required'                  => 'KÖTELEZŐ MEGADNI A RÉGI JELSZÓT!',
            'newpassword.required'                  => 'KÖTELEZŐ MEGADNI AZ ÚJ JELSZÓT!',
            'newpassword.confirmed'                 => 'NEM EGGYEZNEK A JELSZAVAK!',
            'newpassword.confirmed.required'        => 'KÖTELEZŐ MEGADNI!',
            'newpassword_confirmation.required'     => 'KÖTELEZP MEGADNI!',
            'newpassword.min'                       => 'MINIMUM 8 KARAKTER HOSSZÚSÁGÚ LEGYEN!',
            'newpassword.mixed'                     => 'TARTALMAZNI KELL KIS ÉS NAGY BETŰT IS!',
            'newpassword.numbers'                   => 'TARTALMAZNIA KELL SZÁMOKAT!',
            'newpassword.letters'                   => 'TARTALMAZNI KELL BETŰKET!',
        ]);
        if(Hash::check($req->oldpassword, Auth::user()->password)){
            $data       = User::find(Auth::user()->user_id);
            $data->password = Hash::make($req->newpassword);
            $data->Save();
            return view('mypage', [
                'sv'    => 'A jelszava megváltott'
            ]);
        } else {
            return view('newpass', [
                'sv'    => 'Nem sikerült megváltoztatni a jelszavát! :c'
            ]);
        }
    }

    public function Del(){
        if(Auth::check()){
            return view('/del');
        } else {
            return redirect('/login')->with('error', 'Elöbb jelentkezz be!');
        }
    }

    public function Exit(){
        if(Auth::check()){
            $data = User::find(Auth::user()->user_id);
            $data->delete;
            Auth::logout();
            return redirect('/')->with('success','Sikeresen törölted a fiókot');
        } else {
            return redirect('/login')->with('error', 'Elöbb jelentkezz be kérlek');
        }
    }
}
