const signupForm = document.getElementById('signup')!;
const chooseAccountForm = document.getElementById('chooseAccount')!;
const verificationForm = document.getElementById('verificationForm')!;
function enableSubmit(){
    (document.getElementById('submit') as HTMLButtonElement).disabled = false
}
async function submitSignupForm(event: Event) {
    const submitBtn = document.getElementById('submit') as HTMLInputElement

    event.preventDefault();
    const target = event.target as any
    
    //@ts-ignore
    const captchaToken = grecaptcha.getResponse();
    if (target.elements.type.value == 'customer' || target.elements.type.value == 'trader') {
        submitBtn.disabled = true;
        const submission = { 
            'g-recaptcha-response': captchaToken,
            username: target.elements.username.value, password: target.elements.password.value, email: target.elements.email.value, number: target.elements.number.value, type: (target.elements.type.value == 'trader')? 'pending':'customer' }
        console.log(submission)
        const options: RequestInit = {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'Access-Control-Allow-Credentials': 'true',
                'Accept': 'application/json'
            },
            credentials: "include",
            body: JSON.stringify(submission)
        }
        const endpoint = location.protocol + "//" + location.host + "/_api/user/signup"
        resetErrors();
        const res = await fetch(endpoint, options);
        console.log(res.status)
        const jsonResult = await res.json();
        //const resJSON = await res.json()


        if (res.status == 200) {
            console.log(res.status)
            window.location.href='/'
        }
        else if (res.status == 422) {
            console.log(jsonResult);
            displayErrors(jsonResult);
            submitBtn.disabled = false;
            
        }
        else if (res.status == 403) {
            submitBtn.disabled = false;
            console.log("invalid credentials: " + jsonResult)
        } else {
            console.log("invalid idk")

            submitBtn.disabled = false;

        }
        return res
    } else {
        displayForms();
        return;
    }

}
function chooseAccountType(event: Event) {
    const customerType = document.getElementById('customerType')

    const traderType = document.getElementById('traderType')
    const target = event.target as HTMLElement;
    const url = new URL(window.location.href);

    if (traderType?.contains(target)) {
        url.searchParams.set('type', 'trader')
        window.history.pushState({}, '', url);

    } else if (customerType?.contains(target)) {
        url.searchParams.set('type', 'customer')
        window.history.pushState({}, '', url);
    } else {
        return;
    }
    displayForms();

}
function displayForms() {
    const url = new URL(window.location.href);
    const typeInput = document.getElementById('typeInput')! as HTMLInputElement

    if (url.searchParams.get('type') && (url.searchParams.get('type') == 'customer' || url.searchParams.get('type') == 'trader')) {
        signupForm.classList.replace('hidden', 'flex')
        chooseAccountForm.classList.replace('flex', 'hidden')
        if (url.searchParams.get('type') == 'customer') {
            document.getElementById('formTitle')!.innerHTML = 'Creating a customer account'
            typeInput.value = 'customer'
        } else if (url.searchParams.get('type') == 'trader') {
            document.getElementById('formTitle')!.innerHTML = 'Creating a trader account'
            typeInput.value = 'trader'
        }
    } else {
        chooseAccountForm.classList.replace('hidden', 'flex')
        typeInput.value = '';
        signupForm.classList.replace('flex', 'hidden')
    }
}

function displayErrors(errorResponse: any) {

    const errors = errorResponse.errors;
    // Loop through each field in the errors object
    for (const field in errors) {

        // Get the input element by id
        const inputElement = document.getElementById(field);

        if (inputElement) {
            // Find the sibling div where the error message should be appended
            const errorContainer = inputElement.nextElementSibling;

            // Ensure the sibling is a div (or add your own check)
            if (errorContainer) {
                // Clear previous error messages
                errorContainer.innerHTML = '';

                // Append the error message
                errors[field].forEach((errorMessage: string) => {
                    errorContainer.innerHTML = errorMessage;
                });
            }
        }

    }
}
function resetErrors(){
    document.querySelectorAll('.formInputError').forEach(element => {
        element.innerHTML = ''
    });
}
// Example error response
// Call the function to display errors
function returnButton(e: Event) {

    console.log('hmm')
    const url = new URL(window.location.href);
    url.searchParams.delete('type')
    window.history.pushState({}, '', url);
    displayForms();

}
document.getElementById('accountType')!.addEventListener('click', chooseAccountType)
document.getElementById('signupForm')!.addEventListener('submit', submitSignupForm)
document.getElementById('returnButton')!.addEventListener('click', returnButton)
displayForms();