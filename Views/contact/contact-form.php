<?php
echo("<form class='sigin' method='post' action='/contact/update'>
        <title>Comment pouvons nous vous aider?</title>
        
        <label><b>Votre Nom :</b></label>
        <input type='text' placeholder='Nom' name='name' required><br>

        <label><b>Votre Prenom :</b></label>
        <input type='text' placeholder='Prenom' name='surname' required>

        <label><b>Votre Mail :</b></label>
        <input type='text' placeholder='Mail' name='mail' required>
        
        <label><b>Sujet :</b></label>
        <input type='text' placeholder='Le sujet concernant la raison de votre contact' name='subject' required>
        
        <label><b>Vos remarques :</b></label>
        <input type='text' placeholder='Vos remarques' name='body' required>
        
        <input type='submit' id='submit' value='Envoyer' >

    </form>");