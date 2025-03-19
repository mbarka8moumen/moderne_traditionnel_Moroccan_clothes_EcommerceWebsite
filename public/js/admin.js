document.addEventListener('DOMContentLoaded', function() {
    const menuBtn = document.querySelector('.menu-btn');
    const sidebar = document.querySelector('.sidebar');

    menuBtn.addEventListener('click', function() {
        sidebar.classList.toggle('expanded');
    });
});

// Function to show the add modal
function showAddModal() {
    document.getElementById('inventoryModal').style.display = 'block';
    document.getElementById('modalTitle').textContent = 'Add New Item';
    document.getElementById('inventoryForm').reset();
    document.getElementById('productId').value = '';
}

// Function to close the modal
function closeModal() {
    document.getElementById('inventoryModal').style.display = 'none';
}

// Function to handle form submission for adding/editing inventory items
document.getElementById('inventoryForm').addEventListener('submit', function(event) {
    event.preventDefault();
    closeModal();
});

// Load inventory data and populate the table on page load
document.addEventListener('DOMContentLoaded', function() {
    // Inventory population logic removed
});
