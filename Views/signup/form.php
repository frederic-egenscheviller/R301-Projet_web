<?php
echo("<form class='signup' method='post' action='/signup/update' enctype='multipart/form-data'>
        <label>eMail :</label>
        <input type='email' id='id' name='id' placeholder='eMail' required><br>
        <label>Pseudo :</label>
        <input type='text' id='name' name='name' placeholder='Pseudo' required><br>
        <label>Mot de Passe :</label>
        <input type='password' id='password' name='password' placeholder='Mot de Passe' minlength='12' required><br>
        <label>Photo de profil :</label>
        <input type='file' id='file' name='picture' required><br>
        <input type='hidden' id='first_login' name='first_login' value='".date('Y-m-d',time())."'>
        <input type='hidden' id='last_login' name='last_login' value='". date('Y-m-d',time()) ."'>
        <label>J'accepte les conditions d'utilisation</label>
        <input type='checkbox' required>
        <a href='/termsofuses'>Voir les conditions d'utilisations</a>
        <input type='submit' id='submit' value='Inscription'>
        <label><a href='/signin'><b>Se connecter</b></a></label>
    </form>");