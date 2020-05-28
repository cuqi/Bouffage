<!DOCTYPE html>
<link rel="stylesheet" type="text/css"
              href="./modal.css" />
<!-- Button to open the modal login form -->
<!-- <button onclick="document.getElementById('id01').style.display='block'">Login</button> -->

<!-- The Modal -->
<div id="id01" class="modal" style="display: block">
  <span onclick="document.getElementById('id01').style.display='none'"
class="close" title="Close Modal">&times;</span>

  <!-- Modal Content -->
  <form class="modal-content animate" action="/bouffage/sign in/send_credentials.php" method="POST">
    <div class="imgcontainer">
      <img src="avatar.jpg" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter email" name="email" required>
      <br>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>

      <button type="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>

  <script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</div>
