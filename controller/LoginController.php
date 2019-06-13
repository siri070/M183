<?php
require_once '../repository/LoginRepository.php';
require_once '../controller/BlogController.php';
require_once '../controller/DefaultController.php';
require_once '../lib/Validation.php';
require_once '../lib/Functions.php';

/**
 * Controller für das Login und die Registration, siehe Dokumentation im DefaultController.
 */
class LoginController
{
    /**
     * Default-Seite für das Login: Zeigt das Login-Formular an
     * Dispatcher: /login
     */


    public function index()
    {
        $view = new View("login_index");
        $view->title = "Login";
        $view->confirm = "";
        $view->menuTitle = "Modul 183";
        $view->heading = "Login";
        if(isset($_POST['userdata']['email'])&&$_POST['userdata']['username'])
        {
            $view->text = $_POST['userdata'];
        }
        $view->display();
    }

    public function areFieldsNotEmptyWhileRegistration()
    {
        if(!isset($_POST['username'])||
            !isset($_POST['email'])||
            !isset($_POST['passwort1'])||
            !isset($_POST['passwort2'])||
            empty(($_POST['passwort2'])||
                empty($_POST['passwort1']))||
            empty($_POST['email'])||
            empty($_POST['username'])){
            return false;
        }
        else{

            return true;
        }

    }

