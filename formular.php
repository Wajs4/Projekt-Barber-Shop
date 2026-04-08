<?php
// Skontrolujeme, či bol formulár odoslaný metódou POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Získanie dát z formulára pomocou názvov v atribúte "name"
    // htmlspecialchars slúži ako základná ochrana proti XSS útokom
    $meno = htmlspecialchars($_POST['bb-name']);
    $telefon = htmlspecialchars($_POST['bb-phone']);
    $cas = htmlspecialchars($_POST['bb-time']);
    $pobocka = htmlspecialchars($_POST['bb-branch']);
    $datum = htmlspecialchars($_POST['bb-date']);
    $pocet_ludi = htmlspecialchars($_POST['bb-number']);
    $sprava = htmlspecialchars($_POST['bb-message']);

    // Tu môžete s dátami pracovať (napr. uložiť do databázy alebo poslať mailom)
    // Pre testovacie účely si ich môžeme vypísať do konzoly prehliadača alebo na stránku
    echo "<script>alert('Rezervácia prijatá pre: $meno na deň $datum o $cas');</script>";
}
?>