<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 05.06.2019
 * Time: 15:23
 */
    require_once '../controller/LoginController.php';
    require_once '../repository/BlogRepository.php';
    require_once '../lib/Validation.php';
    require_once '../lib/Functions.php';
class BlogController
{
    public function index()
    {
        $blogRepository= new BlogRepository();
        $view = new View("blog_index");
        $view->title = "Blog";
        $view->confirm = "";
        $view->menuTitle = "Blog";
        $view->heading = "Blog";
        $view->allBlogEntries= $blogRepository->getBlogByUID($_SESSION['uid']);
        $view->display();
    }

    public function view_addBlogEntry(){
        $view = new View("blog_add");
        $view->title = "Blogeintrag hinzufügen";
        $view->confirm = "";
        $view->menuTitle = "Blog";
        $view->heading = "Blogeintrag hinzufügen";
        if(isset($_POST['blog']['Titel'])&&$_POST['blog']['Text'])
        {
            $view->text = $_POST['blog'];
        }
        $view->display();
    }
    public function addBlogEntry(){
        //ToDO überprüfung
        $validation = new Validation();
        $blogRepository = new BlogRepository();
        if(isset($_POST['send'])){
            $titel= htmlspecialchars($_POST['Titel']);
            $isBlogTitelOk= $validation->stringLenght(3,50,$titel);
           $text = htmlspecialchars($_POST['Text']);
            $isBlogTextOk= $validation->stringLenght(3,500,$text);

            if($isBlogTitelOk && $isBlogTextOk){
              $blogRepository->createBlogEntry($titel,$text,$_SESSION['uid']);
                $functions= new Functions();
                $InfoLog= "\nBlog-hinzugefügt \n   User-Id:".$_SESSION['uid']."\n   Titel:".$_POST['blog']['Titel']."\n   Datum & Uhrzeit:".$functions->dateAndTime();
                file_put_contents("../lib/log.txt",$InfoLog,FILE_APPEND);
              $this->index();
            }
            elseif(!$isBlogTitelOk){
                $_SESSION['errors']="Geben Sie einen Titel ein, der mindestens 3 und maximal 50 Zeichen hat.";
            }
            elseif (!$isBlogTextOk){
                $_SESSION['errors']="Geben Sie einen Text ein, der mindestens 3 und maximal 500 Zeichen hat.";
            }

            if(isset($_SESSION['errors']))
            {
                $errorhandling = new Functions();
                $errorhandling->displayErrors($_SESSION['errors'], "/blog/view_addBlogEntry") ;
            }

        }
    }

}