<form action="../helloworld/testform.php" method="POST">
    <h1>Inscription</h1>

    <label><b>Nom d'utilisateur</b></label>
    <input type="text" placeholder="Choisissez un nom d'utilisateur" name="username" required>

    <label><b>Email</b></label>
    <input type="email" placeholder="Choisissez votre email" name="email" required>

    <label><b>Mot de passe</b></label>
    <input type="password" placeholder="Entrer un mot de passe" name="password" required>

    <label><b>Photo de profil</b></label>
    <input type="file" name="profilepicture" id="pp" />

    <label><b>Nom d'affiche</b></label>
    <input type="password" placeholder="Entrer un nom d'affiche" name="postername" required>
    
    <input type="submit" id='submit' value='Inscription'>
</form>