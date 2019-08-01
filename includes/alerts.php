<?php
if ( isset($_GET['login']) && $_GET['login'] == 1 ) { ?>
<div class="alerts">
  <div class="alert success">
    <i class="alert-icon fas fa-check-circle"></i>
    <div class="alert-text">Connexion réussi !</div>
  </div>
</div>
  <?php } elseif ( isset($_GET['success']) && $_GET['success'] == 1 ) { ?>
<div class="alerts">
  <div class="alert success">
    <i class="alert-icon fas fa-check-circle"></i>
    <div class="alert-text">Proposition bien modifié !</div>
  </div>
</div>
<?php
    } elseif ( isset($_GET['success']) && $_GET['success'] == 2 ) { ?>
<div class="alerts">
  <div class="alert success">
    <i class="alert-icon fas fa-check-circle"></i>
    <div class="alert-text">Proposition bien crée !</div>
  </div>
</div>
<?php
    }
?>

<!-- <?php
if ( isset($_GET['warning']) && $_GET['warning'] == 1 ) { ?>
<div class="alerts">
  <div class="alert warning">
    <i class="alert-icon fas fa-exclamation-circle"></i>
    <div class="alert-text">Proposition bien supprimée !</div>
  </div>
</div>
<?php
    }
?> -->

<!-- <?php
if ( isset($_GET['error']) && $_GET['error'] == 1 ) { ?>
<div class="alerts">
  <div class="alert error">
    <i class="alert-icon fas fa-exclamation-triangle"></i>
    <div class="alert-text">This an error message</div>
  </div>
</div>
<?php
    }
?>

<?php
if ( isset($_GET['info']) && $_GET['info'] == 1 ) { ?>
<div class="alerts">
  <div class="alert info">
    <i class="alert-icon fas fa-exclamation-circle"></i>
    <div class="alert-text">This an info message</div>
  </div>
</div>
<?php
    }
?> -->