document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".contact-form form");
    const submitButton = form.querySelector('button[type="submit"]');
    const emailInput = form.querySelector('input[name="email"]');
    const phoneInputs = form.querySelectorAll('input[name="phone[]"]');
    const countrySelects = form.querySelectorAll('.country-select');
    const birthDateInput = form.querySelector('input[name="birth_date"]');

    form.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
        }
    });

    function validateForm() {
        let isValid = true;

        form.querySelectorAll("input[required], textarea[required]").forEach((input) => {
            const error = input.nextElementSibling;
            if (!input.value.trim()) {
                isValid = false;
                input.classList.add('input-error');
                error.textContent = 'Это поле обязательно для заполнения';
            } else {
                input.classList.remove('input-error');
                error.textContent = '';
            }
        });

        if (emailInput && emailInput.value && emailInput.validity.typeMismatch) {
            isValid = false;
            emailInput.classList.add('input-error');
            emailInput.nextElementSibling.textContent = 'Введите корректный email';
        } else {
            emailInput.classList.remove('input-error');
        }
        
        if (birthDateInput && birthDateInput.value) {
            const birthDate = new Date(birthDateInput.value);
            const today = new Date();
            if (birthDate > today) {
                isValid = false;
                birthDateInput.classList.add('input-error');
                birthDateInput.nextElementSibling.textContent = 'Дата рождения не может быть в будущем';
            } else {
                birthDateInput.classList.remove('input-error');
            }
        }

        let contactFilled = emailInput.value.trim() !== "";
        phoneInputs.forEach((phoneInput) => {
            if (phoneInput.value.trim()) {
                contactFilled = true;
            }
        });

        if (!contactFilled) {
            isValid = false;
            submitButton.classList.remove("active");
            submitButton.disabled = true;
            return;
        }

        submitButton.classList.toggle("active", isValid);
        submitButton.disabled = !isValid;
    }

    form.querySelectorAll("input[required], textarea[required]").forEach(input => {
        const error = document.createElement('div');
        error.className = 'error-message';
        input.parentNode.appendChild(error);

        input.addEventListener("input", validateForm);
    });

    emailInput.addEventListener("input", validateForm);
    phoneInputs.forEach((phoneInput) => {
        phoneInput.addEventListener("input", validateForm);
    });

    birthDateInput.addEventListener('input', function () {
        const value = birthDateInput.value.replace(/[^0-9-]/g, '');
        const parts = value.split('-');

        if (parts[2] && parts[2].length > 4) {
            parts[2] = parts[2].slice(0, 4);
        }

        birthDateInput.value = parts.join('-');
    });

    submitButton.classList.remove("active");
    submitButton.disabled = true;

    function updateCountryPlaceholder(selectElement, phoneInput, flagElement) {
        const flagClass = selectElement.selectedOptions[0].getAttribute('data-flag');
        phoneInput.placeholder = flagClass === 'belarus' ? '+375 (__) ___-__-__' : '+7 (___) ___-__-__';
        flagElement.className = 'phone-row__country ' + flagClass;
    }

    countrySelects.forEach((select, index) => {
        const phoneInput = phoneInputs[index];
        const flagElement = select.parentNode.querySelector('.phone-row__country');

        select.addEventListener('change', function () {
            updateCountryPlaceholder(select, phoneInput, flagElement);
        });

        updateCountryPlaceholder(select, phoneInput, flagElement);
    });

    document.querySelector('.add-phone-btn').addEventListener('click', function () {
        const additionalPhoneFields = document.getElementById('additional-phone-fields');
        if (additionalPhoneFields.querySelectorAll('.phone-row').length >= 5) {
            alert("Вы можете добавить не более 5 номеров телефона.");
            return;
        }

        const newPhoneField = document.createElement('div');
        newPhoneField.classList.add('phone-row');
        newPhoneField.innerHTML = 
            `<select name="country_code[]" class="country-select">
                <option value="+375" data-flag="belarus">Беларусь</option>
                <option value="+7" data-flag="russia">Россия</option>
            </select>
            <div class="phone-row__country belarus"></div>
            <input type="tel" name="phone[]" placeholder="+375 (__) ___-__-__">
            <button type="button" class="remove-phone-btn">-</button>`;
        additionalPhoneFields.appendChild(newPhoneField);

        const countrySelect = newPhoneField.querySelector('.country-select');
        const phoneInput = newPhoneField.querySelector('input[type="tel"]');
        const countryFlag = newPhoneField.querySelector('.phone-row__country');

        countrySelect.addEventListener('change', function () {
            updateCountryPlaceholder(countrySelect, phoneInput, countryFlag);
        });

        newPhoneField.querySelector('.remove-phone-btn').addEventListener('click', function () {
            if (additionalPhoneFields.querySelectorAll('.phone-row').length > 1) {
                newPhoneField.remove();
                validateForm();
            }
        });

        validateForm();
    });
});
