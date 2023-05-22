window.onload = function() {

    var url = window.location.href;
    var id = url.split('/verify/')[1];
    console.log(id);
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'verify_account.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    const encodedData = new URLSearchParams(id).toString();
    console.log(encodedData);
    xhr.send(encodedData);
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log(this.responseText); // bug this reponse 
        } else {
          console.log('Erreur de la requête: ' + xhr.statusText);
        }
      };
}