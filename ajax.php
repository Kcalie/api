<?php
// On vérifie si on a bien un début d'adresse
if(!empty($_GET['adresse']))
{
    $adresse = urlencode($_GET['adresse']);
    // Url où on doit faire notre reuqête
    $url = "http://api-adresse.data.gouv.fr/search/?q=".$adresse;
    // On initialise une session CURL
    $ch = curl_init();
    //On va mettre une option pour nous retourner le résultat
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//Ture peut être remplacé par 1
    // On fait passer l'url en option
    curl_setopt($ch, CURLOPT_URL, $url);
    //On valide l'utilisation de ssl (https)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    // On exécute la requête
    $resultat = curl_exec($ch);
    $resultat = json_decode($resultat);
    //On va boucler sur les résultats
    $str = [];
    $i = 0;
    foreach($resultat->features as $res)
    {
        //On va stocker les informations
        $str[] = array(
            'label' => $res->properties->label,
            'cp' => $res->properties->postcode,
            'adresse' => $res->properties->name,
            'ville' => $res->properties->city,
        );
        
        $i++;
    }
    //On ferme notre session CURL
    curl_close($ch);
    //On retourne au format json de notre tableau
    echo json_encode($str);
}
?>