const searchBtn = document.getElementById('search-btn');
const cartBtn = document.getElementById('cart-btn');
const menuBtn = document.getElementById('menu-btn');
const searchForm = document.querySelector('.search-form');
const navbar = document.querySelector('.navbar');
const cartContainer = document.querySelector('.cart-items-container');
const cartItemsContainer = document.getElementById('cart-items');
const cartEmptyMessage = document.getElementById('cart-empty-message');

let cartItems = JSON.parse(localStorage.getItem('cartItems')) || []; 

// Toggle search form

searchBtn.addEventListener('click', () => {
    searchForm.classList.toggle('active');
    navbar.classList.remove('active');
    closeCart();
});

// Toggle navigation menu

menuBtn.addEventListener('click', () => {
    navbar.classList.toggle('active');
    searchForm.classList.remove('active');
    closeCart();
});

// Close navigation menu on window resize

window.addEventListener('resize', () => {
    if (window.innerWidth > 768) {
        navbar.classList.remove('active');
    }
});

// Toggle cart container

cartBtn.addEventListener('click', () => {
    cartContainer.classList.toggle('active');
    searchForm.classList.remove('active');
    navbar.classList.remove('active');

    if (cartContainer.classList.contains('active')) {
        updateCartUI();
    } else {
        closeCart();
    }
});

// Close all on scroll

window.addEventListener('scroll', () => {
    searchForm.classList.remove('active');
    navbar.classList.remove('active');
    closeCart();
});

// Function to update cart sidebar

function updateCartUI() {
    if (cartItems.length === 0) {
        cartItemsContainer.style.display = 'none';
        cartEmptyMessage.style.display = 'block';
    } else {
        cartItemsContainer.style.display = 'block';
        cartEmptyMessage.style.display = 'none';

        cartItemsContainer.innerHTML = '';
        cartItems.forEach((item, index) => {
            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item');
            cartItem.innerHTML = `
                <h3>${item.name}</h3>
                <p>Price: $${item.price.toFixed(2)}</p>
                <p> ${item.description}</p> <!-- Added Description -->
                <label for="quantity-${index}">Quantity:</label>
                <input type="number" id="quantity-${index}" min="1" value="${item.quantity}" data-index="${index}"> <!-- Updated Code -->
                <span class="fas fa-times" onclick="removeCartItem(${index})"></span>
                <button class="buy-now-btn" onclick="buyNow(${index})">Buy Now</button>
            `;
            cartItemsContainer.appendChild(cartItem);
        });

        // Added event listener to update quantity in localStorage
        
        document.querySelectorAll('.cart-item input[type="number"]').forEach(input => {
            input.addEventListener('change', (event) => {
                const index = event.target.dataset.index;
                const newQuantity = event.target.value;
                cartItems[index].quantity = parseInt(newQuantity);
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
                updateCartUI(); // Recalculate total price or any other necessary updates
            });
        });
    }
}


// Function to remove item from cart

window.removeCartItem = (index) => {
    cartItems.splice(index, 1);
    localStorage.setItem('cartItems', JSON.stringify(cartItems)); 
    updateCartUI();
}

// Function to close cart sidebar

function closeCart() {
    cartContainer.classList.remove('active');
}

// Page Navigation

document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        const targetSection = document.querySelector(link.getAttribute('href'));
        if (targetSection) {
            window.scrollTo({
                top: targetSection.offsetTop,
                behavior: 'smooth'
            });
            navbar.classList.remove('active');
            searchForm.classList.remove('active');
            closeCart();
        }
    });
});

// Function to handle Buy Now button click

window.buyNow = (index) => {
    const item = cartItems[index];
    localStorage.setItem('selectedItem', JSON.stringify(item));
    window.location.href = 'checkout';
}   

// Initial load

document.addEventListener('DOMContentLoaded', () => {
    updateCartUI();

    // Fetch data for shop and makeup pages
    fetch('inventory.json')
        .then(response => response.json())
        .then(data => {
            const boxes = document.querySelectorAll('.box');
            boxes.forEach(box => {
                const productId = box.getAttribute('data-id');
                const product = data.products.find(p => p.id == productId);
                if (product) {
                    box.querySelector('.stock').textContent = product.stock;
                }
            });
        });


    // Add event listeners for "Add to Cart" buttons

    const addToCartButtons = document.querySelectorAll('.add-to-cart');
addToCartButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        const parentBox = button.closest('.box');
        const productName = parentBox.dataset.name;
        const productPrice = parseFloat(parentBox.dataset.price);
        const productDescription = parentBox.dataset.description; 
        addToCart(productName, productPrice, productDescription); 
    });
});


    // Add event listener to the contact form

    const contactForm = document.getElementById("contactForm");
    if (contactForm) {
        contactForm.addEventListener("submit", sendmail);
    }
});

// Function to add items to cart (from any page)

function addToCart(productName, price, description) {
    
    const existingItemIndex = cartItems.findIndex(item => item.name === productName);
    if (existingItemIndex !== -1) {
       
        cartItems[existingItemIndex].quantity += 1; 
    } else {
       
        let item = {
            name: productName,
            price: price,
            quantity: 1,
            description: description
        };
        cartItems.push(item);
    }
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
    updateCartUI(); 
    showNotification('Item added to cart!');
}

function showNotification(message) {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.classList.add('show');

    setTimeout(() => {
        notification.classList.remove('show');
    }, 3000); // Hide after 3 seconds
}


// Function to handle email sending

