
document.querySelectorAll('.removeBtn').forEach((btn) => {
    btn.addEventListener('click', async (e) => {
        const removeBtn = e.currentTarget as HTMLButtonElement;
        removeBtn.innerHTML = 'Deleting';
        removeBtn.disabled = true;
        const itemId = removeBtn.parentElement!.id

        const response = await fetch('/_api/user/order/' + itemId+'/delete', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Optional, depending on your server's requirements
            },
            body: JSON.stringify({ status: 'delete' }) // Sending an empty JSON object
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


document.querySelectorAll('.showMoreBtn').forEach(button => {
    button.addEventListener('click', function (event) {
        const button = event.target as HTMLElement; // Get the clicked button
        const productMore = button.parentElement!.parentElement!.querySelector('.product-more')!; // The hidden product-more div
        console.log(productMore.classList.contains('hidden'));
        console.log(productMore)
        if (productMore.classList.contains('hidden')) {
            productMore.classList.replace('hidden', 'block');
            console.log(productMore.classList.contains('hidden'));
            button.textContent = 'Show Less'; // Change button text
        } else {
            productMore.classList.replace('block', 'hidden');
            button.textContent = 'Show More'; // Reset button text
        }
    });
});