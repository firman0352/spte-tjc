 // Select all buttons with the delete-button class
 const deleteButtons = document.querySelectorAll('.delete-button');

 deleteButtons.forEach(button => {
     button.addEventListener('click', function() {
         const dataId = this.parentElement.getAttribute('data-id');
         Swal.fire({
             title: 'Are you sure?',
             text: 'This action cannot be undone!',
             icon: 'warning',
             showCancelButton: true,
             confirmButtonText: 'Yes, delete it!',
             cancelButtonText: 'Cancel'
         }).then((result) => {
             console.log(dataId);
             if (result.isConfirmed) {
                 // If the user confirms, submit the form with the correct inspektur ID
                 const form = document.querySelector(`form[data-id="${dataId}"]`);
                 form.submit();
             }
         });
     });
 });