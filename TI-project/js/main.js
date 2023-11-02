function displayUser() {
  const username = document.getElementById("username");
  const authUserString = localStorage.getItem("authUser");
  const authUser = JSON.parse(authUserString);

  username.innerText = `Welcome, ${authUser.email}`;
}
displayUser();

function onLogin() {
  const roles = document.querySelectorAll('input[name="role"]');
  const password = document.getElementById("password");
  const email = document.getElementById("email");
  let selectedRole = "";
  roles.forEach((radio) => {
    if (radio.checked) {
      selectedRole = radio.value;
    }
  });

  if (!password?.value || !email?.value || !selectedRole) {
    alert("Please fill the missing fields");
    return;
  }

  let redirectUrl =
    selectedRole === "tutor"
      ? "./dashboard_tutor.html"
      : "./dashboard_student.html";

  let user = {
    email: email.value,
    role: selectedRole,
  };
  localStorage.setItem("authUser", JSON.stringify(user));
  window.location.href = redirectUrl;
}
