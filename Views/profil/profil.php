<?php

echo "<section class='profile'>
        <h1 class='profile-title'>Votre profil</h1><br/>
        <section class='profile-content'>
          <img class='profile-picture' src='" . $A_view['picture'] . "' alt='image profil'><br/>
          <div class='profile-info'>
            <label> Email : <b>" . $A_view['id'] . "</b></label><br/>
            <label> Pseudonyme : <b>" . $A_view['name'] . "</b></label>
          </div>
        </section>
      </section>
      ";