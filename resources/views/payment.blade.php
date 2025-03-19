<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Tradition & Style</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="payment-body">
    <div class="payment-container">
        <h1 class="payment-heading">Payment</h1>

        <div class="payment-form">
            <form id="payment-form">
                <div class="form-row">
                    <label for="card-element">
                        Credit or Debit Card
                    </label>
                    <div id="card-element">
                        <!-- Un élément Stripe sera inséré ici -->
                    </div>
                    <!-- Afficher des erreurs de carte -->
                    <div id="card-errors" role="alert"></div>
                </div>

                <button id="submit" class="payment-button">Pay Now</button>
            </form>
        </div>
    </div>

    <!-- Ajouter Stripe.js -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Utilisez votre clé publique Stripe depuis le fichier .env
        var stripe = Stripe("{{ env('STRIPE_KEY') }}"); // Ta clé publique Stripe
        var elements = stripe.elements();
        var card = elements.create("card");
        card.mount("#card-element");

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', async function(event) {
            event.preventDefault();

            // Créez un token Stripe à partir de la carte
            const {token, error} = await stripe.createToken(card);

            if (error) {
                // Si une erreur se produit, affichez-la
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            } else {
                // Envoie le token au serveur pour traiter le paiement
                const response = await fetch("{{ route('payment') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: JSON.stringify({
                        payment_method_id: token.id,
                        amount: 5000, // Exemple : montant de 50$ (en cents)
                        order_id: 123, // ID de la commande, récupéré dynamiquement
                    })
                });

                const data = await response.json();

                // Vérifie si le paiement a réussi
                if (data.success) {
                    alert("Payment successful!");
                    window.location.href = "{{ route('confirmation') }}"; // Rediriger après succès
                } else {
                    alert("Payment failed. Please try again.");
                }
            }
        });
    </script>
</body>
</html>
