<?php

// Verifica que haya sesión activa y si no la inicia
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    unset($_SESSION['success']);
}

?>