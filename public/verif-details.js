 // JavaScript to handle showing the modal and populating it with data
 const detailModal = document.getElementById('detailModal');
 const modalBody = document.getElementById('modal-body');

 // Function to show the modal and populate it with details
 function openDetailModal(data) {
 const companyName = document.getElementById('companyName');
 const status = document.getElementById('status');
 const inspector1 = document.getElementById('inspector1/address');
 const inspector2 = document.getElementById('inspector2/phone');
 const startDate = document.getElementById('start-date');
 const endDate = document.getElementById('end-date');
 const urlView = document.getElementById('url-view');

 // Update the content with the data
 companyName.textContent = data.nama_pt;
 status.textContent = data.status;

 let statusClass = ''; // Default class
 if (data.status_id === '1') {
     statusClass = 'bg-amber-100 text-amber-800';
 } else if (data.status_id === '2') {
     statusClass = 'bg-orange-100 text-orange-800';
 } else if (data.status_id === '3') {
     statusClass = 'bg-green-100 text-green-800';
 } else if (data.status_id === '4') {
     statusClass = 'bg-red-100 text-red-800';
 } else if (data.status_id === '5') {
     statusClass = 'bg-rose-100 text-rose-800';
 } else if (data.status_id === '6') {
     statusClass = 'bg-yellow-100 text-yellow-800';
 } else if (data.status_id === '7') {
     statusClass = 'bg-blue-100 text-blue-800';
 }
 // Apply the determined status class
 status.className = `px-2 py-0 lg:py-1 inline-flex text-center text-xs lg:text-md leading-5 font-semibold rounded-full ${statusClass}`;

 inspector1.textContent = data.inspektur1_name || 'N/A';
 inspector2.textContent = data.inspektur2_name || 'N/A';
 startDate.textContent = data.start || 'Not set';
 endDate.textContent = data.end || 'Not set';
 urlView.href = data.url;

 // Set other details accordingly
 // For example, you can set start and end dates here

 // Open the modal
 detailModal.classList.remove('hidden');
}

 // Add event listeners to all "View Detail" buttons
 const viewDetailButtons = document.querySelectorAll('.view-detail-button');
 viewDetailButtons.forEach(button => {
     button.addEventListener('click', () => {
         // Retrieve data for the specific item, you can use AJAX to fetch data if needed
         const itemId = button.getAttribute('data-id');
         const namaPt = button.getAttribute('data-nama_pt');
         const status = button.getAttribute('data-status');
         const inspektur1 = button.getAttribute('data-inspektur-adress');
         const inspektur2 = button.getAttribute('data-inspektur2-phone');
         const start = button.getAttribute('data-start');
         const end = button.getAttribute('data-end');
         const statusId = button.getAttribute('data-status-id');
         const url = button.getAttribute('data-url');

         const itemData = {
             nama_pt: `${namaPt}`,
             inspektur1_name: `${inspektur1}`,
             inspektur2_name: `${inspektur2}`,
             status: `${status}`,
             start: `${start}`,
             end: `${end}`,
             status_id: `${statusId}`,
             url: `${url}`,

             // Add more data here
         };

         // Open the modal with the retrieved data
         openDetailModal(itemData);
     });
 });

 function closeDetailModal() {
 detailModal.classList.add('opacity-0'); // Add opacity class for fade-out
 setTimeout(() => {
     detailModal.classList.add('hidden');
     detailModal.classList.remove('opacity-0'); // Remove opacity class after transition
 }, 300); // Wait for the 300ms transition duration
}
 // Close the modal when the overlay or the close button is clicked
 const modalOverlay = document.querySelector('.modal-overlay');
 modalOverlay.addEventListener('click', () => {
     closeDetailModal();
 });
 const modalClose = document.querySelector('.modal-close');
 modalClose.addEventListener('click', () => {
     closeDetailModal();
 });