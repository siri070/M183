<section class="intro" >
    <div class="introBox">
        <div class="content">


            <?php


            $form = new Form($GLOBALS ['appurl']."/login/register" , null, $confirm);

            echo $form->textarea()->label('User')->name('nickname');
            if(isset($text))
            {
                echo $form->email()->label('Mail')->name('email')->value($text['email']);
                echo $form->password()->label('Passwort')->name('passwort')->value($text['passwort']);
            }
            else{
                echo $form->email()->label('Mail')->name('email');
                echo $form->password()->label('Passwort')->name('passwort');
            }
            echo $form->password()->label('Passwort Wiederholen')->name('passwort2');
            echo $form->submit()->label('Registrieren')->name('send');
           echo '</div>';
            echo '</form>';

            ?>
        </div>
    </div>
</section>
