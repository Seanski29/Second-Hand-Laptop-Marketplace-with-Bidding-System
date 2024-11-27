function bidinput(){
    Swal.fire("Offer Sent!The Seller will contact you immedietly if they are interested in your offer. Thank you");
}

function logingoods(){
    Swal.fire({
        title: "The Internet?",
        text: "That thing is still around?",
        icon: "success"
      });
}

// Function to show an error alert with SweetAlert2
function showLoginError() {
    Swal.fire({
        title: 'Error!',
        text: 'Invalid email or password. Please try again.',
        icon: 'error',
        confirmButtonText: 'Try Again'
    });
}

function loginFirst() {
    Swal.fire({
        title: 'Error!',
        text: 'Please Log in First Before Entering.',
        icon: 'error',
        confirmButtonText: 'Try Again'
    });
}
