const submitBtn = document.getElementById("submit-button");
submitBtn.addEventListener('click', (event) => {
  event.preventDefault();
  
  const form = document.getElementById("form");
  const xhr = new XMLHttpRequest();
  document.getElementById("logError").innerHTML = "";
  xhr.open('POST', 'submit.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  var passwordformat = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[@$!%*?&])[A-Za-z0-9@$!%*?&]{12,}$/;
  const formData = new FormData(form);
  const encodedData = new URLSearchParams(formData).toString();
  password = formData.get('password');
  email = formData.get('email');
  username = formData.get('username');
  xhr.send(encodedData);
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Success
      document.getElementById("logError").innerHTML = this.responseText;

    } else {
      // Error
      //document.getElementById("logError").innerHTML = this.responseText;
    }
  };
});