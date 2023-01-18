<?php
echo("<form method='post' action='#'>
        <label>Note</label>
        <input type='int' id='rating' name='rating' max='5' min='0' required><br/>
        <label>Commentaire :</label><br/>
        <textarea name='comment' id='comment' rows='5' cols='80' placeholder='Commentaire' aria-required='true' style='min-height: 5%;height: 5%; width: 15%;'></textarea><br/>
        <input type='hidden' id='appreciation_date' name='appreciation_date' value=". date('Y-m-d',time()) ."><br/>
        <input type='hidden' id='appreciation_date' name='appreciation_date' value=". date('Y-m-d',time()) .">
        <input type='hidden' id='recipe_id' name='recipe_id' value=". $_SESSION['recipe_id']." required>
        <input type='hidden' id='user_id' name='user_id' value=". $_SESSION['user_id']." required>
        <input type='submit' value='Submit'>
    </form>");