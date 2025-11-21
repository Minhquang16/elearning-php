<?php include 'header.php'; ?>
<body>

    <div class="checkout-wrapper">
        <div class="checkout-layout">
            <section class="checkout-form-section">
                <h2 class="checkout-form__title">Checkout</h2>
                <form class="payment-form">
                    <h4 class="payment-form__subtitle">Cart Type</h4>
                    <div class="payment-methods">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkNuec_LJ5EAkOpnoH0L04wYSFKum6t-4goQ&s" alt="PayPal" class="payment-logo">
                        <img src="https://1000logos.net/wp-content/uploads/2016/10/American-Express-Color.png" alt="American Express" class="payment-logo">
                        <img src="https://1000logos.net/wp-content/uploads/2017/06/VISA-Logo-2006.png" alt="VISA" class="payment-logo">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTD7oa6-WXok1YXYt8GN4CWbzJOpeBf69159Q&s" alt="MasterCard" class="payment-logo">
                    </div>
                    
                    <div class="form-group">
                        <label for="card-name" class="form-label">Name on Card</label>
                        <input type="text" id="card-name" placeholder="Enter Name on Card" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label for="card-number" class="form-label">Card Number</label>
                        <input type="text" id="card-number" placeholder="Enter Card Number" class="form-input">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group form-group--half">
                            <label for="expiry-date" class="form-label">Expiration Date (MM/YY)</label>
                            <input type="text" id="expiry-date" placeholder="Enter Expiration Date" class="form-input">
                        </div>
                        <div class="form-group form-group--half">
                            <label for="cvc" class="form-label">CVC</label>
                            <input type="text" id="cvc" placeholder="Enter CVC" class="form-input">
                        </div>
                    </div>
                    
                    <div class="form-checkbox">
                        <input type="checkbox" id="save-info">
                        <label for="save-info">Save my information for faster checkout</label>
                    </div>
                    
                    <button type="submit" class="confirm-button">Confirm Payment</button>
                    
                </form>
            </section>
            
            <aside class="order-summary">
                <h2 class="order-summary__title">Summary</h2>
                <div class="summary-items">
                    <div class="summary-item">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Python-logo-notext.svg/1200px-Python-logo-notext.svg.png" alt="Item Image" class="summary-item__image">
                        <div class="summary-item__details">
                            <p class="summary-item__name">adipiscing elit, sed do eiusmod tempor</p>
                            <p class="summary-item__desc">Lorem ipsum dollar...</p>
                        </div>
                        <span class="summary-item__price">$24.69</span>
                    </div>

                    <div class="summary-item">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/18/ISO_C%2B%2B_Logo.svg/250px-ISO_C%2B%2B_Logo.svg.png" alt="Item Image" class="summary-item__image">
                        <div class="summary-item__details">
                            <p class="summary-item__name">sed do eiusmod tempor adipiscing elit</p>
                            <p class="summary-item__desc">Lorem ipsum dollar...</p>
                        </div>
                        <span class="summary-item__price">$24.69</span>
                    </div>
                </div>
                
                <div class="summary-totals">
                    <div class="summary-total-row">
                        <span>Subtotal</span>
                        <span class="total-value">$51.38</span>
                    </div>
                    <div class="summary-total-row">
                        <span>Coupon Discount</span>
                        <span class="total-value total-value--discount">0 %</span>
                    </div>
                    <div class="summary-total-row">
                        <span>TAX</span>
                        <span class="total-value total-value--tax">5</span>
                    </div>
                    <div class="summary-total-row summary-total-row--final">
                        <span>Total</span>
                        <span class="total-value total-value--final">$56.38</span>
                    </div>
                </div>
            </aside>
        </div>
    </div>
    <section class="offer-section">
        <header class="offer-header">
            <h2 class="offer-header__title">
                Top Education offers and deals are listed here
            </h2>
            <a href="#" class="offer-header__link">See all</a>
        </header>

        <div class="offer-grid">
            
            <div class="offer-card">
                <div class="offer-card__media">
                    
                    <img src="./uploads/IMAGE/Rectangle 32.png" alt="Online Class" class="offer-card__image">
                    
                    <div class="offer-card__overlay offer-card__overlay--dark">
                         <span class="offer-card__badge offer-card__badge--50">50%</span>
                        
                        <h3 class="offer-card__title">Lorem ipsum dolor</h3>
                        <p class="offer-card__description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="offer-card">
                <div class="offer-card__media">
                    <img src="./uploads/IMAGE/Rectangle 33.png" alt="Kid Learning" class="offer-card__image">
                    <div class="offer-card__overlay offer-card__overlay--dark">
                        <span class="offer-card__badge offer-card__badge--10">10%</span>
                        
                        <h3 class="offer-card__title">Lorem ipsum dolor</h3>
                        <p class="offer-card__description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        </p>
                    </div>
                </div>
            </div>

            <div class="offer-card">
                <div class="offer-card__media">
                    <img src="./uploads/IMAGE/Rectangle 37.png" alt="Cat Online Class" class="offer-card__image">
                    <div class="offer-card__overlay offer-card__overlay--dark">
                        <span class="offer-card__badge offer-card__badge--50">50%</span>
                        
                        <h3 class="offer-card__title">Lorem ipsum dolor</h3>
                        <p class="offer-card__description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <?php include 'footer.php'; ?>
    </body>
</html>