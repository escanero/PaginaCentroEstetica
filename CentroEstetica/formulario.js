
document.addEventListener('DOMContentLoaded', function() {
    mostrarFormulario('register');
});



function mostrarFormulario(formType) {
    if (formType === 'login') {
        document.querySelector('.formularioL').style.display = 'block';
        document.querySelector('.formularioR').style.display = 'none';
        document.getElementById('loginTab').style.display = 'none';
        document.getElementById('registerTab').style.display = 'inline-block';
    } else if (formType === 'register') {
        document.querySelector('.formularioL').style.display = 'none';
        document.querySelector('.formularioR').style.display = 'block';
        document.getElementById('loginTab').style.display = 'inline-block';
        document.getElementById('registerTab').style.display = 'none';
    }
}



