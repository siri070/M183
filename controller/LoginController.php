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
        $view->menuTitle = "Bilder-DB";
        $view->heading = "Login";
        if(isset($_POST['userdata']['email'])&&$_POST['userdata']['username'])
        {
            $view->text = $_POST['userdata'];
        }
        $view->display();
    }

    public function userdata()
    {
        $loginRepository = new LoginRepository();
        $view = new View("userdata_index");
        $user= $loginRepository->readById($_SESSION['uid']);
        $view->confirm = "";
        $view->title = "Deine Übersicht";
        $view->menuTitle = "Bilder-DB";
        $view->heading ="Übersicht über deine Daten";

        $view->textusername = $user->nickname;;
        $view->textemail = $user->mailAdresse;


        $view->class = "disabled";
        $view->display();
    }

    public function changeUserdataView()
    {
        $loginRepository = new LoginRepository();
        $view = new View("userdata_update");
        $user= $loginRepository->readById($_SESSION['uid']);
        $view->confirm = "";
        $view->confirmdel = "onsubmit=\"return confirm('Willst du dein ganzes Profil mit allen Daten löschen? Dieser Vorgang kann nicht rückgängig gemacht werden!')\"";
        if(isset($_POST['userdata']['username']) && $_POST['userdata']['username']!=="" && htmlspecialchars($_POST['userdata']['username']) === $user->nickname)
        {
            $view->textusername = htmlspecialchars($_POST['userdata']['username']);
        }
        else
        {
            $view->textusername = $user->nickname;
        }
        if(isset($_POST['userdata']['email']) && $_POST['userdata']['email']!=="" && $_POST['userdata']['email'] === $user->mailAdresse)
        {
            $view->textemail = htmlspecialchars($_POST['userdata']['email']);
        }
        else
        {
            $view->textemail = $user->mailAdresse;
        }
        $view->userid = $user->id;
        $view->title = "Einstellungen ändern";
        $view->menuTitle = "Bilder-DB";
        $view->heading ="Persönliche Daten ändern";

        $view->textemail = $user->mailAdresse;

        $view->display();
    }


    public function validateUserInputByUpdate($user)
    {


        if(isset($_POST['send']))
        {
            if(!isset($_POST['username'])||!isset($_POST['email'])||!isset($_POST['activePasswort'])||!isset($_POST['passwort1'])||!isset($_POST['passwort2']))
            {

                $_SESSION['errors']="Es müssen alle Felder ausgefüllt werden.";
                return false;
            }
            else if(!$this->isPasswordCorrect($_POST['activePasswort'], $user) )
            {
                $_SESSION['errors']="Aktuelles Passwort nicht korrekt";

                return false;
            }
            else if(!$this->comparePasswords(htmlspecialchars($_POST['passwort1']), htmlspecialchars($_POST['passwort2'])))
            {
                $_SESSION['errors']="Das neue Passwort und das Bestätigungspasswort stimmen nicht überien.";
                return false;
            }
            else
            {

                return true;

            }
        }
        else{
            $_SESSION['errors']="Keine Berechtigung diese Methode aufzurufen.";
            return false;
        }
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
//Methode um die Profilangaben die der User gerne ändern möchte zu validieren und zu speichern.
    public function saveUpdatedUserdata()
    {
        $loginrepository = new LoginRepository();
        $user = $loginrepository->readById(($_SESSION['uid']));
        if(isset($_POST['makeVisibe']))
        {
            if($user->IsUserVisible === 0)
            {
                /**Ist der User nicht sichtbar, soll die Einstellung auf sichtbar gestellt werden.
                 * @function makeUserVisible @param Sichtbarkeit und UserID
                 **/
                $loginrepository->makeUserVisible(1, $user->id);
                //Die neuen userdaten werden geholt.
                $user = $loginrepository->readById(($user->id));
                /**
                 * Die Einstellungen werden überprüft
                 */
                if($user->IsUserVisible === 1)
                {
                    //Sichtbar machen hat geklappt
                    $_SESSION['accompolishment']="Änderung von Sichtbarkeit für andere User auf SICHTBAR hat geklappt";
                    $this->changeUserdataView();
                }//Sichtbar machen hat Nicht geklappt
                else if($user->IsUserVisible === 0){
                    $_SESSION['errors']="Änderung von Sichtbarkeit für andere User auf SICHTBAR hat NICHT geklappt";
                    $this->changeUserdataView();
                }
                else
                {
                    $_SESSION['errors']="Es hat einen unbekannten Fehler gegeben. Bitte setzen sie sich mit dem Webhoster in Verbindeung";
                    $this->userdata();
                }
            }
            /**Ist der User gemäss seinen Einstellungen sichtbar, soll die Einstellung auf NICHT SICHTBAR gestellt werden.
             * @function makeUserVisible @param Sichtbarkeit und UserID
             **/
            else if($user->IsUserVisible === 1){
                $loginrepository->makeUserVisible(0, $user->id);
                $user = $loginrepository->readById(($user->id));
                /**
                 * Die Einstellungen werden nochmals überprüft
                 */
                if($user->IsUserVisible === 0)
                {
                    $_SESSION['accompolishment']="Änderung von Sichtbarkeit für andere User auf NICHT sichtbar hat geklappt";
                    $this->changeUserdataView();

                }
                else if($user->IsUserVisible === 1){
                    $_SESSION['errors']="Änderung von Sichtbarkeit für andere User auf nicht sichtbar hat NICHT geklappt";
                    $this->changeUserdataView();

                }
                else
                {
                    $_SESSION['errors']="Es hat einen unbekannten Fehler gegeben. Bitte setzen sie sich mit dem Webhoster in Verbindeung";
                    $this->userdata();

                }
            }
        }
        else if(isset($_POST['send']))
        {
            /**
             * Userinput wird geprüft
             */

            if($this->validateUserInputByUpdate($user))
            {
                $password = htmlspecialchars($_POST['passwort1']);
                $username = htmlspecialchars($_POST['username']);
                $email = htmlspecialchars($_POST['email']);
                $loginrepository->updateUserData($username, $email,$password, (int)$user->id);
               $updatedUser = $loginrepository->getUser($email);
                if(!($updatedUser->mailAdresse == $email))
                {
                    $_SESSION['errors']="Beim Speichern der Email hat es einen Fehler gegeben.";
                    $this->changeUserdataView();
                }
                else if(!$updatedUser->nickname == $username)
                {
                    $_SESSION['errors']="Beim Speichern des Usernamens hat es einen Fehler gegeben.";
                    $this->changeUserdataView();
                }
                else if($this->isPasswordCorrect($updatedUser->passwort, $updatedUser))
                {
                    $_SESSION['errors']="Beim Speichern des Passwortes hat es einen Fehler gegeben.";
                    $this->changeUserdataView();
                }
                else
                {
                    $_SESSION['accompolishment']="Update erfolgreich!";
                    $this->changeUserdataView();
                }
            }
            else{

                $password = htmlspecialchars($_POST['passwort1']);
                $username = htmlspecialchars($_POST['username']);
                $email = htmlspecialchars($_POST['email']);
               header("Location: ".$GLOBALS['appurl']."/login/userdata");
            }
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

        header("Location: ".$GLOBALS['appurl'].'/blog');
    }

    //damit sich der User ausloggen kann
    public function logout()
    {
        session_unset();
        session_destroy();
        $galerie = new DefaultController();
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
            $view->menuTitle = "Bilderdatenbak";
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
            $isNotEmpty =$this->areFieldsNotEmptyWhileRegistration();
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

                $this->createUserProfile($loginRepository, $nickname, $email, $passwort);
                unset($_SESSION['errors']);
                //Weiterleitung zum Login wenn alles funktioniert hat
                if(!empty($loginRepository->getUser($email)))
                {
                    $_SESSION['accompolishment']="Retistrierung erfolgreich";
                    $loginController = new LoginController();
                    $loginController->index();
                }
            } else {
                if ($nicknameDuplicate) {

                    $_SESSION['errors']= "Username nicht verfügbar, bitte wählen sie einen anderen Usernamen";
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
                $errorhandling->displayErrors($_SESSION['errors'], "/login/registration", $_POST['userdata']) ;
            }
        }
    }


    private function createUserProfile($loginRepository, $nickname, $email, $passwort)
    {
        $loginRepository->create($nickname, $email, $passwort);
        $user= $loginRepository->getUser($email);
        $pathname ="../public/AllUser/".$user->id."/";
        mkdir($pathname,0777,true  );
    }


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
