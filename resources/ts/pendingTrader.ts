import { signout } from "./utils";

document.querySelector('.signout')!.addEventListener('click', async (e) => {
    const signoutBtn = e.currentTarget as HTMLButtonElement;

    signoutBtn.innerHTML = 'Signing out';
    signoutBtn.disabled = true;
    const signedOut = await signout();
    if(!signedOut) {
        signoutBtn.innerHTML = 'sign out failed'
    }
})
