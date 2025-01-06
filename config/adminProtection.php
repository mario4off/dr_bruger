<?php
// Bloquea el acceso a usuarios que no son admin
if ($_SESSION['role'] != 'admin') {
    header('Location: ?controller=product&action=index&error=not_allowed_admin');
}