    public function isPasswordCorrect($passwort, $user)
    {
        $passwort = htmlspecialchars($passwort);



        if(password_verify($passwort, $user->passwort))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function comparePasswords($password1, $password2)
    {
        /**
         * Die beiden Passwörter werden auf Gleichheit geprüft. Sind sie nicht gleich, wird eine Fehlermeldung ausgegeben
         * Sind sie Gleich wird der Validierungsprozess fortgesetzt
         */
        if($password1 === $password2)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function login()
    {
        if ($_POST ['send']) {
            //Kontrolle ob der Benutzer etwas eingegeben hat

            if (isset($_POST['nickname'])) {
                $_POST['userdata']['nickname'] = htmlspecialchars($_POST['nickname']) ;
            } else {
                $_SESSION['errors']="Geben sie ihren Nickname ein.";
            }
            if (isset($_POST['passwort'])) {

                $_POST['userdata']['passwort'] = htmlspecialchars($_POST['passwort']) ;
            } else {
                $_SESSION['errors']="Geben sie ihr Passwort ein.";
            }
            $loginRepository = new LoginRepository();
            //holen der Userdaten aus der DB
            $user = $loginRepository->getUser($_POST['userdata']['nickname']);
            if(isset($user))
            {
                $this->checkIsUserInputCorrect($user);
            }
            else{
                $_SESSION['errors'] = "Sie können sich hier registrieren";
                $errorhandling = new Functions();
                $errorhandling->displayErrors($_SESSION['errors'], "/login/registration", $_POST['userdata']) ;
                return;
            }
            if(isset($_SESSION['errors']))
            {
                $errorhandling = new Functions();
                $errorhandling->displayErrors($_SESSION['errors'], "/login/index", $_POST['userdata']) ;
            }
        }
    }


    private function checkIsUserInputCorrect($user)
    {
        //Überprüfung ob das richtige Passwort eingegeben wurde
        if (!(password_verify($_POST['userdata']['passwort'], $user->passwort))) {
            $_SESSION['errors']="Sie haben das falsche Passwort eingegeben.";
            $functions= new Functions();
            $InfoLog= "\n Login-Error \n   User: ".$user->nickname."\n   Id:".$user->id."\n Datum & Uhrzeit:".$functions->dateAndTime();
            file_put_contents("../lib/log.txt",$InfoLog,FILE_APPEND);
        }
        else
        {
            $this->loginWithCorrectUserData($user);
        }
    }

    private function loginWithCorrectUserData($user)
    {
        unset($_SESSION['errors']);
        $_SESSION['uid'] = htmlspecialchars($user->id);
        $_SESSION['user']= htmlspecialchars($user->nickname);
        $functions= new Functions();
        $InfoLog= "\nLogin \n   User: ".$user->nickname." \n   Id:".$user->id."\n   Datum & Uhrzeit:".$functions->dateAndTime();
        file_put_contents("../lib/log.txt",$InfoLog,FILE_APPEND);
        header("Location: ".$GLOBALS['appurl'].'/blog');
    }

    //damit sich der User ausloggen kann
    public function logout()
    {   $functions= new Functions();
        $InfoLog= "\nLogout \n   User: ".$_POST['userdata']['nickname']."\n   Id:".$_SESSION['uid']."\n   Datum & Uhrzeit:".$functions->dateAndTime();
        file_put_contents("../lib/log.txt",$InfoLog,FILE_APPEND);
        session_unset();
        session_destroy();
        header("Location:".$GLOBALS['appurl']);
    }


    /**
     * Zeigt das Registrations-Formular an
     * Dispatcher: /login/registration
     */
    public function registration()
    {
            $view = new View("login_registration");
        $view->confirm = "";
            $view->title = "Registration";
            $view->menuTitle = "Modul 183";
            $view->heading = "Registration";
            if(isset($_POST['userdata']['email'])&&$_POST['userdata']['username'])
            {
                $text = $_POST['userdata'];
                $view->text = $text;
            }
            $view->display();
    }

    /**
     * Legt einen neuen Benutzer an
     * Dispatcher: /login/register
     */
    public function register()
    {
        $validation = new Validation();
        if ($_POST ['send']) {

            //Holen der Benutzereingabe und Validation
            $_POST['userdata']['nickname']=htmlspecialchars($_POST['nickname']);
            $nickname = htmlspecialchars($_POST['nickname']);
            $nicknameOK = $validation->stringLenght(3, 25, $nickname);

            $_POST['userdata']['email']=htmlspecialchars($_POST['email']);
            $email = htmlspecialchars($_POST['email']);
            $emailOK = $validation->email($email);

            $_POST['userdata']['passwort']=htmlspecialchars($_POST['passwort']);
            $passwort = htmlspecialchars($_POST['passwort']);
            $_POST['userdata']['passwort2']=htmlspecialchars($_POST['passwort2']);
            $passwortOK = $validation->stringLenght(8, 25, $passwort);
            $passwordOKAndValid =$validation->validatePassword($_POST['userdata']['passwort']);
            $passwort2 = htmlspecialchars($_POST['passwort2']);

            $loginRepository = new LoginRepository();

            $nicknameDuplicate = $this->isNicknameADublicate();
            $emailDuplicate = $this->isEmailADublicate();

            //Überprüfung ob das Passwort zweimal gleich eingegeben wurde und ob die Validation fehlerfrei durchgelaufen ist.
            if ($_POST['userdata']['passwort'] === $_POST['userdata']['passwort2'] && $emailOK && $passwortOK && $nicknameOK && !$nicknameDuplicate && !$emailDuplicate && $passwordOKAndValid) {

                $loginRepository->create($nickname, $email, $passwort);
                unset($_SESSION['errors']);
                $functions= new Functions();
                $InfoLog= "\nRegistration \n   User:".$nickname."\n   E-Mail:".$email."\n   Datum & Uhrzeit:".$functions->dateAndTime();
                file_put_contents("../lib/log.txt",$InfoLog,FILE_APPEND);
                //Weiterleitung zum Login wenn alles funktioniert hat
                $this->index();

            } else {
                if ($nicknameDuplicate) {

                    $_SESSION['errors']= "Username nicht verfügbar, bitte wählen sie einen anderen Usernamen";
                }
                if (!$nicknameOK) {

                    $_SESSION['errors']= "Username muss mindestens 3 Zeichen und maximal 25 Zeichen lang sein";
                }
                if ($emailDuplicate) {

                    $_SESSION['errors']= "Email schon vorhanden. Registrieren Sie sich mit einer Email die noch nicht registriert wurde";
                }
                if (!$emailOK) {

                    $_SESSION['errors']= "Geben Sie eine gültige Email-Adresse ein.";
                }
                if (!$passwortOK) {

                    $_SESSION['errors']= "Geben Sie ein gültiges Passwort ein, min. 8 Zeichen und max. 25 Zeichen";
                }
                if (!$passwort === $passwort2) {

                    $_SESSION['errors']= "Geben Sie die Passwörter identisch ein.";
                }

            }
            if(isset($_SESSION['errors']))
            {
                $errorhandling = new Functions();
                $_POST['userdata']['nickname'] = $nickname;
                $_POST['userdata']['email'] = $email;
                $functions= new Functions();
                $InfoLog= "\nRegistrations-Error \n   E-Mail:".$_POST['userdata']['email']."\n   Datum & Uhrzeit:".$functions->dateAndTime();
                file_put_contents("../lib/log.txt",$InfoLog,FILE_APPEND);
                $errorhandling->displayErrors($_SESSION['errors'], "/login/registration", $_POST['userdata']) ;
            }
        }
    }
    /** überprüfung ob es diesen Nickname/Username schon gibt */
    public function isNicknameADublicate()
    {
        $loginRepository = new LoginRepository();
        $answer = $loginRepository->countUserByNickname($_POST['userdata']['nickname']);
        if($answer->total==null || $answer->total==0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    /** überprüfung ob es diese Email schon gibt */
    public function isEmailADublicate()
    {
        $loginRepository = new LoginRepository();
        $answer = $loginRepository->countUserByEmail($_POST['userdata']['email']);
        if($answer->total==null || $answer->total==0)
        {
            return false;
        }
        else
        {
            return true;
        }


    }



}
