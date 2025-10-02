// Aguarda o carregamento completo do DOM antes de executar o script
document.addEventListener("DOMContentLoaded", () => {
    
    // Busca pelos elementos necessários no formulário
    const emailInput = document.getElementById("email");           // Campo de entrada do e-mail
    const feedbackElement = document.getElementById("emailFeedback"); // Elemento para exibir mensagens
    
    // Verifica se o elemento principal existe antes de continuar
    if (!emailInput) {
        console.error("Elemento com id 'email' não encontrado");
        return;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    
    /**
     * Atualiza as classes CSS e mensagens de feedback baseado no estado de validação
     * 
     * @param {Object} config - Configuração do estado
     * @param {boolean} config.valid - Se o campo é válido ou não
     * @param {string} config.message - Mensagem a ser exibida
     */
    function setState({ valid, message }) {
        // Remove todas as classes de estado anteriores
        emailInput.classList.remove("is-valid", "is-invalid");

        // Remove classes de feedback se o elemento existir
        if (feedbackElement) {
            feedbackElement.classList.remove("ok", "error");
        }

        if (valid) {
            // === ESTADO VÁLIDO ===
            emailInput.classList.add("is-valid");           // Adiciona estilo de campo válido
            if (feedbackElement) {
                feedbackElement.classList.add("ok");        // Adiciona estilo de mensagem positiva
                feedbackElement.textContent = message || "E-mail válido."; // Exibe mensagem de sucesso
            }
            emailInput.setCustomValidity("");               // Remove erro de validação HTML5
        } else {
            // === ESTADO INVÁLIDO ===
            emailInput.classList.add("is-invalid");         // Adiciona estilo de campo inválido
            if (feedbackElement) {
                feedbackElement.classList.add("error");     // Adiciona estilo de mensagem de erro
                feedbackElement.textContent = message || "Por favor insira um e-mail válido."; // Exibe mensagem de erro
            }
            emailInput.setCustomValidity("E-mail inválido."); // Define erro para validação HTML5
        }
    }

    function validateEmailOnBlur() {
        const value = emailInput.value.trim(); // Remove espaços em branco do início e fim

        // Verifica se o campo está vazio
        if (value === "") {
            setState({ 
                valid: false, 
                message: "O campo de e-mail não pode ficar vazio." 
            });
            return; // Interrompe a execução se estiver vazio
        }

        // Aplica a validação do formato de e-mail usando regex
        if (emailRegex.test(value)) {
            // E-mail tem formato válido
            setState({ 
                valid: true, 
                message: "E-mail válido." 
            });
        } else {
            // E-mail tem formato inválido
            setState({ 
                valid: false, 
                message: "Formato inválido. Ex.: nome@empresa.com.br" 
            });
        }
    }

    // VALIDAÇÃO EM TEMPO REAL (DURANTE A DIGITAÇÃO)
    function validateEmailOnInput() {
        const value = emailInput.value.trim(); // Remove espaços em branco

        // Se o campo estiver vazio, remove todas as classes e mensagens
        if (value === "") {
            emailInput.classList.remove("is-valid", "is-invalid");
            if (feedbackElement) {
                feedbackElement.classList.remove("ok", "error");
                feedbackElement.textContent = ""; // Limpa a mensagem
            }
            return; // Não mostra erro quando o campo está vazio durante a digitação
        }

        // Valida o formato conforme o usuário digita
        if (emailRegex.test(value)) {
            // Formato válido - feedback positivo
            setState({ 
                valid: true, 
                message: "E-mail válido." 
            });
        } else {
            // Formato inválido - feedback orientação
            setState({ 
                valid: false, 
                message: "Formato inválido. Ex.: nome@empresa.com.br" 
            });
        }
    }

    // Validação quando o campo perde o foco (mais rigorosa)
    emailInput.addEventListener("blur", validateEmailOnBlur);
    
    // Validação em tempo real durante a digitação (mais suave)
    emailInput.addEventListener("input", validateEmailOnInput);
});
