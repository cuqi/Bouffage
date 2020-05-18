<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="signup.css" />


<div id="signup" class="modal">
  <span onclick="document.getElementById('signup').style.display='none'"
class="close" title="Close Modal">&times;</span>

  <!-- Modal Content -->
  <form class="modal-content animate" id = "container" action="/bouffage/sign in/create_user.php" method="POST">
  <section class= "row">
    <div class="column">
  <div class="container left">
      <label for="email"><b>E-mail</b></label>
      <input type="text" placeholder="Enter e-mail" name="email" required>
      <br>
      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>
      <br>
      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
    </div>

    <div class="column">
  <div class="container left">
      <h1>i am verry sorry to hear that you are not a part of this website</h1>
      <h2>Please create an account</h2>
    </div>



  </section>
  
<hr>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('signup').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>

  <script>
// Get the modal
var signup = document.getElementById('signup');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == signup) {
    signup.style.display = "none";
  }
}
</script>
</div>
