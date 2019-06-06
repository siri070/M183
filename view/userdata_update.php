
<section class="intro" >
    <div class="introBox">
        <div class="content">


            <?php

            $makeVisible = new Form($GLOBALS['appurl']."/login/saveUpdatedUserdata", null ,$confirm);

            $_POST['userdata']['username'] = $textusername;
            $_POST['userdata']['email'] = $textemail;

            echo '</div>';
            echo '</form>';

            $form = new Form($GLOBALS ['appurl']."/login/saveUpdatedUserdata", null , $confirm );

            echo $form->textarea()->label('Username')->name('username')->value($textusername);
            echo $form->email()->label('Email')->name('email')->value($textemail);
            echo $form->password()->label('Aktuelles Passwort')->name('activePasswort')->value('');
            echo $form->password()->label('Passwort')->name('passwort1')->value('');
            echo $form->password()->label('Passwort bestätigen')->name('passwort2')->value('');
            echo $form->submit()->label('Neue Daten speichern')->name('send');

            echo '</div>';
            echo '</form>';

            echo '</div>';
            echo '</form>';
            ?>
        </div>
    </div>
</section>