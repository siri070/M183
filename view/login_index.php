
<section class="intro" >
    <div class="introBox">
        <div class="content">


            <?php
            $form = new Form($GLOBALS ['appurl']."/login/login", null , $confirm);
            echo $form->textarea()->label('User')->name('nickname');
            echo $form->password()->label('Passwort')->name('passwort');
            echo $form->submit()->label('Login')->name('send');
            echo '</div>';
            echo '</form>';
            ?>
        </div>
    </div>
</section>
