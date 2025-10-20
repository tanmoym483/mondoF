<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($data['title'] ?? 'My Site') ?></title>
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
  
</head>
<body>

  <?= view('layouts/header') ?>
  <!-- <?= view('layouts/sidebar') ?> -->

  <main style="padding:20px;">
    <?= $content ?>  <!-- dynamically loaded view -->
  </main>

  <?= view('layouts/footer') ?>






    <style>
        /* Reset & basic styles */
        * {margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif;}
   
        body {background-color: #fff; color: #333; padding-top: 30px;}

        /* Header */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background-color: #ff6b6b;
            color: white;
        }
        header h1 {font-size: 1.8rem;}
        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
        }
        nav a:hover {text-decoration: underline;}

        /* Hero Section */
        .hero {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 400px;
            background: url('https://images.unsplash.com/photo-1600891964599-f61ba0e24092?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwzNjUyOXwwfDF8c2VhcmNofDF8fGZvb2R8ZW58MHx8fHwxNjk3MjI1NDQ1&ixlib=rb-4.0.3&q=80&w=1080') center/cover no-repeat;
            color: white;
            text-align: center;
        }
        .hero h2 {
            font-size: 3rem;
            text-shadow: 2px 2px 4px #000;
        }
        .hero p {
            font-size: 1.2rem;
            margin-top: 15px;
            text-shadow: 1px 1px 2px #000;
        }

        /* Featured Products */
        .section {
            padding: 50px;
            max-width: 1200px;
            margin: auto;
        }
        .section h3 {
            text-align: center;
            margin-bottom: 40px;
            color: #ff6b6b;
        }
        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        .product {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
        }
        .product:hover {transform: scale(1.05);}
        .product img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product-details {
            padding: 15px;
        }
        .product-details h4 {margin-bottom: 10px;}
        .product-details p {margin-bottom: 15px; color: #555;}
        .product-details button {
            background-color: #ff6b6b;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
        }
        .product-details button:hover {background-color: #ff3b3b;}

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 30px 20px;
            margin-top: 50px;
        }

        /* Responsive */
        @media(max-width:768px){
            header {flex-direction: column;}
            nav {margin-top: 10px;}
            .hero h2 {font-size: 2.2rem;}
        }
    </style>

    <script>
        // Sample product data
        const productData = [
            {name: "Margherita Pizza", price: "$12", img: "https://images.unsplash.com/photo-1601924582971-8e0f35a647f5?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=400"},
            {name: "Burger Deluxe", price: "$10", img: "https://images.unsplash.com/photo-1550547660-d9450f859349?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=400"},
            {name: "Pasta Carbonara", price: "$15", img: "https://images.unsplash.com/photo-1603070279051-28b2337ef8bc?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=400"},
            {name: "Sushi Platter", price: "$20", img: "https://images.unsplash.com/photo-1604908177522-235b7f3d1c87?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=400"},
        ];

        const productsContainer = document.getElementById('products');
        productData.forEach(product => {
            const productEl = document.createElement('div');
            productEl.classList.add('product');
            productEl.innerHTML = `
                <img src="${product.img}" alt="${product.name}">
                <div class="product-details">
                    <h4>${product.name}</h4>
                    <p>Price: ${product.price}</p>
                    <button onclick="addToCart('${product.name}')">Add to Cart</button>
                </div>
            `;
            productsContainer.appendChild(productEl);
        });

        function addToCart(productName){
            alert(productName + " added to cart!");
        }
    </script>

</body>
</html>
