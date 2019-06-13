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
            $form = new Form($GLOBALS ['appurl']."/kommandos" , null, $confirm);
            if(isset($ergebnis)){
                echo $form->textarea()->label('Ergebnis')->name('ergebnis')->value($ergebnis);
            }
            echo '</form>';


            ?>
        </div>
    </div>
</section>
