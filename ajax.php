<?php
// on verfie si on a bien un debut d'adresse
if(!empty($_GET['adresse']))
{
    $adresse = urlencode($_GET['adresse']);
    // on fait notre requete curl
    $url = "https://api-adresse.data.gouv.fr/search/?q=".$adresse;
    // on initialise une session curl 
    $ch = curl_init();
    // on va mettre une option pour nous retourner le résultat
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    // on fait passer l'url
    curl_setopt($ch,CURLOPT_URL,$url);
    // on valide l'utilisation du ssl (https)
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,true);
    // on va executer la requete
    $resultat = curl_exec($ch);
    echo '<pre>';
    print_r(json_decode($resultat));
    echo '<pre>';
    // on ferme notre session curl
    curl_close($ch);
}
?>