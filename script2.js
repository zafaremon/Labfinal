const form = document.getElementById('subscriptionForm');
const nameInput = document.getElementById('name');
const emailInput = document.getElementById('email');
const errorMessageElement = document.getElementById('errorMessage');

form.addEventListener('submit', (event) => {
  event.preventDefault(); // Prevent default form submission

  // Validate name
  if (!nameInput.value) {
    errorMessageElement.textContent = 'Please enter your name';
    nameInput.focus();
    return;
 }
 // Validate email
  if (!validateEmail(emailInput.value)) {
    errorMessageElement.textContent = 'Please enter a valid email address';
    emailInput.focus();
    return;
  }
});

function validateEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@\"]+)(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
