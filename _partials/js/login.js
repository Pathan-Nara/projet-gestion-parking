const login = async (username, password) => {
    const formData = new URLSearchParams();
    formData.append("username", username);
    formData.append("password", password);
    const response = await fetch("index.php?component=login", {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
        method: "POST",
        body: formData,
    })
    data = await response.json();
    return data;
}

document.addEventListener("DOMContentLoaded", () => {
    // const loginBtn = document.getElementById("login-btn");
    const registerBtn = document.getElementById("register-btn");
    const loginForm = document.getElementById("login-form");

    // loginBtn.addEventListener("click", async () => {
    //     const username = document.getElementById("username").value;
    //     const password = document.getElementById("password").value;
    //     const response = await login(username, password);
    //     console.log(response);
    //     if (response.authentication) {
    //         window.location.href = "index.php?component=home";
    //     }
    // });

    loginForm.addEventListener("submit", async(e) => {
        e.preventDefault();
        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;
        const response = await login(username, password);
        if(response.errors){
            response.errors.forEach(errorMessage => {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'alert alert-danger';
                errorDiv.textContent = errorMessage;
                loginForm.prepend(errorDiv);
            });
        }
        if (response.authentication) {
            window.location.href = "index.php?component=home";
        }

    });

    registerBtn.addEventListener("click", async () => {
        window.location.href = "index.php?component=register";
    })

    
})