function sendmail(event) {
    event.preventDefault(); 

    var params = {
        name: document.getElementsByName("name")[0].value,
        email: document.getElementsByName("email")[0].value,
        phone: document.getElementsByName("phone")[0].value,
        message: document.getElementsByName("message")[0].value,
    };

    const serviceId = "service_axafjoe";
    const templateID = "template_z1g62bg";

    emailjs.send(serviceId, templateID, params)
        .then(res => {
            document.getElementsByName("name")[0].value = "";
            document.getElementsByName("email")[0].value = "";
            document.getElementsByName("phone")[0].value = "";
            document.getElementsByName("message")[0].value = "";
            console.log(res);
            alert("Your message sent successfully");
        })
        .catch(err => console.log(err));
}

// for email conformation in footer 

// document.getElementById('newsletter-form').addEventListener('submit', function(event) {
//     event.preventDefault(); 
//     const emailInput = document.getElementById('newsletter-email'); 
//     const messagePara = document.getElementById('newsletter-message');
    
//     if (emailInput.value) { 
//         messagePara.textContent = 'Email sign-up successful!'; 
//         emailInput.value = ''; 
//     } else {
//         messagePara.textContent = 'Please enter a valid email address.'; 
//     }
// });


// handle shipping method calculation

document.addEventListener('DOMContentLoaded', () => {
    const productPriceElement = document.getElementById('product-price');
    const deliveryChargesElement = document.getElementById('delivery-charges');
    const totalAmountElement = document.getElementById('total-amount');
    const proceedToPaymentButton = document.getElementById('proceed-to-payment');

    // Get the selected item from localStorage
    const selectedItem = JSON.parse(localStorage.getItem('selectedItem'));
    if (!selectedItem) {
        console.error("No selected item found in localStorage.");
        return;
    }

    const productPrice = selectedItem.price * selectedItem.quantity;
    const deliveryCharges = 5; // Fixed delivery charge
    const totalAmount = productPrice + deliveryCharges;

    // Update the product price and total amount on the page
    productPriceElement.textContent = `$${productPrice.toFixed(2)}`;
    deliveryChargesElement.textContent = `$${deliveryCharges.toFixed(2)}`;
    totalAmountElement.textContent = `$${totalAmount.toFixed(2)}`;

    // Proceed to payment button handler
    proceedToPaymentButton.addEventListener('click', (event) => {
        event.preventDefault();
        // Add logic to proceed to payment
        window.location.href = 'payment.html';
    });
});


// Get modal element
var modal = document.getElementById("adminModal");

// Get the link that opens the modal
var adminLink = document.getElementById("adminLink");

// Get the <span> element that closes the modal
var closeBtn = document.getElementsByClassName("close")[0];

// Open the modal when the "Admin" link is clicked
adminLink.onclick = function(event) {
    event.preventDefault(); // Prevent default link behavior
    modal.style.display = "block";
}

// Close the modal when the close button (x) is clicked
closeBtn.onclick = function() {
    modal.style.display = "none";
}

// Close the modal when clicking outside of it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Handle form submission
document.getElementById("adminLoginForm").onsubmit = function(event) {
    event.preventDefault(); // Prevent form from submitting normally

    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var accessCode = document.getElementById("accessCode").value;

    // Basic email validation regex
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    if (username && emailPattern.test(email) && accessCode === "123admin") {
        // Redirect to the admin panel if credentials are correct
        window.location.href = "/admin/dashboard";
    } else {
        // Show an error message if credentials are wrong
        document.getElementById("errorMessage").style.display = "block";
    }
}
// public/js/script.js

document.addEventListener('DOMContentLoaded', () => {
    const productNameElement = document.getElementById('product-name');
    const productPriceElement = document.getElementById('product-price');
    const deliveryChargesElement = document.getElementById('delivery-charges');
    const totalAmountElement = document.getElementById('total-amount');
    const proceedToPaymentButton = document.getElementById('proceed-to-payment');

    // Récupération de l'objet selectedItem du localStorage
    const selectedItem = JSON.parse(localStorage.getItem('selectedItem'));

    if (selectedItem) {
        // Calcul du prix total
        const productPrice = selectedItem.price * selectedItem.quantity;
        const deliveryCharges = 5; // Exemple de frais de livraison
        const totalAmount = productPrice + deliveryCharges;

        // Mise à jour des informations dans le résumé de commande
        productNameElement.textContent = selectedItem.name;
        productPriceElement.textContent = `$${productPrice.toFixed(2)}`;
        deliveryChargesElement.textContent = `$${deliveryCharges.toFixed(2)}`;
        totalAmountElement.textContent = `$${totalAmount.toFixed(2)}`;
    } else {
        console.log('Aucun produit sélectionné.');
    }

    // Lorsque l'utilisateur clique sur "Proceed to Payment"
    proceedToPaymentButton.addEventListener('click', (event) => {
        event.preventDefault();

        // Récupération des données du formulaire
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const city = document.getElementById('city').value.trim();
        const zipcode = document.getElementById('zipcode').value.trim();
        const address = document.getElementById('address').value.trim();

        // Validation des champs du formulaire
        if (!name || !email || !phone || !city || !zipcode || !address) {
            alert("Veuillez remplir tous les champs.");
            return;
        }

        // Si tout est valide, envoyer les données au backend
        // Tu peux utiliser un formulaire POST ici pour soumettre les informations de commande

        // Par exemple, tu peux envoyer une requête AJAX ou soumettre le formulaire
        document.getElementById('checkout-form').submit();
    });
});
