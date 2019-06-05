
<section class="intro" >
    <div class="introBox">
        <div class="content">


            <?php
            $form = new Form($GLOBALS ['appurl']."/blog/addBlogEntry", null , $confirm);
            echo $form->textarea()->label('Titel')->name('Titel');
            echo $form->textarea()->label('Text')->name('Text');
            echo $form->submit()->label('hinzufügen')->name('send');
            echo '</div>';
            echo '</form>';
            ?>
        </div>
    </div>
</section>