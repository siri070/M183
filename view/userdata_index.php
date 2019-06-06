

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


            echo $form->labeltext()->label('Username')->value($textusername);
            echo $form->labeltext()->label('Email')->value($textemail);
            echo $form->labeltext()->label('Passwort')->value('*******');


            echo $form->end();
            ?>
        </div>
    </div>
</section>