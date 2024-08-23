
const removeBtn = document.querySelectorAll('.removeBtn').forEach((btn) => {
    btn.addEventListener('click', async (e) => {
        const removeBtn = e.currentTarget as HTMLButtonElement;
        if(!removeBtn.classList.contains('confirm')){
            removeBtn.classList.add('confirm');
            removeBtn.disabled = true;
            setTimeout(() => {
                removeBtn.disabled = false;
                removeBtn.innerHTML = 'Confirm';
            }, 200);
            return;
        }
        removeBtn.innerHTML = 'Deleting';
        removeBtn.disabled = true;
        const itemId = removeBtn.parentElement!.id
        
        const response = await fetch('/_api/administrator/'+removeBtn.dataset.type+'/delete/'+itemId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({}) // Sending an empty JSON object
        });

        const data = await response.text();
        if (response.status === 200) {
            console.log('Success:', data);
            document.getElementById('p'+itemId)?.remove();
        } else {
            removeBtn.innerHTML = 'Failed: ' +response.status + ' '+data
            console.error('Error:', response.statusText);
        }
    })
})