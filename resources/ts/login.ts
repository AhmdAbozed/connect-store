async function submitLoginForm(event: Event) {
    const submitBtn = document.getElementById('submit') as HTMLInputElement

    document.getElementById('invalid')!.classList.replace('block', 'hidden');
    event.preventDefault();
    const target = event.target as any
    submitBtn.disabled = true;
    const submission = { username: target.elements.username.value, password: target.elements.password.value }
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
    const endpoint = location.protocol + "//" + location.host + "/_api/user/login"
    const res = await fetch(endpoint, options);
    console.log(res.status)
    const jsonResult = await res.json();
    //const resJSON = await res.json()


    if (res.status == 200) {
        console.log(res.status)
        window.location.href = '/'
    }
    else if (res.status == 422) {
        console.log(jsonResult);
        submitBtn.disabled = false;
    }
    else if (res.status == 403) {
        submitBtn.disabled = false;
        document.getElementById('invalid')!.classList.replace('hidden', 'block');
        console.log("invalid credentials: " + jsonResult)
    } else {
        console.log("invalid idk")

        submitBtn.disabled = false;

    }
    return res
}

document.getElementById('loginForm')!.addEventListener('submit', submitLoginForm);