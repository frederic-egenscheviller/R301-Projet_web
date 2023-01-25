<?php
echo("<form class='sigin' method='post' action='/admin/delete'>

        <label><b>Entrez l'adresse mail de l'utilisateur à supprimer</b></label>
        <input type='text' placeholder='Adresse mail' name='id' required><br>
        
        <input type='submit' id='submit' value='Supprimer' >

    </form>");

echo("<form class='sigin' method='post' action='/admin/add'>

        <label><b>Entrez l'adresse mail de l'utilisateur pour l'ajouter à la liste des admins</b></label>
        <input type='text' placeholder='Adresse mail' name='id' required><br>
        
        <input type='submit' id='submit' value='Ajouter' >

    </form>");