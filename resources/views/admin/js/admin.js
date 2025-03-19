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
    const newItem = {
        id: document.getElementById('productId').value,
        name: document.getElementById('productName').value,
        category: document.getElementById('category').value,
        stock: document.getElementById('stock').value,
        price: document.getElementById('price').value
    };

    const method = newItem.id ? 'PUT' : 'POST';
    const url = newItem.id ? `/api/inventory/${newItem.id}` : '/api/inventory';

    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(newItem)
    })
    .then(response => response.json())
    .then(data => {
        closeModal();
        populateInventory();
    })
    .catch(error => console.error('Error:', error));
});

// Function to populate the inventory table
function populateInventory() {
    fetch('/api/inventory')
        .then(response => response.json())
        .then(inventoryData => {
            const tbody = document.querySelector('.inventory-table tbody');
            tbody.innerHTML = '';
            for (const category in inventoryData) {
                inventoryData[category].forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${item.name}</td>
                        <td>${item.category}</td>
                        <td><input type="number" value="${item.stock}" onchange="updateStock(${item.id}, this.value, '${item.category}')"></td>
                        <td><input type="number" value="${item.price}" onchange="updatePrice(${item.id}, this.value, '${item.category}')"></td>
                        <td>
                            <button class="edit-btn" onclick="editItem(${item.id}, '${item.category}')">Edit</button>
                            <button class="delete-btn" onclick="deleteItem(${item.id}, '${item.category}')">Delete</button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            }
        })
        .catch(error => {
            console.error('Error fetching inventory data:', error);
        });
}

// Function to update stock
function updateStock(id, value, category) {
    fetch('/api/inventory')
        .then(response => response.json())
        .then(inventoryData => {
            const item = inventoryData[category].find(item => item.id == id);
            if (item) {
                item.stock = value;
                fetch('/api/inventory', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(item)
                })
                .then(response => response.json())
                .then(data => {
                    populateInventory();
                })
                .catch(error => console.error('Error:', error));
            }
        });
}

// Function to update price
function updatePrice(id, value, category) {
    fetch('/api/inventory')
        .then(response => response.json())
        .then(inventoryData => {
            const item = inventoryData[category].find(item => item.id == id);
            if (item) {
                item.price = value;
                fetch('/api/inventory', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(item)
                })
                .then(response => response.json())
                .then(data => {
                    populateInventory();
                })
                .catch(error => console.error('Error:', error));
            }
        });
}

// Function to edit an item

function editItem(id, category) {
    fetch('/api/inventory')
        .then(response => response.json())
        .then(inventoryData => {
            const item = inventoryData[category].find(item => item.id == id);
            if (item) {
                document.getElementById('inventoryModal').style.display = 'block';
                document.getElementById('modalTitle').textContent = 'Edit Item';
                document.getElementById('productId').value = item.id;
                document.getElementById('productName').value = item.name;
                document.getElementById('category').value = item.category;
                document.getElementById('stock').value = item.stock;
                document.getElementById('price').value = item.price;
            }
        });
}

// Function to delete an item
function deleteItem(id, category) {
    fetch(`/api/inventory/${category}/${id}`, {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(data => {
        populateInventory();
    })
    .catch(error => console.error('Error:', error));
}


// Load inventory data and populate the table on page load
document.addEventListener('DOMContentLoaded', function() {
    populateInventory();
});

