
const orderRemoveBtn = document.querySelectorAll('.removeBtn').forEach((btn) => {
    btn.addEventListener('click', async (e) => {
        const removeBtn = e.currentTarget as HTMLButtonElement;
        removeBtn.innerHTML = 'Deleting';
        removeBtn.disabled = true;
        const itemId = removeBtn.parentElement!.id

        const response = await fetch('/_api/administrator/order/' + itemId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Optional, depending on your server's requirements
            },
            body: JSON.stringify({status:'delete'}) // Sending an empty JSON object
        });

        if (response.status === 200) {
            const data = await response.json();
            console.log('Success:', data);
            document.getElementById('p' + itemId)?.remove();
        } else {
            removeBtn.innerHTML = 'Failed to delete' + ' ' + response.status
            console.error('Error:', response.statusText);
        }
    })
})
const orderCompleteBtn = document.querySelectorAll('.completeBtn').forEach((btn) => {
    btn.addEventListener('click', async (e) => {
        const removeBtn = e.currentTarget as HTMLButtonElement;
        removeBtn.innerHTML = 'Fulfilling';
        removeBtn.disabled = true;
        const itemId = removeBtn.parentElement!.id

        const response = await fetch('/_api/administrator/order/' + itemId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Optional, depending on your server's requirements
            },
            body: JSON.stringify({status:'complete'}) // Sending an empty JSON object
        });

        if (response.status === 200) {
            const data = await response.json();
            console.log('Success:', data);
            document.getElementById('p' + itemId)?.remove();
        } else {
            removeBtn.innerHTML = 'Failed to delete' + ' ' + response.status
            removeBtn.disabled = false;
            console.error('Error:', response.statusText);
        }
    })
})