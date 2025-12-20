<?php
$targetFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage/app/public';
$linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/public/storage';

// Vérification de l'existence des répertoires
if (!file_exists($targetFolder)) {
    echo "Le dossier source n'existe pas: $targetFolder";
    exit;
}

if (!file_exists($linkFolder)) {
    echo "Le dossier de lien symbolique n'existe pas: $linkFolder";
    exit;
}

// Tenter de créer le symlink
if (!symlink($targetFolder, $linkFolder)) {
    echo "Erreur lors de la création du symlink: " . error_get_last()['message'];
} else {
    echo 'Symlink process successfully completed';
}
?>
