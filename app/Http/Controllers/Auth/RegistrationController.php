<?php

namespace App\Http\Controllers\Auth;

use Mail;
use Session;
use Sentinel;
use Activation;
<<<<<<< HEAD
use File;
=======
Use Hash;
Use File;
>>>>>>> 5e921d0768af3b08b3eff85bda8a426f717d6553
use App\Http\Requests;
use Centaur\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\UserMap;


class RegistrationController extends Controller
{
    /** @var Centaur\AuthManager */
    protected $authManager;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(AuthManager $authManager)
    {
        $this->middleware('sentinel.guest');
        $this->authManager = $authManager;
    }

    /**
     * Show the registration form
     * @return View
     */
    public function getRegister()
    {
        return view('auth.register');
		
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Response|Redirect
     */
    protected function postRegister(Request $request)
    {
        // Validate the form data
        $result = $this->validate($request, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        // Assemble registration credentials
        $credentials = [
            'email' => trim($request->get('email')),
            'password' => $request->get('password'),
        ];

        // Attempt the registration
        $result = $this->authManager->register($credentials);

        if ($result->isFailure()) {
            return $result->dispatch();
        }

        // Set user role
        $role = Sentinel::findRoleBySlug('basic');
        $role->users()->attach($result->user->id);

        // Send the activation email
        $code = $result->activation->getCode();
        $email = $result->user->email;
        Mail::queue(
            'email.welcome',
            ['code' => $code, 'email' => $email],
            function ($message) use ($email) {
                $message->to($email)
                    ->subject('Your account has been created');
            }
        );
<<<<<<< HEAD

<<<<<<< HEAD
		//Create Root map for each user 
		
		$hashedMap('user_id') = substr(md5(uniqid(rand(),1)),0,32);
		
		$rootMaps = Storage::allDirectories($rootMaps);
=======
		//Hashirana mapa nakon registracije
		$hashed_map = sha1('$result->user->email');
        File::makeDirectory(base_path("storage/app/public/usermaps/$year-$hashed_map"), 0755, true, true);
		// return $user;
>>>>>>> 5e921d0768af3b08b3eff85bda8a426f717d6553
=======
		
		// Kreira root mapu za svakog korisnika prilikom registracije
		
		$hashedMap = Hash::make('$result->user->id');
<<<<<<< HEAD
		File::makeDirectory(base_path("storage/app/maps/users_$hashedMap"), 0755, true, true);
>>>>>>> 9819bb57b9d4bb1066aa92fb5ed07e57066f9499
=======
		
		File::makeDirectory(storage_path("app/maps/user_$hashedMap"), 0755, true, true);
		
		// Pospremi id korisnika i ime mape u bazu
		
		$map = new UserMap();
		
		$map->name = $hashedMap;
		$map->users_id = $result->user->id;
		
		$map->save();
>>>>>>> 245f13c89b8e127ca627762583daee5fa342de3e
		
        // Ask the user to check their email for the activation link
        $result->setMessage('Registration complete.  Please check your email for activation instructions.');

        // There is no need to send the payload data to the end user
        $result->clearPayload();

        // Return the appropriate response
        return $result->dispatch(route('auth.login.form'));
    }

    /**
     * Activate a user if they have provided the correct code
     * @param  string $code
     * @return Response|Redirect
     */
    public function getActivate(Request $request, $code)
    {
        // Attempt the registration
        $result = $this->authManager->activate($code);

        if ($result->isFailure()) {
            // Normally an exception would trigger a redirect()->back() However,
            // because they get here via direct link, back() will take them
            // to "/";  I would prefer they be sent to the login page.
            $result->setRedirectUrl(route('auth.login.form'));
            return $result->dispatch();
        }

        // Ask the user to check their email for the activation link
        $result->setMessage('Registration complete.  You may now log in.');

        // There is no need to send the payload data to the end user
        $result->clearPayload();

        // Return the appropriate response
        return $result->dispatch(route('auth.login.form'));
    }

    /**
     * Show the Resend Activation form
     * @return View
     */
    public function getResend()
    {
        return view('auth.resend');
    }

    /**
     * Handle a resend activation request
     * @return Response|Redirect
     */
    public function postResend(Request $request)
    {
        // Validate the form data
        $result = $this->validate($request, [
            'email' => 'required|email|max:255'
        ]);

        // Fetch the user in question
        $user = Sentinel::findUserByCredentials(['email' => $request->get('email')]);

        // Only send them an email if they have a valid, inactive account
        if (!Activation::completed($user)) {
            // Generate a new code
            $activation = Activation::create($user);

            // Send the email
            $code = $activation->getCode();
            $email = $user->email;
            Mail::queue(
                'email.welcome',
                ['code' => $code, 'email' => $email],
                function ($message) use ($email) {
                    $message->to($email)
                        ->subject('Account Activation Instructions');
                }
            );
        }

        $message = 'New instructions will be sent to that email address if it is associated with a inactive account.';

        if ($request->ajax()) {
            return response()->json(['message' => $message], 200);
        }

        Session::flash('success', $message);
        return redirect()->route('auth.login.form');
    }
}
