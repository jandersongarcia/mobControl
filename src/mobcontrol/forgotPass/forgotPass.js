// Replace 'myForm' with the ID of your form
const sendPost = document.getElementById('forgot');
const spinner = document.getElementById('spinner');
const button = document.getElementById('submit');
const label = document.getElementById('status');
const danger = document.getElementById('danger');
const div = document.getElementById("frm");
const success = document.getElementById("success");

sendPost.addEventListener('submit', (e) => {
    e.preventDefault();

    button.disabled = true;

    spinner.classList.remove('d-none');
    label.classList.add('d-none');
    danger.classList.add('d-none');

    const formData = new FormData(sendPost);

    mob.post('/ctrl/packages/mobcontrol/forgotPass?action=verify', formData, function (response) {
        
        const data = JSON.parse(response);
        if (data.error) {
            danger.classList.remove('d-none');
            danger.innerHTML = data.error;
        } else {
            // Lógica a ser executada em caso de sucesso
            success.innerHTML = data.success;
            div.classList.add('d-none');
        }
        
        spinner.classList.add('d-none');
        label.classList.remove('d-none');
        button.disabled = false;
    }, function (error) {
        // Lógica a ser executada em caso de erro
        console.error('POST Error:', error);

    });

});