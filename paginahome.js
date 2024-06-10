document.addEventListener('DOMContentLoaded', (event) => {
    const themeToggleButton = document.getElementById('theme-toggle');

    themeToggleButton.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');

        if (document.body.classList.contains('dark-mode')) {
            themeToggleButton.textContent = 'Modo Claro';
        } else {
            themeToggleButton.textContent = 'Modo Escuro';
        }
    });
});
function logar() {
    var login = document.getElementById('login').value;
    var senha = document.getElementById('senha').value;
    if (login === "admin" && senha === "admin") {
        alert('Sucesso!');
        window.location.href = "loginhome.html";
        return false;
    } else {
        alert("Usuário ou senha incorretos!");
        return false; 
    }
}
