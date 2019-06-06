<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 05.06.2019
 * Time: 15:23
 */
    require_once '../controller/LoginController.php';
    require_once '../repository/BlogRepository.php';
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
        if(isset($_POST['userdata']['email'])&&$_POST['userdata']['username'])
        {
            $view->text = $_POST['userdata'];
        }
        $view->display();
    }

    public function myBlogs(){

    }
    public function view_addBlogEntry(){
        $view = new View("blog_add");
        $view->title = "Blogeintrag hinzufügen";
        $view->confirm = "";
        $view->menuTitle = "Blog";
        $view->heading = "Blogeintrag hinzufügen";
        if(isset($_POST['userdata']['email'])&&$_POST['userdata']['username'])
        {
            $view->text = $_POST['userdata'];
        }
        $view->display();
    }
    public function addBlogEntry(){
        //ToDO überprüfung
        if(isset($_POST['send'])){

        }
    }

}