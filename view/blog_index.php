<section class="intro" >
    <div class="introBox">
        <div class="content">


            <?php
            /**
             * Created by PhpStorm.
             * User: bburki
             * Date: 18.04.2018
             * Time: 09:22
             */

            $form = new Form($GLOBALS ['appurl']."/blog/view_addBlogEntry" , null, $confirm);

            echo $form->submit()->label('Neuer Blogeintrags')->name('send');
            if (empty($allBlogEntries)){
                echo '<h4 class="item title" > Sie haben noch keine Blogeinträge</h4>';
            }
            else{
                echo '<div class="wholeGallery">';
                foreach ($allBlogEntries as $blogEntry ){
                    echo '<h4 class="item title">'.$blogEntry->title.' </h4>';
                    echo '<p class="item text-info">'.$blogEntry->text.' </p>';
                }
                echo'</div>';

            }

           echo '</div>';
            echo '</form>';

            ?>
        </div>
    </div>
</section>
