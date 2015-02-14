 <?php
 
class LogoutController extends BaseController {

    public function getLogout()

    {
		Session::flush();
		Auth::logout();
		
		return Redirect::to('connexion');
	}
}