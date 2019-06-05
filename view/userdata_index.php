

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

            $form = new Form($GLOBALS ['appurl']."/login/changeUserdataView", null, $confirm );
            echo $form->submit()->label('Meine Einstellungen bearbeiten')->name('send');
            echo $form->labeltext()->label('Username')->value($textusername);
            echo $form->labeltext()->label('Email')->value($textemail);
            echo $form->labeltext()->label('Passwort')->value('*******');
            $makeVisible = new Form($GLOBALS['appurl']."/galleries/makeVisible", null, $confirm);
            echo '<label>Dein Profil ist für andere User momentan '.$sichtbarkeit.'</label>';
            echo $form->end();
            ?>
        </div>
    </div>
</section>