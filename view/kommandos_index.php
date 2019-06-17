<section class="intro" >
    <div class="introBox">
        <div class="content">
            <h4>Mögliche kommandos</h4>
            <p>whoami</p>
            <p>path</p>

            <p>Geben sie kommando=[das gewünschte kommando] nach dem ? ein.</p>

            <?php
            /**
             * Created by PhpStorm.
             * User: bburki
             * Date: 18.04.2018
             * Time: 09:22
             */
            $form = new Form($GLOBALS ['appurl']."/kommandos" , null, $confirm);
            if(isset($ergebnis)){
                echo "<Label  class=\"control-label\" for=\"textinput\">Ergebnis</Label>";

                echo "<p>$ergebnis</p>";

            }
            echo '</form>';


            ?>
        </div>
    </div>
</section>
