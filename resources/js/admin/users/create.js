document.addEventListener('DOMContentLoaded', () => {

    const form = document.querySelector('form');

    if (!form) {
        return;
    }

    // =========================================================
    // ELEMENTOS
    // =========================================================

    const fields = {
        name: document.getElementById('name'),
        RA: document.getElementById('RA'),
        email: document.getElementById('email'),
        birthdate: document.getElementById('birthdate'),
        CPF: document.getElementById('CPF'),
        RG: document.getElementById('RG'),
        phone: document.getElementById('phone'),
        role: document.getElementById('role'),
    };


    // =========================================================
    // FUNÇÕES AUXILIARES
    // =========================================================

    function setValid(input) {
        if (!input) return;

        input.classList.remove(
            'border-red-400',
            'bg-red-50',
            'focus:border-red-500',
            'focus:ring-red-500/10'
        );

        input.classList.add(
            'border-green-400',
            'bg-green-50',
            'focus:border-green-500',
            'focus:ring-green-500/10'
        );

        removeError(input);
    }


    function setInvalid(input, message) {
        if (!input) return;

        input.classList.remove(
            'border-green-400',
            'bg-green-50',
            'focus:border-green-500',
            'focus:ring-green-500/10'
        );

        input.classList.add(
            'border-red-400',
            'bg-red-50',
            'focus:border-red-500',
            'focus:ring-red-500/10'
        );

        showError(input, message);
    }


    function resetField(input) {
        if (!input) return;

        input.classList.remove(
            'border-red-400',
            'bg-red-50',
            'focus:border-red-500',
            'focus:ring-red-500/10',
            'border-green-400',
            'bg-green-50',
            'focus:border-green-500',
            'focus:ring-green-500/10'
        );

        removeError(input);
    }


    function showError(input, message) {
        let error = input.parentElement.querySelector('.js-error');

        if (!error) {
            error = document.createElement('p');
            error.className = 'js-error mt-1 text-sm text-red-600';

            input.parentElement.appendChild(error);
        }

        error.textContent = message;
    }


    function removeError(input) {
        const error = input.parentElement.querySelector('.js-error');

        if (error) {
            error.remove();
        }
    }


    // =========================================================
    // NOME
    // =========================================================

    function validateName() {
        const input = fields.name;

        if (!input) return true;

        const value = input.value.trim();

        if (value === '') {
            setInvalid(input, 'O nome é obrigatório.');
            return false;
        }

        if (value.length < 3) {
            setInvalid(input, 'O nome deve possuir pelo menos 3 caracteres.');
            return false;
        }

        if (!/[a-zA-ZÀ-ÿ]/.test(value)) {
            setInvalid(input, 'Informe um nome válido.');
            return false;
        }

        setValid(input);
        return true;
    }


    // =========================================================
    // RA
    // =========================================================

    function validateRA() {
        const input = fields.RA;

        if (!input) return true;

        // Remove tudo que não for número
        input.value = input.value.replace(/\D/g, '');

        const value = input.value;

        if (value === '') {
            setInvalid(input, 'O RA é obrigatório.');
            return false;
        }

        if (value.length !== 12) {
            setInvalid(input, 'O RA deve possuir exatamente 12 números.');
            return false;
        }

        setValid(input);
        return true;
    }


    // =========================================================
    // E-MAIL
    // =========================================================

    function validateEmail() {
        const input = fields.email;

        if (!input) return true;

        const value = input.value.trim();

        if (value === '') {
            setInvalid(input, 'O e-mail é obrigatório.');
            return false;
        }

        const emailRegex =
            /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(value)) {
            setInvalid(input, 'Informe um e-mail válido.');
            return false;
        }

        setValid(input);
        return true;
    }


    // =========================================================
    // DATA DE NASCIMENTO
    // =========================================================

    function validateBirthdate() {
        const input = fields.birthdate;

        if (!input) return true;

        const value = input.value;

        if (value === '') {
            setInvalid(input, 'A data de nascimento é obrigatória.');
            return false;
        }

        const birthDate = new Date(value + 'T00:00:00');
        const today = new Date();

        if (isNaN(birthDate.getTime())) {
            setInvalid(input, 'Informe uma data válida.');
            return false;
        }

        if (birthDate > today) {
            setInvalid(
                input,
                'A data de nascimento não pode estar no futuro.'
            );
            return false;
        }

        let age = today.getFullYear() - birthDate.getFullYear();

        const monthDifference =
            today.getMonth() - birthDate.getMonth();

        if (
            monthDifference < 0 ||
            (
                monthDifference === 0 &&
                today.getDate() < birthDate.getDate()
            )
        ) {
            age--;
        }

        if (age < 14) {
            setInvalid(
                input,
                'A idade informada não é válida.'
            );
            return false;
        }

        if (age > 120) {
            setInvalid(
                input,
                'Informe uma data de nascimento válida.'
            );
            return false;
        }

        setValid(input);
        return true;
    }


    // =========================================================
    // CPF
    // =========================================================

    function isValidCPF(cpf) {
        cpf = cpf.replace(/\D/g, '');

        if (cpf.length !== 11) {
            return false;
        }

        // Impede CPFs como 11111111111
        if (/^(\d)\1{10}$/.test(cpf)) {
            return false;
        }

        let sum = 0;

        for (let i = 0; i < 9; i++) {
            sum += parseInt(cpf.charAt(i)) * (10 - i);
        }

        let digit1 = 11 - (sum % 11);

        if (digit1 >= 10) {
            digit1 = 0;
        }

        if (digit1 !== parseInt(cpf.charAt(9))) {
            return false;
        }

        sum = 0;

        for (let i = 0; i < 10; i++) {
            sum += parseInt(cpf.charAt(i)) * (11 - i);
        }

        let digit2 = 11 - (sum % 11);

        if (digit2 >= 10) {
            digit2 = 0;
        }

        return digit2 === parseInt(cpf.charAt(10));
    }


    function validateCPF() {
        const input = fields.CPF;

        if (!input) return true;

        input.value = input.value.replace(/\D/g, '');

        const value = input.value;

        if (value === '') {
            setInvalid(input, 'O CPF é obrigatório.');
            return false;
        }

        if (value.length !== 11) {
            setInvalid(
                input,
                'O CPF deve possuir 11 números.'
            );
            return false;
        }

        if (!isValidCPF(value)) {
            setInvalid(
                input,
                'O CPF informado é inválido.'
            );
            return false;
        }

        setValid(input);
        return true;
    }


    // =========================================================
    // RG
    // =========================================================

    function validateRG() {
        const input = fields.RG;

        if (!input) return true;

        input.value = input.value.replace(/\D/g, '');

        const value = input.value;

        // Se RG for opcional
        if (value === '') {
            resetField(input);
            return true;
        }

        if (value.length < 5 || value.length > 12) {
            setInvalid(
                input,
                'O RG deve possuir entre 5 e 12 números.'
            );
            return false;
        }

        setValid(input);
        return true;
    }


    // =========================================================
    // TELEFONE
    // =========================================================

    function validatePhone() {
        const input = fields.phone;

        if (!input) return true;

        input.value = input.value.replace(/\D/g, '');

        const value = input.value;

        // Telefone opcional
        if (value === '') {
            resetField(input);
            return true;
        }

        if (value.length !== 10 && value.length !== 11) {
            setInvalid(
                input,
                'Informe um telefone válido com 10 ou 11 números.'
            );
            return false;
        }

        setValid(input);
        return true;
    }


    // =========================================================
    // CARGO / ROLE
    // =========================================================

    function validateRole() {
        const input = fields.role;

        if (!input) return true;

        if (input.value === '') {
            setInvalid(input, 'Selecione uma função.');
            return false;
        }

        const validRoles = ['sec', 'atdr', 'aux'];

        if (!validRoles.includes(input.value)) {
            setInvalid(input, 'Selecione uma função válida.');
            return false;
        }

        setValid(input);
        return true;
    }


    // =========================================================
    // EVENTOS EM TEMPO REAL
    // =========================================================

    if (fields.name) {
        fields.name.addEventListener('input', validateName);
        fields.name.addEventListener('blur', validateName);
    }

    if (fields.RA) {
        fields.RA.addEventListener('input', validateRA);
        fields.RA.addEventListener('blur', validateRA);
    }

    if (fields.email) {
        fields.email.addEventListener('input', validateEmail);
        fields.email.addEventListener('blur', validateEmail);
    }

    if (fields.birthdate) {
        fields.birthdate.addEventListener('change', validateBirthdate);
        fields.birthdate.addEventListener('blur', validateBirthdate);
    }

    if (fields.CPF) {
        fields.CPF.addEventListener('input', validateCPF);
        fields.CPF.addEventListener('blur', validateCPF);
    }

    if (fields.RG) {
        fields.RG.addEventListener('input', validateRG);
        fields.RG.addEventListener('blur', validateRG);
    }

    if (fields.phone) {
        fields.phone.addEventListener('input', validatePhone);
        fields.phone.addEventListener('blur', validatePhone);
    }

    if (fields.role) {
        fields.role.addEventListener('change', validateRole);
    }


    // =========================================================
    // VALIDAÇÃO ANTES DO ENVIO
    // =========================================================

    form.addEventListener('submit', function (event) {

        const isValid =
            validateName() &
            validateRA() &
            validateEmail() &
            validateBirthdate() &
            validateCPF() &
            validateRG() &
            validatePhone() &
            validateRole();

        if (!isValid) {
            event.preventDefault();

            const firstInvalid =
                form.querySelector('.border-red-400');

            if (firstInvalid) {
                firstInvalid.focus();
                firstInvalid.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }
    });

});