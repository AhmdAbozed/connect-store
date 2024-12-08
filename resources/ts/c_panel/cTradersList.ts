const rejectBtn = document.querySelectorAll('.rejectBtn').forEach((btn) => {
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
        removeBtn.innerHTML = 'Rejecting';
        removeBtn.disabled = true;
        const itemId = removeBtn.parentElement!.id
        
        const response = await fetch('/_api/administrator/user/'+itemId+'?status=rejected', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({}) // Sending an empty JSON object
        });

        const data = await response.text();
        if (response.status === 200) {
            console.log('Success:', data);
            
            removeBtn.innerHTML = 'Rejected';
        } else {
            removeBtn.innerHTML = 'Failed: ' +response.status + ' '+data
            console.error('Error:', response.statusText);
        }
    })
})

const approveBtn = document.querySelectorAll('.approveBtn').forEach((btn) => {
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
        removeBtn.innerHTML = 'Approving';
        removeBtn.disabled = true;
        const itemId = removeBtn.parentElement!.id
        
        const response = await fetch('/_api/administrator/user/'+itemId+'?status=trader', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({}) // Sending an empty JSON object
        });

        const data = await response.text();
        if (response.status === 200) {
            console.log('Success:', data);
            removeBtn.innerHTML = 'Approved';
        } else {
            removeBtn.innerHTML = 'Failed: ' +response.status 
            console.error('Error:', response.statusText);
        }
    })
})


const revokeBtn = document.querySelectorAll('.revokeBtn').forEach((btn) => {
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
        removeBtn.innerHTML = 'Revoking';
        removeBtn.disabled = true;
        const itemId = removeBtn.parentElement!.id
        
        const response = await fetch('/_api/administrator/user/'+itemId+'?status=pending', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({}) // Sending an empty JSON object
        });

        const data = await response.text();
        if (response.status === 200) {
            console.log('Success:', data);
            removeBtn.innerHTML = 'Revoked';
        } else {
            removeBtn.innerHTML = 'Failed: ' +response.status 
            console.error('Error:', response.statusText);
        }
    })
})