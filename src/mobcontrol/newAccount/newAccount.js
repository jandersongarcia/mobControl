// Seleção dos elementos do DOM
const passwordInput = document.getElementById('PASSWORD');
const progressBar = document.getElementById('PROGRESSBAR');
const user = document.getElementById('USERNAME');
const alerta = document.getElementById('alert');
const email = document.getElementById('EMAIL');
const login = document.getElementById('toLogin');
const addNew = document.getElementById('addNew');
const btnSub = document.getElementById('btnSub');
const spin = document.getElementById('spin');

// Constantes para representar valores fixos
const MIN_PASSWORD_LENGTH = 12; // Comprimento mínimo recomendado da senha
const NUM_REQUIRED_CRITERIA = 4; // Número total de critérios de força da senha

// Adiciona listeners para os eventos
user.addEventListener('blur', userCheck); // Verifica o nome de usuário quando perde o foco
email.addEventListener('blur', emailCheck); // Verifica o e-mail quando perde o foco
passwordInput.addEventListener('blur', forcePass); // Verifica a senha quando perde o foco
passwordInput.addEventListener('input', checkPasswordStrength); // Verifica a força da senha durante a digitação
user.addEventListener('input', filter); // Filtra o nome de usuário durante a digitação

// Listener para o evento de submit do formulário
addNew.addEventListener('submit', (e) => {
  e.preventDefault(); // Impede o envio padrão do formulário

  const formData = new FormData(addNew); // Cria um objeto FormData com os dados do formulário

  sending(0); // Mostra um indicador de envio de dados

  // Envia os dados do formulário para o servidor via requisição POST assíncrona
  mob.post('/ctrl/packages/mobcontrol/newAccount?action=addUser', formData, function (response) {
    console.log(response); // Exibe a resposta do servidor no console
    const data = JSON.parse(response); // Converte a resposta em um objeto JavaScript
    if (data.success === true) { // Se a resposta indicar sucesso
      window.location.href = login.href; // Redireciona o usuário para a página de login
      sending(1); // Oculta o indicador de envio de dados
    }
  }, function (error) {
    // Lógica a ser executada em caso de erro
    console.error('POST Error:', error); // Exibe o erro no console
    sending(1); // Oculta o indicador de envio de dados
  });

});

// Função para controlar o indicador de envio de dados
function sending(n) {
  if (n == 0) {
    btnSub.disabled = true; // Desabilita o botão de envio
    spin.classList.remove('d-none'); // Mostra o indicador de envio
  } else {
    btnSub.disabled = false; // Habilita o botão de envio
    spin.classList.add('d-none'); // Oculta o indicador de envio
  }
}

// Função para verificar o nome de usuário
function userCheck() {
  let username = user.value; // Obtém o valor do nome de usuário
  user.classList.remove('is-invalid'); // Remove qualquer indicação de erro

  if (username.length > 0) { // Se o nome de usuário não estiver vazio
    // Realiza uma requisição GET assíncrona para verificar se o nome de usuário já existe
    mob.get(`/ctrl/packages/mobcontrol/newAccount?action=verifyUser&usr=${username}`,
      function (response) {
        const data = JSON.parse(response); // Converte a resposta em um objeto JavaScript
        if (data.result > 0) { // Se o nome de usuário já existir
          alerta.classList.remove('d-none'); // Mostra a mensagem de alerta
          alerta.innerHTML = data.message; // Define o texto da mensagem de alerta
          user.classList.add('is-invalid'); // Adiciona uma classe para indicar erro
          user.value = ''; // Limpa o campo do nome de usuário
          user.focus(); // Coloca o foco no campo do nome de usuário
        } else {
          alerta.classList.add('d-none'); // Oculta a mensagem de alerta
        }
      },
      function (error) {
        console.error(error); // Exibe o erro no console
      }
    );
  }
}

