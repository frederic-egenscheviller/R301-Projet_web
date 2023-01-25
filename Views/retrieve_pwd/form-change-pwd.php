<?php
echo("<form class='sigin' method='post' action='/retrievepwd/update'>
        <label><b>Token reçu</b></label>
        <input type='text' placeholder='Token' name='token' required><br>

        <label><b>Votre mail</b></label>
        <input type='text' placeholder='Mail' name='id' required>

        <label><b>Nouveau mot de passe</b></label>
        <input type='password' placeholder='Nouveau mot de passe' name='password' required>
        
        <label><b>Confirmer le nouveau mot de passe</b></label>
        <input type='password' placeholder='Confirmer mot de passe' name='password_confirmation' required>
        
        <input type='submit' id='submit' value='Valider' >

    </form>");