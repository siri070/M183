
<section class="intro" >
    <div class="introBox">
        <div class="content">


            <?php
            $form = new Form($GLOBALS ['appurl']."/blog/addBlogEntry", null , $confirm);
            if(isset($text)){
                echo $form->textarea()->label('Titel')->name('Titel')->value($text['Titel']);
                echo $form->textarea()->label('Text')->name('Text')->value($text['Text']);
            }
            else{
                echo $form->textarea()->label('Titel')->name('Titel');
                echo $form->textarea()->label('Text')->name('Text');

            }
            echo $form->submit()->label('hinzufügen')->name('send');
            echo '</div>';
            echo '</form>';
            ?>
        </div>
    </div>
</section>