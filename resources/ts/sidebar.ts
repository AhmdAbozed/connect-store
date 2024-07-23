document.getElementById('sidebar-button')?.addEventListener('click', ()=>{
    console.log('clicky')
    const sidebar = document.getElementById('sidebar');
    if(sidebar?.classList.contains('hidden')){
        document.getElementById('sidebar')!.classList.replace('hidden', 'flex');
    }else{
        document.getElementById('sidebar')!.classList.replace('flex', 'hidden');
    }
})