// Função para verificar o e-mail
function emailCheck() {
  email.classList.remove('is-invalid'); // Remove qualquer indicação de erro

  if (email.value.length > 0) { // Se o campo do e-mail não estiver vazio
    // Realiza uma requisição GET assíncrona para verificar se o e-mail já existe
    mob.get(`/ctrl/packages/mobcontrol/newAccount?action=verifyEmail&mail=${email.value}`,
      function (response) {
        const data = JSON.parse(response); // Converte a resposta em um objeto JavaScript
        if (data.result > 0) { // Se o e-mail já existir
          alerta.classList.remove('d-none'); // Mostra a mensagem de alerta
          alerta.innerHTML = data.message; // Define o texto da mensagem de alerta
          email.classList.add('is-invalid'); // Adiciona uma classe para indicar erro
          email.value = ''; // Limpa o campo do e-mail
          email.focus(); // Coloca o foco no campo do e-mail
        } else {
          alerta.classList.add('d-none'); // Oculta a mensagem de alerta
        }
      },
      function (error) {
        console.error(error); // Exibe o erro no console
      }
    );
  }
}

// Função para filtrar o nome de usuário
function filter() {
  let userName = user.value; // Obtém o valor do nome de usuário
  userName = userName.toLowerCase(); // Converte o nome de usuário para minúsculas
  userName = userName.replace(/[^a-z0-9._]/g, ''); // Remove caracteres não permitidos
  user.value = userName; // Define o valor do campo do nome de usuário
}

// Função para verificar a força da senha
function forcePass() {
  let str = progressBar.style.width; // Obtém a largura atual da barra de progresso
  let force = str.replace(/%/g, ''); // Remove o '%' da largura
  if (force < 75) { // Se a força da senha for menor que 75%
    if (user.value.length > 0 && passwordInput.value.length > 0) { // Se o nome de usuário e a senha não estiverem vazios
      passwordInput.classList.add('is-invalid'); // Adiciona uma classe para indicar erro na senha
      progressBar.style.width = "0%"; // Redefine a largura da barra de progresso para 0%
      passwordInput.value = ''; // Limpa o campo da senha
      passwordInput.focus(); // Coloca o foco no campo da senha
    }
  } else {
    passwordInput.classList.remove('is-invalid'); // Remove qualquer indicação de erro na senha
  }
}

// Função para verificar a força da senha e atualizar a barra de progresso
function checkPasswordStrength() {
  const password = passwordInput.value; // Obtém o valor da senha
  let strength = 0; // Inicializa a força da senha

  // Verifica o comprimento da senha
  if (password.length >= MIN_PASSWORD_LENGTH) {
    strength++;
  }

  // Verifica a diversidade de caracteres
  const diversityRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/;
  if (diversityRegex.test(password)) {
    strength++;
  }

  // Verifica a aleatoriedade
  const randomRegex = /^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[@$!%*?&])[A-Za-z0-9@$!%*?&]+$/;
  if (randomRegex.test(password)) {
    strength++;
  }

  // Verifica se a senha não está relacionada ao nome de usuário
  const username = user.value.toLowerCase(); // Obtém o valor do nome de usuário em minúsculas
  if (password.toLowerCase().indexOf(username) === -1) { // Se a senha não contiver o nome de usuário
    strength++;
  }

  // Atualiza a barra de progresso
  progressBar.value = (strength / NUM_REQUIRED_CRITERIA) * 100;

  // Altera a largura da barra de progresso e a cor de acordo com a força da senha
  progressBar.style.width = `${(strength / NUM_REQUIRED_CRITERIA) * 100}%`;

  let force = (strength / NUM_REQUIRED_CRITERIA) * 100;

  removeClass(); // Remove classes de estilo da barra de progresso

  // Adiciona uma classe de cor à barra de progresso de acordo com a força da senha
  if (force > 90) {
    progressBar.classList.add('bg-success');
  } else if (force > 70) {
    progressBar.classList.add('bg-primary');
  } else if (force > 50) {
    progressBar.classList.add('bg-warning');
  } else {
    progressBar.classList.add('bg-danger');
  }
}

// Função para remover classes de estilo da barra de progresso
function removeClass() {
  progressBar.classList.remove('bg-danger');
  progressBar.classList.remove('bg-warning');
  progressBar.classList.remove('bg-primary');
  progressBar.classList.remove('bg-success');
}

// Chamada inicial para verificar a força da senha ao carregar a página
checkPasswordStrength();
