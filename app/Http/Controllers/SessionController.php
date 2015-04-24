<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Hybrid_Endpoint;
use Hybrid_Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller {

    public function endpoint()
    {
        Hybrid_Endpoint::process();
    }

    public function facebook()
    {
        try {
            $this->app->configure('hybrid');
            $hybrid_config = $this->app['config']->get('hybrid');

            $hybridauth = new Hybrid_Auth($hybrid_config);

            $adapter = $hybridauth->authenticate( "Facebook" );

            $user_profile = $adapter->getUserProfile();

            if (empty( $user_profile )) {
                return redirect( 'login/error' );
            }

            $identifier = $user_profile->identifier;

            Hybrid_Auth::storage()->set('user', $identifier);
        }
        catch( Exception $e ){
            switch( $e->getCode() ){
                case 0 : \Session::flash('error', 'Unspecified error.  Code '. $e->getCode());  break;
                case 1 : \Session::flash('error', 'Hybridauth configuration error.  Code '. $e->getCode()); break;
                case 2 : \Session::flash('error', 'Provider not properly configured. Code '. $e->getCode()) ; break;
                case 3 : \Session::flash('error', 'Unknown or disabled provider. Code '. $e->getCode()) ; break;
                case 4 : \Session::flash('error', 'Missing provider application credentials. Code '. $e->getCode()); break;
                case 5 : \Session::flash('error', 'Authentification failed.
                    The user has canceled the authentication or the provider refused the connection.  Code'. $e->getCode()) ;
                    break;
                case 6 : \Session::flash('error', 'User profile request failed. Most likely the user is not connected.
                to the provider and he should authenticate again.  Code '. $e->getCode());
                    $hybridauth->logoutAllProviders();
                    break;
                case 7 : \Session::flash('error', 'User not connected to the provider.  Code '. $e->getCode());
                    $hybridauth->logoutAllProviders();
                    break;
                case 8 : \Session::flash('error', 'Provider does not support this feature.  Code '. $e->getCode()); break;
            }


            \Session::flash('error', '<br /><br /><b>Original error message:</b> '. $e->getMessage());

            return redirect( 'login/error' );
        }

        $user = DB::table('users')->where('identifier', $user_profile->identifier)->first();

        if( ! $user ) {
            $id = DB::table('users')->insertGetId(
                [
                    'identifier' => $user_profile->identifier,
                    'email' => $user_profile->email,
                    'first_name' => $user_profile->firstName,
                    'last_name' => $user_profile->lastName,
                    'avatar_url' => $user_profile->photoURL
                ]
            );
        }

        Session::put('identifier_id', $identifier);

        return redirect()->route('home', ['identifier_id' => $identifier]);
    }

    public function logout()
    {
        $this->app->configure('hybrid');
        $hybrid_config = $this->app['config']->get('hybrid');

        $hybridauth = new Hybrid_Auth($hybrid_config);
        Hybrid_Auth::logoutAllProviders();
        Hybrid_Auth::storage()->set( 'user', null );
        Session::put('identifier_id', null);
        return redirect('/');
    }

    public function error()
    {
        return 'Error';
    }
}