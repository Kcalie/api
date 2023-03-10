function chercheAdresse(valeur)
{
    //On fait notre requête Ajax (sans jquery promis gérald)
    // fetch('ajax.php?adresse='+valeur)
    // .then(function(response) {
    //     console.log(response);
    //     let result = response.json();
    //     console.log(result.label);
    // })
    // .then(function(result){
    //     console.log(result);
    // })
    // .catch(function(error) {
    //     console.log('Une erreur est survenue :' + error);
    // });
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'ajax.php?adresse='+valeur);
    xhr.responseType = 'json';
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log(xhr.response);
            // on va préemplir la liste datalist
            let retour = '<ul id="liste">';
            for(let i=0; i< xhr.response.length;i++)
            {
                retour+= '<li onclick="selection(`'+xhr.response[i].cp+'`,`'+xhr.response[i].ville+'`,`'+xhr.response[i].adresse+'`)">'+xhr.response[i].label+'</li>';
                //document.getElementById('liste_adresse').innerHTML+= '<option value="'+xhr.response[i].label+'">'+xhr.response[i].label+'</option>';
            }
            retour+= '<ul>';
            let element = document.getElementById('result');
            element.innerHTML = retour;
            /*element.style.display = 'block';
            element.style.background = "#fff";*/
        }
        else {
            console.log('Requête échouée');
        }
    };
    xhr.onerror = function() {
        console.log('Erreur réseau');
    };
    xhr.send();
}
function selection(code,ville,adresse)
{
    document.getElementById('cp').value = code; 
    document.getElementById('ville').value = ville; 
    document.getElementById('adresse').value = adresse; 
    document.getElementById('result').style.display = 'none'; 
}