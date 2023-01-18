<?php
echo("<form class='signup' method='post' action='#'>
        <label>eMail :</label>
        <input type='email' id='id' name='id' placeholder='eMail' required><br>
        <label>Pseudo :</label>
        <input type='text' id='name' name='name' placeholder='Pseudo' required><br>
        <label>Mot de Passe :</label>
        <input type='password' id='password' name='password' placeholder='Mot de Passe' required><br>
        <label>Photo de profile :</label>
        <input type='file' id='picture' name='picture' value='Photo' required><br>
        <input type='hidden' id='first_login' name='first_login' value=".date('Y-m-d',time()).">
        <input type='hidden' id='last_login' name='last_login' value=". date('Y-m-d',time()) .">
        <input type='submit' value='Submit'>
    </form>");