
<section class="intro" >
    <div class="introBox">
        <div class="content">


            <?php

            $makeVisible = new Form($GLOBALS['appurl']."/login/saveUpdatedUserdata", null ,$confirm);
            if($textvisibility == 0)
            {
                echo '<label>Für andere User sichtbar machen:</label>';
                $label = "Sichtbar machen";
            }
            else if ($textvisibility == 1)
            {
                echo '<label>Für andere User ausblenden:</label>';
                $label = "Verstecken";
            }
            else
            {
                $label= "Keine Ahnung";
            }
            $_POST['userdata']['username'] = $textusername;
            $_POST['userdata']['email'] = $textemail;
            echo $makeVisible->submit()->label($label)->name('makeVisibe');
            echo '</div>';
            echo '</form>';
            echo '<h6>(Bist du für andere User nicht sichtbar, kannst du im Gegenzug auch nicht nach anderen Usern suchen) </h6>';

            $form = new Form($GLOBALS ['appurl']."/login/saveUpdatedUserdata", null , $confirm );

            echo $form->textarea()->label('Username')->name('username')->value($textusername);
            echo $form->email()->label('Email')->name('email')->value($textemail);
            echo $form->password()->label('Aktuelles Passwort')->name('activePasswort')->value('');
            echo $form->password()->label('Passwort')->name('passwort1')->value('');
            echo $form->password()->label('Passwort bestätigen')->name('passwort2')->value('');
            echo $form->submit()->label('Neue Daten speichern')->name('send');

            echo '</div>';
            echo '</form>';

            $delete = new Form($GLOBALS ['appurl']."/login/delete/index?uid=".$userid, null, $confirmdel);
            echo $delete->submit()->label('Ganzes Profil löschen')->name('delete');
            echo '<h6 class="text-danger">(Achtung: Löschen kann nicht rückgängig gemacht werden und löscht deine Bilder sowie dein Profil unwiederruflich!) </h6>';
            echo '</div>';
            echo '</form>';
            ?>
        </div>
    </div>
</section>