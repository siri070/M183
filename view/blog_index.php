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
           echo '</div>';
            echo '</form>';

            ?>
        </div>
    </div>
</section>
