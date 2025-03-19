<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="css/admin.css">

    <style>
        /* Styles for the image popup */
        .image-popup {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
        }

        .image-popup-content {
            margin: 15% auto;
            display: block;
            max-width: 80%;
            max-height: 80%;
        }

        .image-popup-close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .image-popup-close:hover,
        .image-popup-close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

</head>
<body>
    <button class="menu-btn">&#9776;</button>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="index.html" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="users.html"><i class="fas fa-users"></i> User Management</a>
        <a href="products.html" class="active"><i class="fas fa-box"></i> Product Management</a>
        <a href="orders.html"><i class="fas fa-shopping-cart"></i> Order Management</a>
        <a href="inventory.html"><i class="fas fa-warehouse"></i> Inventory Management</a>
        <a href="sales.html"><i class="fas fa-tags"></i> Sales and Discounts</a>
        <a href="support.html"><i class="fas fa-headset"></i> Customer Support</a>
        <a href="settings.html"><i class="fas fa-cogs"></i> Settings</a>
        <a href="security.html"><i class="fas fa-shield-alt"></i> Security</a>
        <a href="analytics.html"><i class="fas fa-chart-line"></i> Analytics and Reporting</a>
        <a href="notifications.html"><i class="fas fa-bell"></i> Notifications</a>
        <a href="../index.html"><img src="../images/logo.png" alt="Logo" style="width: 30px; height: 30px; vertical-align: middle; margin-right: 8px;">CelestiaChic</a>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Product Management</h1>
            <div class="summary-cards">
                <div class="card">
                    <h3>Total Products</h3>
                    <p id="totalProducts">0</p>
                </div>
                <div class="card">
                    <h3>Out of Stock</h3>
                    <p id="outOfStock">0</p>
                </div>
                <div class="card">
                    <h3>New Arrivals</h3>
                    <p id="newArrivals">0</p>
                </div>
            </div>

            <div class="metric-update">
                <h2>Update Metrics</h2>
                <label for="updateTotalProducts">Total Products:</label>
                <input type="number" id="updateTotalProducts"value="35">
                
                <label for="updateOutOfStock">Out of Stock:</label>
                <input type="number" id="updateOutOfStock"value="5">
                
                <label for="updateNewArrivals">New Arrivals:</label>
                <input type="number" id="updateNewArrivals"value="10">
                
                <button id="updateMetricsBtn"><i class="fas fa-sync"></i> Update Metrics</button>
            </div>
        </div>

        <div class="content">
            <div class="actions">
                <button id="addProductBtn"><i class="fas fa-plus"></i> Add New Product</button>
                <input type="text" id="productSearch" placeholder="Search products...">
            </div>

            <div class="product-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <!-- Product rows will be dynamically added here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for Adding/Editing Product -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modalTitle">Add New Product</h2>
            <form id="productForm">
                <label for="productName">Name:</label>
                <input type="text" id="productName" name="productName" required>

                <label for="productCategory">Category:</label>
                <select id="productCategory" name="productCategory" required>
                    <option value="Dresses">Traditionnel</option>
                    <option value="makeup">Moderne</option>
                    
                    <!-- More categories -->
                </select>

                <label for="productPrice">Price:</label>
                <input type="number" id="productPrice" name="productPrice" required>

                <label for="productStock">Stock:</label>
                <input type="number" id="productStock" name="productStock" required>

                <label for="productImage">Image:</label>
                <input type="file" id="productImage" name="productImage" accept="image/*" required>

                <button type="submit" id="saveProductBtn"><i class="fas fa-save"></i> Save</button>
            </form>
        </div>
    </div>

    <!-- Image Popup Modal -->
<div id="imagePopup" class="image-popup">
    <span class="image-popup-close">&times;</span>
    <img class="image-popup-content" id="popupImage" alt="Product Image">
