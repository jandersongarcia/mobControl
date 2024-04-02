const passwordInput = document.getElementById('newPass');
const progressBar = document.getElementById('progress');
const generate = document.getElementById('generate');
const button = document.getElementById('button');
const spinner = document.getElementById('spinner');
const message = document.getElementById('message');
const box = document.getElementById('box');

// Constantes para representar valores fixos
const MIN_PASSWORD_LENGTH = 12; // Comprimento mínimo recomendado da senha
const NUM_REQUIRED_CRITERIA = 4; // Número total de critérios de força da senha

passwordInput.addEventListener('blur', forcePass); // Verifica a senha quando perde o foco
passwordInput.addEventListener('input', checkPasswordStrength); // Verifica a força da senha durante a digitação

generate.addEventListener('click', () => {
    passwordInput.value = generateStrongPassword();
    checkPasswordStrength();
});

// Replace 'myForm' with the ID of your form
const sendPost = document.getElementById('myForm');

sendPost.addEventListener('submit', (e) => {
    e.preventDefault();

    button.disabled = true;
    spinner.classList.remove('d-none');

    const formData = new FormData(sendPost);
    const urlParams = new URLSearchParams(window.location.search);
    const keyValue = urlParams.get('key');

    if (keyValue) {
        formData.append('key', keyValue);
    }

    mob.post('/ctrl/packages/mobcontrol/newPass', formData, function (response) {
        
        const data = JSON.parse(response);

        // Checando se a primeira posição do array é 'success'
        if (data[0] === "success") {
            // A segunda posição do array contém a mensagem de sucesso
            message.innerHTML = data[1]; // Usando innerHTML para interpretar a tag <strong>
        } else {
            message.innerHTML = data[1]; // Usando innerHTML para interpretar a tag <strong>
        }

        box.classList.add('d-none'); // Esconde o box se necessário
        button.disabled = false; // Reabilita o botão
        spinner.classList.add('d-none'); // Esconde o spinner
    }, function (error) {
        // Lógica a ser executada em caso de erro
        console.error('POST Error:', error);
        button.disabled = false; // É importante reabilitar o botão também em caso de erro
        spinner.classList.add('d-none'); // E esconder o spinner
    });

});


// Função para verificar a força da senha
function forcePass() {
    let str = progressBar.style.width; // Obtém a largura atual da barra de progresso
    let force = str.replace(/%/g, ''); // Remove o '%' da largura
    if (force < 60) { // Se a força da senha for menor que 75%
        if (passwordInput.value.length > 0) { // Se o nome de usuário e a senha não estiverem vazios
            passwordInput.classList.add('is-invalid'); // Adiciona uma classe para indicar erro na senha
            progressBar.style.width = "0%"; // Redefine a largura da barra de progresso para 0%
            passwordInput.value = ''; // Limpa o campo da senha
            passwordInput.focus(); // Coloca o foco no campo da senha
        }
    } else {
        passwordInput.classList.remove('is-invalid'); // Remove qualquer indicação de erro na senha
    }
}

function checkPasswordStrength() {
    const password = passwordInput.value; // Obtém o valor da senha

    let criteriaMet = 0; // Inicializa o número de critérios atendidos

    // Verifica o comprimento da senha
    if (password.length > 8) {
        criteriaMet++;
    }

    // Verifica se tem pelo menos 3 letras maiúsculas
    if ((password.match(/[A-Z]/g) || []).length >= 3) {
        criteriaMet++;
    }

    // Verifica se tem pelo menos 3 letras minúsculas
    if ((password.match(/[a-z]/g) || []).length >= 3) {
        criteriaMet++;
    }

    // Verifica se tem pelo menos 3 números
    if ((password.match(/\d/g) || []).length >= 3) {
        criteriaMet++;
    }

    // Verifica se tem pelo menos 3 caracteres especiais
    if ((password.match(/[@$!%*?&#]/g) || []).length >= 3) {
        criteriaMet++;
    }

    // Calcula a força da senha baseado no número de critérios atendidos
    const totalCriteria = 5;
    const strength = (criteriaMet / totalCriteria) * 100;

    progressBar.value = strength;
    progressBar.style.width = `${strength}%`;

    // Limpa as classes existentes na barra de progresso
    progressBar.classList.remove('bg-success', 'bg-primary', 'bg-warning', 'bg-danger');

    // Adiciona uma classe de cor à barra de progresso de acordo com a força da senha
    if (strength === 100) {
        progressBar.classList.add('bg-success');
    } else if (strength >= 60) {
        progressBar.classList.add('bg-primary');
    } else if (strength >= 40) {
        progressBar.classList.add('bg-warning');
    } else {
        progressBar.classList.add('bg-danger');
    }
}


function generateStrongPassword() {
    const uppercaseLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const lowercaseLetters = 'abcdefghijklmnopqrstuvwxyz';
    const numbers = '0123456789';
    const specialCharacters = '@$!%*?&#';

    // Função para selecionar n caracteres aleatórios de uma string fornecida
    function getRandomCharacters(source, count) {
        let result = '';
        for (let i = 0; i < count; i++) {
            result += source.charAt(Math.floor(Math.random() * source.length));
        }
        return result;
    }

    // Construir partes da senha para satisfazer os critérios mínimos
    const partUppercase = getRandomCharacters(uppercaseLetters, 3);
    const partLowercase = getRandomCharacters(lowercaseLetters, 3);
    const partNumbers = getRandomCharacters(numbers, 3);
    const partSpecialCharacters = getRandomCharacters(specialCharacters, 3);

    // Combina as partes e adiciona caracteres extras para garantir um comprimento mínimo de 12
    const extraLengthNeeded = 12 - (partUppercase.length + partLowercase.length + partNumbers.length + partSpecialCharacters.length);
    const extraCharacters = getRandomCharacters(uppercaseLetters + lowercaseLetters + numbers + specialCharacters, extraLengthNeeded);

    // Combina todas as partes
    const combined = partUppercase + partLowercase + partNumbers + partSpecialCharacters + extraCharacters;

    // Embaralhar a senha para não ser previsível a ordem
    function shuffleString(string) {
        const array = string.split('');
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array.join('');
    }

    return shuffleString(combined);
}


// Função auxiliar para obter um caractere aleatório de uma string fornecida
function getRandomChar(charset) {
    const randomIndex = Math.floor(Math.random() * charset.length);
    return charset[randomIndex];
}

// Função para gerar uma sequência numérica de 5 dígitos
function getRandomNumberSequence(length) {
    let sequence = "";
    for (let i = 0; i < length; i++) {
        sequence += Math.floor(Math.random() * 10);
    }
    return sequence;
}

// Função para embaralhar uma string
function shuffleString(string) {
    const array = string.split('');
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]]; // Troca elementos
    }
    return array.join('');
}

function removeClass() {
    progressBar.classList.remove('bg-danger');
    progressBar.classList.remove('bg-warning');
    progressBar.classList.remove('bg-primary');
    progressBar.classList.remove('bg-success');
}