</div>


    <script src="js/admin.js"></script>
    <script>
       document.addEventListener('DOMContentLoaded', () => {
    let products = [
    
];
    
    // Set initial values for metrics
let initialTotalProducts = 35;
let initialOutOfStock = 5;
let newArrivalsCount = 10;

function updateMetrics() {
    const totalProducts = parseInt(document.getElementById('updateTotalProducts').value) || initialTotalProducts;
    const outOfStock = parseInt(document.getElementById('updateOutOfStock').value) || initialOutOfStock;
    const newArrivals = newArrivalsCount;  // This value will be updated manually as needed

    document.getElementById('totalProducts').innerText = totalProducts;
    document.getElementById('outOfStock').innerText = outOfStock;
    document.getElementById('newArrivals').innerText = newArrivals;
}

// Initialize metrics
updateMetrics();

    // Function to render the product table
    function renderProducts() {
        const productTableBody = document.getElementById('productTableBody');
        productTableBody.innerHTML = '';

        products.forEach(product => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${product.id}</td>
                <td><button class="image-btn" data-image="${product.image}"><i class="fas fa-image"></i> View Image</button></td>
                <td>${product.name}</td>
                <td>${product.category}</td>
                <td>$${product.price.toFixed(2)}</td>
                <td>${product.stock > 0 ? 'In Stock' : 'Out of Stock'}</td>
                <td>
                    <button class="edit-btn" data-id="${product.id}"><i class="fas fa-edit"></i> Edit</button>
                    <button class="delete-btn" data-id="${product.id}"><i class="fas fa-trash"></i> Delete</button>
                </td>
            `;
            productTableBody.appendChild(row);
        });

        // Add event listeners to image buttons
        document.querySelectorAll('.image-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const imageSrc = e.currentTarget.getAttribute('data-image');
                showImagePopup(imageSrc);
            });
        });

        // Add event listeners to edit and delete buttons
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const productId = parseInt(e.currentTarget.getAttribute('data-id'));
                const product = products.find(p => p.id === productId);
                openProductModal(product);
            });
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const productId = parseInt(e.currentTarget.getAttribute('data-id'));
                deleteProduct(productId);
            });
        });

        updateMetrics();
    }

    // Function to add or update a product
    function addOrUpdateProduct(product) {
        if (product.id) {
            // Update existing product
            const index = products.findIndex(p => p.id === product.id);
            products[index] = product;
        } else {
            // Add new product
            product.id = products.length ? Math.max(...products.map(p => p.id)) + 1 : 1;
            products.push(product);
            newArrivalsCount++;
        }

        renderProducts();
        document.getElementById('productModal').style.display = 'none';
    }

    // Function to delete a product
    function deleteProduct(productId) {
        products = products.filter(product => product.id !== productId);
        renderProducts();
    }

    // Function to handle the metrics update
    function handleMetricsUpdate() {
        const totalProducts = parseInt(document.getElementById('updateTotalProducts').value) || 0;
        const outOfStock = parseInt(document.getElementById('updateOutOfStock').value) || 0;
        const newArrivals = parseInt(document.getElementById('updateNewArrivals').value) || 0;

        document.getElementById('totalProducts').innerText = totalProducts;
        document.getElementById('outOfStock').innerText = outOfStock;
        document.getElementById('newArrivals').innerText = newArrivals;
    }

    // Add event listener to the update metrics button
    document.getElementById('updateMetricsBtn').addEventListener('click', handleMetricsUpdate);

    // Function to open the modal with product data
    function openProductModal(product) {
        const modal = document.getElementById('productModal');
        document.getElementById('modalTitle').innerText = product ? 'Edit Product' : 'Add New Product';

        document.getElementById('productName').value = product ? product.name : '';
        document.getElementById('productCategory').value = product ? product.category : 'Dresses';
        document.getElementById('productPrice').value = product ? product.price : '';
        document.getElementById('productStock').value = product ? product.stock : '';
        document.getElementById('productImage').value = '';

        document.getElementById('productForm').onsubmit = function (e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const newProduct = {
                id: product ? product.id : null,
                name: formData.get('productName'),
                category: formData.get('productCategory'),
                price: parseFloat(formData.get('productPrice')),
                stock: parseInt(formData.get('productStock')),
                image: formData.get('productImage') // This will be a File object
            };

            if (!newProduct.image) {
                alert("Please upload a product image.");
                return;
            }

            const reader = new FileReader();
            reader.onloadend = function () {
                newProduct.image = reader.result;
                addOrUpdateProduct(newProduct);
            };
            reader.readAsDataURL(newProduct.image);
        };

        modal.style.display = 'block';
    }

    // Event listener for Add New Product button
    document.getElementById('addProductBtn').addEventListener('click', () => {
        openProductModal(null);
    });

    // Close modal
    document.querySelector('.close').addEventListener('click', () => {
        document.getElementById('productModal').style.display = 'none';
    });

    // Initialize product table
    renderProducts();

    // Function to show the image popup
    function showImagePopup(imageSrc) {
        const imagePopup = document.getElementById('imagePopup');
        const popupImage = document.getElementById('popupImage');

        popupImage.src = imageSrc;
        imagePopup.style.display = 'block';
    }

    // Close the image popup
    document.querySelector('.image-popup-close').addEventListener('click', () => {
        document.getElementById('imagePopup').style.display = 'none';
    });
});


    </script>
</body>
</html>
